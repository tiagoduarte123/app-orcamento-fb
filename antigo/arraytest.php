<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body><?php
$string = "joão<br> maria<br> josé<br> pedro";
$array  = explode('<br>', $string);
print_r($array);
echo "array[1]=".$array[1];
echo "<br>";
echo "array[2]=".$array[2];
echo "<br>";
echo "array[0]=". $array[0];
?>
</body>
</html>