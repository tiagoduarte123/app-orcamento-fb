<?php require_once('Connections/localhost.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['email'])) {
  $loginUsername=$_POST['email'];
  $password=$_POST['password'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "newarea.php";
  $MM_redirectLoginFailed = "index.php?sucess=0";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_localhost, $localhost);
  
  $LoginRS__query=sprintf("SELECT username, password FROM administrador WHERE username=%s AND password=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $localhost) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="Shortcut Icon" type="image/ico" href="http://www.legendary.pt/emailmkt/img/favicon.png">
		<link rel="stylesheet" type="text/css" href="http://www.legendary.pt/emailmkt/css/bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="http://www.legendary.pt/emailmkt/css/bootstrap-responsive.css" />
		<link rel="apple-touch-icon-precomposed" href="http://www.legendary.pt/emailmkt/img/sendy-icon.png" />
		<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
	    <!--[if lt IE 9]>
	      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	    <![endif]-->
		<link rel="stylesheet" type="text/css" href="http://www.legendary.pt/emailmkt/css/all.css" />
		<script type="text/javascript" src="http://www.legendary.pt/emailmkt/js/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="http://www.legendary.pt/emailmkt/js/jquery-migrate-1.1.0.min.js"></script>
		<script type="text/javascript" src="http://www.legendary.pt/emailmkt/js/jquery-ui-1.8.21.custom.min.js"></script>
		<script type="text/javascript" src="http://www.legendary.pt/emailmkt/js/bootstrap.js"></script>
		<script type="text/javascript" src="http://www.legendary.pt/emailmkt/js/main.js"></script>
		<title>Legendary</title>
	</head>
	<body>
		<div class="navbar navbar-fixed-top">
	      <div class="navbar-inner">
	        <div class="container-fluid">
	          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </a>
	          <!-- Check if sub user -->
	          	          <a class="brand" href="http://www.legendary.pt/emailmkt/">Legendary</a>
	          	          
	          	          
	        </div>
	      </div>
	    </div>
	    <div class="container-fluid">
	    <style type="text/css">
	#wrapper 
	{		
		height: 70px;	
		margin: -150px 0 0 -130px;
		position: absolute;
		top: 50%;
		left: 50%;
	}
	h2
	{
		margin-top: -10px;
	}
	.modal {
		width:262px;
		height: 158px;
		left:59%;
		overflow: hidden;
	}
</style>
<div>
    <div id="wrapper">
    	    		    <form ACTION="<?php echo $loginFormAction; ?>" METHOD="POST" class="well form-inline" id="form1">
	      <h2><span class="icon icon-lock" style="margin: 7px 7px 0 0;"></span>Login</h2> <?php if(isset($_GET['sucess']) && $_GET['sucess'] == "0") { ?><div class="alert alert-error">
  Erro ! Verifica as tuas entradas ou entra em contacto com o Administrador.
</div><?php } ?><br/>
		  <input type="text" class="input" placeholder="Email" name="email"><br/><br/>
		  <input type="password" class="input" placeholder="Password" name="password"><br/><br/>
		  <input type="hidden" name="redirect" value=""/>
		  <button type="submit" class="btn">Sign in</button><br/><br/>
		  
		</form>
    </div>   
    
    <div id="forgot-form" class="modal hide fade">
	    <form class="well form-inline" method="post" action="http://www.legendary.pt/emailmkt/includes/login/forgot.php" id="forgot">
	      <h2>Forgot password?</h2><br/>
		  <input type="text" class="input" placeholder="Your email" name="email"><br/><br/>
		  <button type="submit" class="btn" id="send-pass-btn">Send password</button>
		</form>
		<script type="text/javascript">
			$(document).ready(function() {
				$("#forgot").submit(function(e){
					e.preventDefault(); 
					
					$("#send-pass-btn").text("Sending..");
					
					var $form = $(this),
					email = $form.find('input[name="email"]').val(),
					url = $form.attr('action');
					
					$.post(url, { email: email },
					  function(data) {
					      if(data)
					      {
					      	$("#send-pass-btn").text("Send password");
					      	
					      	if(data=='Email does not exist.')
					      		alert('Email does not exist.');
					      	else
						      	$('#forgot-form').modal('hide');
					      }
					      else
					      {
					      	alert("Sorry, unable to reset password. Please try again later!");
					      }
					  }
					);
				});
			});
		</script>
    </div>
</div>

</body>
</html>