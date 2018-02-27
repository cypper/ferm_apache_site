<?php
/* Smarty version 3.1.30, created on 2018-02-25 22:47:01
  from "/home/cypper/Documents/localhost/modules/diary/assets/manage_ticket.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a9320c5937351_29911839',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c0f743d2e12e21420e8e8ffc1b2e3f660c3d2066' => 
    array (
      0 => '/home/cypper/Documents/localhost/modules/diary/assets/manage_ticket.tpl',
      1 => 1519591604,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a9320c5937351_29911839 (Smarty_Internal_Template $_smarty_tpl) {
?>


<div class="row">
  <div class="col-md-12 col-xs-12">
    <form class="form-horizontal form-label-left" id="add_ticket">
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Description
        </label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <textarea class="form-control" rows="3" placeholder="Description" name="description"></textarea>
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Color</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <input type="color" name="color" id="autocomplete-custom-append" class="form-control col-md-10" required="">
        </div>
      </div>

      <div class="ln_solid"></div>
      <div class="form-group">
        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
          <button type="submit" class="btn btn-success">Add</button>
        </div>
      </div>

    </form>
  </div>
  <style>
    .ticket {
      padding: 10px 20px;
      margin: 10px 0;
      width: fit-content;
      word-break: break-all;
      border-radius: 15px;
      box-shadow: 2px 2px 4px 1px #4343434d;
      color: white;
      font-weight: bold;
    }
    .droppable {
      min-height: 400px;
    }
    .dnd-box {
      margin: 20px;
      padding: 10px;
      border: 1px solid #169F85;
      border-radius: 5px;
      width: 45%;
    }
    .delete-button {
      margin: 0 0px 0 15px;
      font-size: 21px;
      cursor: pointer;
    }
    .input-node {
      margin: 0 0px 0 15px;
      color: black;
      width: 50px;
    }
    .hist {
      border: 1px solid #169F85;
      padding: 10px;
    }
  </style>
  <div class="col-md-6 col-xs-6 dnd-box" >
    <p>Tickets</p>
  </div>
  <div class="col-md-6 col-xs-6 dnd-box">
    <p>Today</p>
  </div>

  <div class="col-md-6 col-xs-6 dnd-box container-box" >
  </div>
  <div class="col-md-6 col-xs-6 dnd-box">
    <div id="today" class="droppable"></div>
  </div>

  <div class="col-md-6 col-xs-6 dnd-box" style="border: none;">
    Date: <input type="date" id="histdate">
  </div>
  <div class="col-md-6 col-xs-6 dnd-box" style="border: none;">
    <button type="submit" class="btn btn-success" id="add_history">Submit</button>
  </div>


  <div class="col-md-12 col-xs-12 dnd-box" style="border: none;width: 90%;">
    <p>History</p>
  </div>
  <div class="col-md-12 col-xs-12 dnd-box" id="history" style="border: none;width: 90%;">
  </div>
</div>

<?php echo '<script'; ?>
>
  var DragManager = new function() {

    /**
     * составной объект для хранения информации о переносе:
     * {
     *   elem - элемент, на котором была зажата мышь
     *   avatar - аватар
     *   downX/downY - координаты, на которых был mousedown
     *   shiftX/shiftY - относительный сдвиг курсора от угла элемента
     * }
     */
    var dragObject = {};

    var self = this;

    function onMouseDown(e) {


      if (e.which != 1) return;

      var elem = e.target.closest('.draggable');
      if (!elem) return;

      dragObject.elem = elem;

      // запомним, что элемент нажат на текущих координатах pageX/pageY
      dragObject.downX = e.pageX;
      dragObject.downY = e.pageY;

      return true;
    }

    function onMouseMove(e) {
      if (!dragObject.elem) return; // элемент не зажат

      if (!dragObject.avatar) { // если перенос не начат...
        var moveX = e.pageX - dragObject.downX;
        var moveY = e.pageY - dragObject.downY;

        // если мышь передвинулась в нажатом состоянии недостаточно далеко
        if (Math.abs(moveX) < 3 && Math.abs(moveY) < 3) {
          return;
        }

        // начинаем перенос
        dragObject.avatar = createAvatar(e); // создать аватар
        if (!dragObject.avatar) { // отмена переноса, нельзя "захватить" за эту часть элемента
          dragObject = {};
          return;
        }

        // аватар создан успешно
        // создать вспомогательные свойства shiftX/shiftY
        var coords = getCoords(dragObject.avatar);
        dragObject.shiftX = dragObject.downX - coords.left;
        dragObject.shiftY = dragObject.downY - coords.top;

        startDrag(e); // отобразить начало переноса
      }

      // отобразить перенос объекта при каждом движении мыши
      dragObject.avatar.style.left = e.pageX - dragObject.shiftX + 'px';
      dragObject.avatar.style.top = e.pageY - dragObject.shiftY + 'px';

      return false;
    }

    function onMouseUp(e) {
      if (dragObject.avatar) { // если перенос идет
        finishDrag(e);
      }

      // перенос либо не начинался, либо завершился
      // в любом случае очистим "состояние переноса" dragObject
      dragObject = {};
    }

    function finishDrag(e) {
      var dropElem = findDroppable(e);
      var contElem = findContainer(e);

      if (dropElem) {
        self.onDragEnd(dragObject, dropElem);
      } else if (contElem) {
        self.onDragCont(dragObject);
      } else {
        self.onDragCancel(dragObject);
      }
    }

    function createAvatar(e) {

      // запомнить старые свойства, чтобы вернуться к ним при отмене переноса
      var avatar = dragObject.elem;
      var old = {
        parent: avatar.parentNode,
        nextSibling: avatar.nextSibling,
        position: avatar.position || '',
        left: avatar.left || '',
        top: avatar.top || '',
        zIndex: avatar.zIndex || ''
      };

      // функция для отмены переноса
      avatar.rollback = function() {
        old.parent.insertBefore(avatar, old.nextSibling);
        avatar.style.position = old.position;
        avatar.style.left = old.left;
        avatar.style.top = old.top;
        avatar.style.zIndex = old.zIndex
      };

      return avatar;
    }

    function startDrag(e) {
      var avatar = dragObject.avatar;

      // инициировать начало переноса
      document.body.appendChild(avatar);
      // avatar.style.zIndex = 9999;
      avatar.style.position = 'absolute';
    }

    function findDroppable(event) {
      // спрячем переносимый элемент
      dragObject.avatar.hidden = true;

      // получить самый вложенный элемент под курсором мыши
      var elem = document.elementFromPoint(event.clientX, event.clientY);

      // показать переносимый элемент обратно
      dragObject.avatar.hidden = false;

      if (elem == null) {
        // такое возможно, если курсор мыши "вылетел" за границу окна
        return null;
      }

      return elem.closest('.droppable');
    }
    function findContainer(event) {
      // спрячем переносимый элемент
      dragObject.avatar.hidden = true;

      // получить самый вложенный элемент под курсором мыши
      var elem = document.elementFromPoint(event.clientX, event.clientY);

      // показать переносимый элемент обратно
      dragObject.avatar.hidden = false;

      if (elem == null) {
        // такое возможно, если курсор мыши "вылетел" за границу окна
        return null;
      }

      return elem.closest('.container-box');
    }

    document.onmousemove = onMouseMove;
    document.onmouseup = onMouseUp;
    document.onmousedown = onMouseDown;
    document.ontouchstart = onMouseDown;
    document.ontouchmove = onMouseMove;
    document.ontouchend = onMouseUp;

    this.onDragEnd = function(dragObject, dropElem) {};
    this.onDragCancel = function(dragObject) {};

  };


  function getCoords(elem) { // кроме IE8-
    var box = elem.getBoundingClientRect();

    return {
      top: box.top + pageYOffset,
      left: box.left + pageXOffset
    };

  }

  function clearElement(elem) {
    elem.style.zIndex = 1;
    elem.style.position = 'initial';
    elem.style.top = 'initial';
    elem.style.left = 'initial';
    elem.style.display = 'block';
  }
  function isDescendant(parent, child) {
       var node = child.parentNode;
       while (node != null) {
           if (node == parent) {
               return true;
           }
           node = node.parentNode;
       }
       return false;
  }
  function createDeleteButton(clickEvent) {
      var delButton = document.createElement('i');
      delButton.setAttribute("class", "fa fa-times delete-button");
      delButton.addEventListener("click", clickEvent);
      return delButton;
  }
  function createInput(inputEvent) {
      var inputNode = document.createElement('input');
      inputNode.setAttribute("class", "input-node");
      inputNode.setAttribute("type", "number");
      inputNode.setAttribute("type", "number");
      inputNode.addEventListener("input", inputEvent);
      return inputNode;
  }
  function createTicket(ticket, classes, delEvent, inputEvent) {
    var ticketNode = document.createElement('div');
    ticketNode.setAttribute("class", classes);
    ticketNode.style.background = ticket.color;
    ticketNode.innerHTML = ticket.description;

    if (inputEvent) ticketNode.appendChild(createInput(inputEvent));
    if (delEvent) ticketNode.appendChild(createDeleteButton(delEvent));
    return ticketNode;
  }
  function updageTickets() {
    var cont = document.querySelector('.container-box');
    cont.innerHTML = '';
    for (var tick in ALL_TICKETS) {
      
      var ticket = ALL_TICKETS[tick];
      if (!ticket.listed) continue;
      var ticketNode = document.createElement('div');
      ticketNode.setAttribute("class", "draggable ticket");
      ticketNode.setAttribute("id", tick);
      ticketNode.style.background = ticket.color;
      ticketNode.innerHTML = ticket.description;

      ticketNode.appendChild(createInput(function(){
        
        // cont.removeChild(ticketNode);
      }))
      ticketNode.appendChild(createDeleteButton(function() {
        
        var parent = this.parentNode;
        if (isDescendant(cont,parent)) {
          cont.removeChild(parent);
          ALL_TICKETS[parent.id].listed = false;
          saveTickets();
        } else {
          parent.remove();
          
        }
      }))

      
      cont.appendChild(ticketNode);
    }
  }
  function updateHistory() {
    var cont = document.querySelector('#history');
    cont.innerHTML = '';
    console.log(ALL_HISTORY.length);
    for (var i=0;i < ALL_HISTORY.length; i++) {
      var hist = ALL_HISTORY[i];
      var histNode = document.createElement('div');
      
      histNode.appendChild(createDeleteButton(function() {
        console.log("remove");
        var parent = this.parentNode;

        cont.removeChild(parent);

        ALL_HISTORY.splice(parent.id, 1);

        saveHistory();
        updateHistory();
  
      }))
      for (var id = 0; id < hist.tickets.length; id++) {
        var ticketInfo = hist.tickets[id];
        var ticket = ALL_TICKETS[ticketInfo.id];
        var ticketNode = createTicket(ticket,"ticket");
        ticketNode.setAttribute("id", id);
        var input = createInput();
        input.addEventListener("change", function(){
           var parent = this.parentNode.parentNode;
           var ticket = this.parentNode;
           console.log(parent.id,ticket.id);
           console.log( ALL_HISTORY[parent.id].tickets[ticket.id]);
           ALL_HISTORY[parent.id].tickets[ticket.id].value = this.value;
           saveHistory();
           updateHistory();
           
        });
        input.value = ticketInfo.value;
        // input.setAttribute("disabled","disabled");
        ticketNode.appendChild(input);
        histNode.appendChild(ticketNode);
      }
      histNode.setAttribute("class", "hist");
      histNode.setAttribute("id", i);


      histNode.appendChild(document.createTextNode(new Date(hist.date*1000)));

      
      cont.appendChild(histNode);
    }
  }

  var todayBox = document.getElementById('today');

  DragManager.onDragCancel = function(dragObject) {
    
    // dragObject.elem.
    dragObject.avatar.remove();
    updageTickets();
  };
  DragManager.onDragCont = function(dragObject) {
    
    dragObject.avatar.rollback();
    updageTickets();
  };

  DragManager.onDragEnd = function(dragObject, dropElem) {
    
    
    clearElement(dragObject.elem);
    todayBox.appendChild(dragObject.elem);
    updageTickets();
  };
<?php echo '</script'; ?>
>

<?php echo '<script'; ?>
>
  var ALL_TICKETS = JSON.parse('<?php echo $_smarty_tpl->tpl_vars['vars']->value['tickets_json'];?>
');
  var ALL_HISTORY = JSON.parse('<?php echo $_smarty_tpl->tpl_vars['vars']->value['history_json'];?>
');
  ALL_HISTORY.sort(function (a, b) {
    return b.date - a.date;
  });


  updateHistory();
  updageTickets();
  function warning(text) {
    var warning = document.getElementById("warning");
    warning.innerHTML = text;
    setTimeout(function(){
      warning.innerHTML = "";
    },2000);
  }
  function postAsync(url2get,callback,method,data=null)    {
      //url2get = encodeURIComponent(url2get);
      var req;
      if (window.XMLHttpRequest) {
          req = new XMLHttpRequest();
          } else if (window.ActiveXObject) {
          req = new ActiveXObject("Microsoft.XMLHTTP");
          }
      if (req != undefined) {
          // req.overrideMimeType("application/json"); // if request result is JSON

          try {
              req.open(method, url2get, false); // 3rd param is whether "async"
              req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
              }
          catch(err) {
              alert("couldnt complete request. Is JS enabled for that domain?\\n\\n" + err.message);
              return false;
              }
          req.send(data); // param string only used for POST

          if (req.readyState == 4) { // only if req is "loaded"
              if (req.status == 200)  // only if "OK"
                  {
                    callback(req);

                    return req.responseText ;
                  }
              else    { return "XHR error: " + req.status +" "+req.statusText; }
              }
          }
      alert("req for getAsync is undefined");
  }


  function formSubmit(url, vars, callback, method="GET", post=false) {
    var var_str = "";
    for (var prop in vars) {
      if (vars[prop] == null) {
        var_str+="&"+prop;
      } else {
        var_str+="&"+prop+"="+encodeURIComponent(vars[prop]);
      }
    }
    var_str = "?"+var_str.slice(1);

    if (post==true) {
      
      var ret = postAsync(url, callback,method,var_str);
      
    } else {
      var ret = postAsync(url+var_str, callback,method) ;
    }
        // hint: encodeURIComponent()

    if (ret.match(/^XHR error/)) {
        
        return;
    }
  }
  function serialize(obj, prefix) {
    var str = [], p;
    for(p in obj) {
      if (obj.hasOwnProperty(p)) {
        var k = prefix ? prefix + "[" + p + "]" : p, v = obj[p];
        str.push((v !== null && typeof v === "object") ?
          serialize(v, k) :
          encodeURIComponent(k) + "=" + encodeURIComponent(v));
      }
    }
    return str.join("&");
  }
  function ticketsCheck(description) {
    for (var tickId in ALL_TICKETS) {
      var tick = ALL_TICKETS[tickId];
      
      if (tick.description == description) return tick.id;
    }
    return false;
  }
  function saveTickets() {
    var vars = {
      update_tickets: JSON.stringify(ALL_TICKETS),
      diary_api: null
    }
    
  var ret = postAsync("/module/diary/api", function(req){
     console.log(req.responseText);
     // location.reload();
  }, "POST", serialize(vars));

    if (ret.match(/^XHR error/)) {
        
        return;
    }
  }
  function saveHistory(data) {
    var vars = {
      update_history: JSON.stringify(ALL_HISTORY),
      diary_api: null
    }
    
  var ret = postAsync("/module/diary/api", function(req){
     console.log(req.responseText);
     // location.reload();
  }, "POST", serialize(vars));

    if (ret.match(/^XHR error/)) {
        
        return;
    }
  }
  function makeid(len) {
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for (var i = 0; i < len; i++)
      text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
  }
  addEventListener("load", function(){
    var add_ticket = document.getElementById("add_ticket");
    var add_history = document.getElementById("add_history");
    var date_node = document.getElementById("histdate");
    Date.prototype.toDateInputValue = (function() {
        var local = new Date(this);
        local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
        return local.toJSON().slice(0,10);
    });
    var now = new Date();
    date_node.value = now.toDateInputValue();
    
    add_ticket.addEventListener("submit", function(ev){
      ev.preventDefault();
      var newTicket = {
        description: this.elements[0].value,
        color: this.elements[1].value,
        created_at: Date.now(),
        listed: true
      }
      var checkResult = ticketsCheck(newTicket.description);
      if (!checkResult) {
        var id = makeid(40);
        ALL_TICKETS[id] = newTicket;
        
      } else {
        ALL_TICKETS[checkResult].listed = true;
      }
      saveTickets();
      updageTickets();
    },false)
    add_history.addEventListener("click", function(ev){
      ev.preventDefault();
      var today = document.querySelector('#today');

      var setTickets = [];
      for (var i = 0; i < today.children.length; i++) {
        var ticketNode = today.children[i];
        setTickets.push({
          id: ticketNode.id,
          value: +ticketNode.querySelector("input").value
        });
      }


      

      var data = {
        tickets: setTickets,
        date: Date.parse(date_node.value)/1000,
      }
      ALL_HISTORY.push(data);
      saveHistory(ALL_HISTORY);
      updateHistory();
      today.innerHTML = '';
    },false)

  })

<?php echo '</script'; ?>
><?php }
}
