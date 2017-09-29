<?php

$host = "localhost";
$port = "3306";
$conn = @mysql_connect($host, "usuario", "senha") or die (mysql_error());
$conn = mysql_select_db("br", $conn)  or die ('Não foi possivel conectar ao banco de dados...');

?>