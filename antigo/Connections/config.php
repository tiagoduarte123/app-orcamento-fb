<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_config = "mysql1.000webhost.com";
$database_config = "a6128951_tiago";
$username_config = "a6128951_tiago";
$password_config = "1234567a";
$config = mysql_pconnect($hostname_config, $username_config, $password_config) or trigger_error(mysql_error(),E_USER_ERROR); 
?>