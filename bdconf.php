<?php

$host = env('MYSQL_SERVICE_HOST', '');
$port = env('MYSQL_SERVICE_PORT', '');
$conn = @mysql_connect("$host:$port", env('MYSQL_USER', ''), env('MYSQL_PASSWORD', '')) or die (mysql_error());
$conn = mysql_select_db(env('MYSQL_DATABASE', ''), $conn)  or die ('Não foi possivel conectar ao banco de dados...');

?>