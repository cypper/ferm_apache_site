<?php
/* Smarty version 3.1.30, created on 2018-02-08 05:51:56
  from "/home/cypper/Documents/localhost/modules/diary/assets/add_ticket.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a7bc95cc5ad32_69727581',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e57af52b6fc676cc4bf6397fab55efe687c0623e' => 
    array (
      0 => '/home/cypper/Documents/localhost/modules/diary/assets/add_ticket.tpl',
      1 => 1518061915,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a7bc95cc5ad32_69727581 (Smarty_Internal_Template $_smarty_tpl) {
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
      background: red;
      width: fit-content;
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
  </style>
  <div class="col-md-6 col-xs-6 dnd-box container-box" >
    <div class="draggable ticket">Lowe it</div>
    <div class="draggable ticket">Lowe it2</div>
    <div class="draggable ticket">Lowe it3</div>
    <div class="draggable ticket">Lowe it4</div>
  </div>
  <div class="col-md-6 col-xs-6 dnd-box">
    <div id="today" class="droppable"></div>
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

      return false;
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
  function updageTickets() {
    var cont = document.querySelector('.container-box');
    cont.innerHTML = `<div class="draggable ticket">Lowe it</div>
    <div class="draggable ticket">Lowe it2</div>
    <div class="draggable ticket">Lowe it3</div>
    <div class="draggable ticket">Lowe it4</div>`;
  }

  var todayBox = document.getElementById('today');

  DragManager.onDragCancel = function(dragObject) {
    console.log("cancel");
    // dragObject.elem.
    dragObject.avatar.remove();
    updageTickets();
  };
  DragManager.onDragCont = function(dragObject) {
    console.log("cont");
    dragObject.avatar.rollback();
    updageTickets();
  };

  DragManager.onDragEnd = function(dragObject, dropElem) {
    console.log(dragObject.elem);
    console.log(todayBox);
    clearElement(dragObject.elem);
    todayBox.appendChild(dragObject.elem);
    updageTickets();
  };
<?php echo '</script'; ?>
>

<?php echo '<script'; ?>
>
  var tickets = JSON.parse('<?php echo $_smarty_tpl->tpl_vars['vars']->value['tickets_json'];?>
');
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
      console.log("post");
      var ret = postAsync(url, callback,method,var_str);
      
    } else {
      var ret = postAsync(url+var_str, callback,method) ;
    }
        // hint: encodeURIComponent()

    if (ret.match(/^XHR error/)) {
        console.log(ret);
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
  for (var tickId in tickets) {
    var tick = tickets[tickId];
    console.log(tick);
    if (tick.description == description) return true;
  }
  return false;
  }
  function saveTickets() {
    var vars = {
      update_tickets: JSON.stringify(tickets),
      diary_post: "update_tickets"
    }
    console.log(vars);
  var ret = postAsync("/module/diary", function(req){
     console.log(req.responseText); 
     location.reload();
  }, "POST", serialize(vars));

    if (ret.match(/^XHR error/)) {
        console.log(ret);
        return;
    }
  }
  addEventListener("load", function(){
    var add_ticket = document.getElementById("add_ticket");
    console.log(add_ticket);
    add_ticket.addEventListener("submit", function(ev){
      ev.preventDefault();
      var newTicket = {
        description: this.elements[0].value,
        color: this.elements[1].value
      }
      if (!ticketsCheck(newTicket.description)) {
        var id = Math.round(Math.random()*1000000000*Math.random()*1000000000);
        tickets[id] = newTicket;
        console.log("new added");
        saveTickets();
      }
    },false)



    // var signupForm = document.getElementById("access_signup");
    // console.log(signupForm);
    // signupForm.addEventListener("submit", function(ev){
    //   ev.preventDefault();
    //   var vars = {
    //     username: this.elements[0].value,
    //     email: this.elements[1].value,
    //     password: this.elements[2].value,
    //     access_api: null,
    //     sign_up: null
    //   }
    //   console.log(vars);
    //   formSubmit("/module/access",vars, function(req){
    //     if (req.responseText == "\"username\"") {
    //       warning("ERROR username exist");
    //       console.log("ERROR username exist");
    //     } else if (req.responseText == "\"email\"") {
    //       warning("ERROR email exist");
    //       console.log("ERROR email exist");
    //     } else if (req.responseText == "\"done\"") {
    //       warning("Account created");
    //       location.href = "/login#signin";
    //     }
    //   });



    // },false)
  })

<?php echo '</script'; ?>
><?php }
}
