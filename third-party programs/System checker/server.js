var path_to_log = "";
var nvidiaSmi = "nvidia-smi ";
// var nvidiaSmi = "\"C:\\Program Files\\NVIDIA Corporation\\NVSMI\\nvidia-smi\" ";
var querystring = require('querystring');
var http = require('http');
var fs = require('fs');
const { exec } = require('child_process');

var args = process.argv.slice(2);
var host = 'ferm.pp.ua';
if (args[2] && args[2].startsWith("-host=")) host = args[2].slice(6);
var gpus_count = null;
var name = null;

if (args && args[0] && args[1] 
  && args[0].startsWith("-name=")
  && args[1].startsWith("-gpus=")) {
  gpus_count = +args[1].slice(6);
  name = args[0].slice(6);
  if (isNaN(gpus_count)) process.exit();
} else {
  process.exit();
}

var getFilesizeInBytes = function(filename) {
  const stats = fs.statSync(filename)
  const fileSizeInBytes = stats.size;
  return fileSizeInBytes;
}

var getStatsAfterburner = function(callback) {
  if (getFilesizeInBytes(path_to_log+'gpu_log.txt') <= 0) {
    return reportError();
  }
  var lineReader = require('readline').createInterface({
    input: fs.createReadStream(path_to_log+'gpu_log.txt')
  });

  var gpuLog = [];
  var countLines = 0;
  lineReader.on('line', function (line) {
    if (!line) return;
    countLines++;
    gpuLog.push(line.split(",").map(function(el){return el.trim()}));
  });
  lineReader.on('close', function () {
    // console.log(gpuLog[2]);
    callback(gpuLog[gpuLog.length-1]);
    fs.writeFile(path_to_log+'gpu_log.txt', '', function(){})
  });
}
var startPostAfterburner = function(last){
  var object = {};
  object.gpus = [];
  if (last.length-1 < 2+gpus_count*8 + gpus_count-1) {
    return reportError();
  }
  for (var i = 0; i < gpus_count; i++) {
    var gpu = {};
    gpu.temperature = last[2+i];
    // gpu.temperature = last[2+i];
    gpu.usage = last[2+gpus_count+i];
    gpu.memoryUsage = last[2+gpus_count*4+i];
    gpu.coreClock = last[2+gpus_count*5+i];
    gpu.memoryClock = last[2+gpus_count*6+i];
    object.gpus.push(gpu);
  }
  // object.date = last[1];
  object.date = Date.now();
  object.name = name;
  object.gpus_count = gpus_count;
  // console.log(object);

  PostCode(object);
}

var getStatsNvidia = function(callback) {
  var query = nvidiaSmi+"--query-gpu=index,timestamp,name,driver_version,temperature.gpu,utilization.gpu,utilization.memory,clocks.gr,clocks.mem,memory.used --format=csv";
  exec(query, (err, stdout, stderr) => {
    if (err) {
      console.log("not run",err);
      return;
    }

    callback(stdout);
    if (stderr) {
      console.log(`stderr: ${stderr}`);
    }
  });
}
var startPostNvidia = function(last){
  var lines = last.match(/[^\r\n]+/g);
  var object = {};
  object.gpus = [];
  if (lines.length-1 < gpus_count) {
    return reportError();
  }
  for (var i = 0; i < gpus_count; i++) {
    var gpu = {};
    var dataFromLine = lines[i+1].split(",").map(function(el){return el.trim()})

    gpu.id = dataFromLine[0];
    gpu.name = dataFromLine[2];
    gpu.driverVersion = dataFromLine[3];
    gpu.temperature = dataFromLine[4];
    gpu.usage = dataFromLine[5];
    gpu.memoryUsage = dataFromLine[6];
    gpu.coreClock = dataFromLine[7];
    gpu.memoryClock = dataFromLine[8];
    gpu.memoryUsed = dataFromLine[9];
    object.gpus.push(gpu);
  }
  // object.date = last[1];
  object.date = Date.now();
  object.name = name;
  object.gpus_count = gpus_count;

  PostCode(object);
}

var post_req = null;

function PostCode(data) {
  if (post_req) post_req.abort();

  var post_data = querystring.stringify({
      'wor_api': null,
      'workers_status': null,
      "data": JSON.stringify(data),
  });
  console.log(Date());

  // An object of options to indicate where to post to
  var post_options = {
      host: host,
      port: '80',
      path: '/module/workers/api',
      method: 'POST',
      headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
          'Content-Length': Buffer.byteLength(post_data)
      }
  };
  // Set up the request
  post_req = http.request(post_options, function(res) {
      res.setEncoding('utf8');
      res.on('data', function (data) {
          console.log('Response: ' + data);
      });
      res.on('error', function (e) {
          reportError(e);
      });
     
  });
  post_req.on('error', function (e) {
      reportError(e);
  });
  post_req.on('timeout', function (e) {
      reportError(e);
  });

  // post the data
  post_req.write(post_data);
  post_req.end();

}

// This is an async file read



var reportError = function(e) {
  if (e) console.error(`problem with request: ${e.message}`);
  if (post_req) post_req.abort();
  console.log("returned");
  return;
}
var gettingData = function() {
  // getStatsAfterburner(startPostAfterburner);
  getStatsNvidia(startPostNvidia);
}

gettingData();
setInterval(gettingData, 10000);