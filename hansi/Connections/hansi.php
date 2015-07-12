<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_hansi = "localhost";
$database_hansi = "supnet1";
$username_hansi = "root";
$password_hansi = "";
$hansi = mysql_pconnect($hostname_hansi, $username_hansi, $password_hansi) or trigger_error(mysql_error(),E_USER_ERROR); 
?>