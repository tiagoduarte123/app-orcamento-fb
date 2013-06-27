<?php require_once('Connections/localhost.php'); ?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "index.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE administrador SET username=%s, password=%s WHERE idadministrador=%s",
                       GetSQLValueString($_POST['user'], "text"),
                       GetSQLValueString($_POST['senha'], "text"),
                       GetSQLValueString($_POST['iduser'], "int"));

  mysql_select_db($database_localhost, $localhost);
  $Result1 = mysql_query($updateSQL, $localhost) or die(mysql_error());

  $updateGoTo = "usermanagement.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_admin = "-1";
if (isset($_GET['idadministrador'])) {
  $colname_admin = $_GET['idadministrador'];
}
mysql_select_db($database_localhost, $localhost);
$query_admin = sprintf("SELECT * FROM administrador WHERE idadministrador = %s", GetSQLValueString($colname_admin, "int"));
$admin = mysql_query($query_admin, $localhost) or die(mysql_error());
$row_admin = mysql_fetch_assoc($admin);
$totalRows_admin = mysql_num_rows($admin);$colname_admin = "-1";
if (isset($_GET['idadministrador'])) {
  $colname_admin = $_GET['idadministrador'];
}
mysql_select_db($database_localhost, $localhost);
$query_admin = sprintf("SELECT * FROM administrador WHERE idadministrador = %s", GetSQLValueString($colname_admin, "int"));
$admin = mysql_query($query_admin, $localhost) or die(mysql_error());
$row_admin = mysql_fetch_assoc($admin);
$totalRows_admin = mysql_num_rows($admin);
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Bootstrap 101 Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
  <meta charset="utf-8">
  
  <link href="bootstrap-editable/css/bootstrap-editable.css" rel="stylesheet">
<script src="bootstrap-editable/js/bootstrap-editable.min.js"></script>
<link href="bootstrap-editable/css/bootstrap.css" rel="stylesheet">
<script src="bootstrap-editable/js/jquery-1.8.2.min.js"></script>
<script src="path/to/bootstrap/js/bootstrap.min.js"></script>
  </head>
  <body>
<div class="navbar navbar-inverse navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container-fluid">
      <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span></button>
      <a class="brand" href="#">GESTÃO FB</a>
      <div class="nav-collapse collapse">
        <p class="navbar-text pull-right"></p>
        <ul class="nav">
          <li class="active"><a href="#">Home</a></li>
          <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown">Config<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="newuser.php">NOVO UTILIZADOR</a></li>
              <li><a href="usermanagement.php">GERIR UTILIZADORES</a></li>
              <li class="divider"></li>
            </ul>
          </li>
        </ul>
        <ul class="nav pull-right">
          <li id="fat-menu" class="dropdown"> <a href="#" id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['MM_Username']; ?><b class="caret"></b></a>
            <ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
              <li role="presentation" class="divider"></li>
              <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo $logoutAction ?>">Terminar sessão</a></li>
            </ul>
          </li>
        </ul>
      </div>
      <!--/.nav-collapse -->
    </div>
  </div>
</div>
<p>&nbsp;</p>
    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span3">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li><a href="#">Home</a></li>
              <li class="nav-header">GESTÃO DE AREAS</li>
              <li><a href="newarea.php">NOVA AREA</a></li>
              <li><a href="areamanagement.php">GERIR AREAS</a></li>
              <li></li>
              <li></li>
              <li class="nav-header">GESTÃO DE SERVIÇOS</li>
              <li><a href="#">NOVO SERVIÇO</a></li>
              <li><a href="servicomanage.php">GERIR SERVIÇOS</a></li>
              <li></li>
              <li></li>
              <li></li>
              <li></li>
              <li class="nav-header">GESTÃO DE CLIENTES</li>
              <li><a href="#">GERIR UTILIZADORES</a></li>
              <li></li>
              <li></li>
            </ul>
          </div>
          <!--/.well -->
        </div>
        <!--/span-->
        <div class="span5">
          <div class="hero-unit">
            <div>
            
            <center>
            
            
            <?php if(isset($_GET['sucess']) && $_GET['sucess'] == "1") { ?>
            <p class="text-success">Utilizador inserido com sucesso.</p><?php } ?>
            
            <form action="<?php echo $editFormAction; ?>" method="POST" name="form1" id="form1">
              <table width="100%" border="0">
                <tr>
                  <td><input name="iduser" type="text" class="input-block-level" id="iduser" style="visibility:hidden" value="<?php echo $row_admin['idadministrador']; ?>" ></td>
                </tr>
                <tr>
                
                
                  <td><input name="user" type="text" class="input-block-level" id="user" placeholder="Utilizador/Email" value="<?php echo $row_admin['username']; ?>"></td>
                </tr>
                <tr>
                  <td><input name="senha" type="text" class="input-block-level" id="senha" placeholder="Senha..." value="<?php echo $row_admin['password']; ?>"></td>
                </tr>
              </table>
              <p>                <a href="#" class="btn btn-primary btn-large" onClick="form1.submit();" >Adicionar</a></p>
              <input type="hidden" name="MM_update" value="form1">
            </form></center></div>
          </div><!--/row-->
          <div class="row-fluid"><!--/span--><!--/span--><!--/span-->
          </div><!--/row-->
        </div><!--/span-->
      </div><!--/row-->

      <hr>

      <footer>
        <p></p>
      </footer>

  </div>
  <script type="application/javascript">
  
  $('#username').editable();
  </script>
  <script src="http://code.jquery.com/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
  </body>
</html>
<?php
mysql_free_result($admin);
?>
