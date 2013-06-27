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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE servico SET nome_servico=%s, idarea=%s WHERE idservico=%s",
                       GetSQLValueString($_POST['nome_servico'], "text"),
                       GetSQLValueString($_POST['idarea'], "int"),
                       GetSQLValueString($_POST['idservico'], "int"));

  mysql_select_db($database_localhost, $localhost);
  $Result1 = mysql_query($updateSQL, $localhost) or die(mysql_error());

  $updateGoTo = "teste.php?sucess=1";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_servico = "-1";
if (isset($_GET['idservico'])) {
  $colname_servico = $_GET['idservico'];
}
mysql_select_db($database_localhost, $localhost);
$query_servico = sprintf("SELECT * FROM servico WHERE idservico = %s", GetSQLValueString($colname_servico, "int"));
$servico = mysql_query($query_servico, $localhost) or die(mysql_error());
$row_servico = mysql_fetch_assoc($servico);
$totalRows_servico = mysql_num_rows($servico);

mysql_select_db($database_localhost, $localhost);
$query_areas = "SELECT * FROM area";
$areas = mysql_query($query_areas, $localhost) or die(mysql_error());
$row_areas = mysql_fetch_assoc($areas);
$totalRows_areas = mysql_num_rows($areas);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Idservico:</td>
      <td><?php echo $row_servico['idservico']; ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nome_servico:</td>
      <td><input type="text" name="nome_servico" value="<?php echo htmlentities($row_servico['nome_servico'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Area:</td>
      <td><select name="idarea">
        <?php 
do {  
?>
        <option value="<?php echo $row_areas['idarea']?>" <?php if (!(strcmp($row_areas['idarea'], htmlentities($row_servico['idarea'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>><?php echo $row_areas['nome_area']?></option>
        <?php
} while ($row_areas = mysql_fetch_assoc($areas));
?>
      </select></td>
    </tr>
    <tr> </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Update record" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="idservico" value="<?php echo $row_servico['idservico']; ?>" />
</form>

</body>
</html>
<?php
mysql_free_result($servico);

mysql_free_result($areas);
?>
