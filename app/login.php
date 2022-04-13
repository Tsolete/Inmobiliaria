<?php 
require_once ('../config/config.php'); 
require_once ('../config/public_functions.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>loires LOGIN</title>
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="css/AdminLTE.min.css" rel="stylesheet" type="text/css">
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,600,800' rel='stylesheet' type='text/css'>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<NOSCRIPT><meta http-equiv="refresh" content="0; url=noscript.html"></NOSCRIPT>
	<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
	<style>	.login-box-body{background-color:rgba(0,0,0,0.6);color:#FFF!important}.login-logo{background-color:#FFF;color:#FFF!important;margin-bottom:0!important;padding:20px 0!important}.login-logo a{color:#FFF!important}a{color:#FFF!important}a:hover{text-decoration:underline}.response-login{min-height:42px}.logo-color-1{color: #2376F2}
	</style>
</head>

<?php 
$bg = array();
$bg[0] = 'images/backgrounds/vintage-wallpaper1.jpg';
$bg[1] = 'images/backgrounds/vintage-wallpaper2.jpg';
$bg[2] = 'images/backgrounds/vintage-wallpaper3.jpg';
$bg[3] = 'images/backgrounds/vintage-wallpaper4.jpg';
$bg[4] = 'images/backgrounds/vintage-wallpaper5.jpg';

$i = mt_rand(0, 4);
?>

<body class="hold-transition login-page" style="background:url(<?php echo $bg[$i]; ?>) no-repeat center center; overflow-y:hidden;">

<div class="login-box">
      <div class="login-logo">
          <img src="../assets/images/loires.png" class="img-responsive center-block">
      </div>
      <div class="login-box-body">
          <p class="login-box-msg">Iniciar sesión</p>
          <form action="controls/login.php" method="post" name="form-auth" id="form-auth" enctype="application/x-www-form-urlencoded">       
              <div class="form-group has-feedback">
                  <input class="form-control" placeholder="Usuario" type="text" name="login" required>
                  <span class="glyphicon glyphicon-user form-control-feedback"></span>
              </div>
              <div class="form-group has-feedback">
                  <input class="form-control" placeholder="Contraseña" type="password" name="password" id="password" required>
                  <span class="glyphicon glyphicon-lock form-control-feedback"></span>
              </div>
              <div class="row">
                  <div class="col-xs-6 ">
                      <button type="submit" name="submit-login" class="btn btn-primary btn-block btn-flat">Entrar</button>
                  </div>
                  <div class="col-xs-6">
                      <div class="checkbox icheck hidden">
                        <label style="padding-left: 20px;">
							<input type="checkbox" name="remember" class="no-padding">Mantenerse conectado
                        </label>
                      </div>
                      <a href="javascript:;" class="pull-right" id="show-password" title="Mostrar contraseña"><i class="fa fa-2x fa-eye"></i></a>
                  </div>
              </div>
          </form>
          <a href="#" class="hidden">Olvidé mi contraseña</a><br>
          <div class="clearfix"></div>
          
          <div class="response-login"></div>
          <p class="text-center no-margin"><small><?php echo auto_copyright(2015); ?></small></p> 
    </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<script src="../libs/jQuery/jquery-2.2.3.js" CROSSORIGIN="anonymous"></script>
<script src="javascript/bootstrap.min.js" CROSSORIGIN="anonymous"></script>
<script>
$(document).on('click', "#show-password", function(){
  if( $('#password').attr('type') === 'password' )
  {
      $('#password').attr('type', 'text'); 
      $(this).find('i').removeClass('fa-eye').addClass('fa-eye-slash');
  }
  else
  {
      $('#password').attr('type', 'password'); 
      $(this).find('i').removeClass('fa-eye-slash').addClass('fa-eye');
  }
});
</script>
<script>
$('#form-auth').on('submit', function (e) {
    e.preventDefault();
    
    var formDados = jQuery(this).serialize();
    var formUrl = jQuery(this).attr('action');
    
    jQuery.ajax({
      type: "POST",
      async:true,
      cache:false,
      url: formUrl,
      dataType: 'json',
      data: formDados,
      success: function( data ){  
         if(data.status === 'success'){   
             location.href="admin";
         }
         else if(data.status === 'info'){   
             $('.response-login').html('<div class="alert alert-info alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' + data.message + '</div>');
         }
         else if(data.status === 'warning'){   
             $('.response-login').html('<div class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' + data.message + '</div>');
         }
         else{
             $('.response-login').html('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' + data.message + '</div>');
         }
      },
      error: function (){
          $('.response-login').html('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>El servidor no responde.</div>');
      }

    }); 
}); 
</script>
</body>
</html>
    