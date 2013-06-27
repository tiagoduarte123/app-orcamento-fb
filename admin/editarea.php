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


if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE area SET nome_area=%s WHERE idarea=%s",
                       GetSQLValueString($_POST['nome_area'], "text"),
                       GetSQLValueString($_POST['idarea'], "int"));

  mysql_select_db($database_localhost, $localhost);
  $Result1 = mysql_query($updateSQL, $localhost) or die(mysql_error());

  $updateGoTo = "areamanagement.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_areaa = "-1";
if (isset($_GET['idarea'])) {
  $colname_areaa = $_GET['idarea'];
}
mysql_select_db($database_localhost, $localhost);
$query_areaa = sprintf("SELECT * FROM area WHERE idarea = %s", GetSQLValueString($colname_areaa, "int"));
$areaa = mysql_query($query_areaa, $localhost) or die(mysql_error());
$row_areaa = mysql_fetch_assoc($areaa);
$totalRows_areaa = mysql_num_rows($areaa);
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
              <li ><a href="newarea.php">NOVA AREA</a></li>
              <li class="active"><a href="areamanagement.php">GERIR AREAS</a></li>
              <li></li>
              <li></li>
              <li class="nav-header">GESTÃO DE SERVIÇOS</li>
              <li><a href="newservico.php">NOVO SERVIÇO</a></li>
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
            <p class="text-success">As alterações foram efetuadas com sucesso.</p><?php } ?>
            
           
            <form method="post" name="form2" action="<?php echo $editFormAction; ?>">
              <table align="center">
                <tr valign="baseline">
                  <td><input type="text" class="input-block-level" name="nome_area" value="<?php echo htmlentities($row_areaa['nome_area'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
                </tr>
                <tr valign="baseline">
                  <td><CENTER><a href="#" class="btn btn-primary btn-large" onClick="form2.submit();" >Guardar</a></CENTER></td>
                </tr>
              </table>
              <input type="hidden" name="MM_update" value="form2">
              <input type="hidden" name="idarea" value="<?php echo $row_areaa['idarea']; ?>">
            </form>
            <p>&nbsp;</p>
            <br>
</center></div>
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
mysql_free_result($areaa);
?>
