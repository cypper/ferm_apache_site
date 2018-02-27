<?php
/* Smarty version 3.1.30, created on 2018-02-25 22:04:00
  from "/home/cypper/Documents/localhost/templates/login.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a9316b00dba13_84690171',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c4cddfc8f8e67c42030eea602250024e52c0b783' => 
    array (
      0 => '/home/cypper/Documents/localhost/templates/login.tpl',
      1 => 1519589012,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a9316b00dba13_84690171 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $_smarty_tpl->tpl_vars['main_title']->value;?>
</title>

    <!-- Bootstrap -->
    <link href="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
/vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
/build/css/custom.min.css" rel="stylesheet">
    <?php echo '<script'; ?>
 src='https://www.google.com/recaptcha/api.js'><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
>
      function warning(text) {
        var warning = document.getElementById('warning');
        warning.innerHTML = text;
        setTimeout(function(){
          warning.innerHTML = '';
        },2000);
      }
      function postAsync(url2get,callback)    {
          var req;
          if (window.XMLHttpRequest) {
              req = new XMLHttpRequest();
              } else if (window.ActiveXObject) {
              req = new ActiveXObject("Microsoft.XMLHTTP");
              }
          if (req != undefined) {
              // req.overrideMimeType("application/json"); // if request result is JSON
              try {
                  req.open("GET", url2get, false); // 3rd param is whether "async"
                  }
              catch(err) {
                  alert("couldnt complete request. Is JS enabled for that domain?\\n\\n" + err.message);
                  return false;
                  }
              req.send(); // param string only used for POST

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


      function formSubmit(url, vars, callback) {
        var var_str = '';
        for (var prop in vars) {
          if (vars[prop] == null) {
            var_str+="&"+prop;
          } else {
            var_str+="&"+prop+"="+vars[prop];
          }
        }
        var_str = "?"+var_str.slice(1);

        console.log(url+var_str);
        var ret = postAsync(url+var_str, callback) ;
            // hint: encodeURIComponent()

        if (ret.match(/^XHR error/)) {
            console.log(ret);
            return;
        }
      }
      addEventListener('load', function(){
        var loginForm = document.getElementById('access_signin');
        console.log(loginForm);
        loginForm.addEventListener("submit", function(ev){
          ev.preventDefault();
          var vars = {
            login: this.elements[0].value,
            password: this.elements[1].value,
            access_api: null,
            sign_in: null
          }
          console.log(vars);
          formSubmit("/module/access/api",vars, function(req){
            console.log(req);
            if (req.responseText == "password") {
              warning("ERROR wrong password");
              console.log("ERROR wrong password");
            } else if (req.responseText == "login") {
              warning("ERROR username or email is wrong");
              console.log("ERROR username or email is wrong");
            } else if (req.responseText == "done"){
              warning("Logged in");
              location.href = '/';
            }
            
          });
        },false)



        var signupForm = document.getElementById('access_signup');
        console.log(signupForm);
        signupForm.addEventListener("submit", function(ev){
          ev.preventDefault();
          var vars = {
            username: this.elements[0].value,
            email: this.elements[1].value,
            password: this.elements[2].value,
            access_api: null,
            sign_up: null
          }
          console.log(vars);
          formSubmit("/module/access/api",vars, function(req){
            if (req.responseText == "username") {
              warning("ERROR username exist");
              console.log("ERROR username exist");
            } else if (req.responseText == "email") {
              warning("ERROR email exist");
              console.log("ERROR email exist");
            } else if (req.responseText == "done") {
              warning("Account created");
              location.href = '/login#signin';
            }
          });



        },false)
      })

    <?php echo '</script'; ?>
>
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>
      <p style="text-align: center;" id="warning"></p>
      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form id="access_signin">
              <h1>Login Form</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username or email" required="" name="login">
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" name="password">
              </div>
              <div>
                <!-- <div class="g-recaptcha" data-sitekey="6LfvI0QUAAAAAOLDCeo0cUnINcfWqO6eBAbkyKQg"></div> -->
              </div>
              <div>
                <button class="btn btn-default submit" type="submit">Log in</button>
                <a class="reset_pass" href="#">Lost your password?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Create Account </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> <?php echo $_smarty_tpl->tpl_vars['main_title']->value;?>
</h1>
                  <p>©2016 All Rights Reserved. <?php echo $_smarty_tpl->tpl_vars['main_title']->value;?>
 is a Bootstrap 3 template. Privacy and Terms</p>
                </div>
              </div>
            </form>

          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form id="access_signup">
              <h1>Create Account</h1>
              <div>
                <input type="text" name="username" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="email" name="email" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" name="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <!-- <div class="g-recaptcha" data-sitekey="6LfvI0QUAAAAAOLDCeo0cUnINcfWqO6eBAbkyKQg"></div> -->
              </div>
              <div>
                <button class="btn btn-default submit" type="submit">Submit</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> <?php echo $_smarty_tpl->tpl_vars['main_title']->value;?>
</h1>
                  <p>©2016 All Rights Reserved. <?php echo $_smarty_tpl->tpl_vars['main_title']->value;?>
 is a Bootstrap 3 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
<?php }
}
