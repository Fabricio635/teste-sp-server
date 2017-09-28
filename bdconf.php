<?php

$conn = @mysql_connect("localhost", "fabricio", "miranda") or die (mysql_error());
//$conn = @mysql_connect("$OPENSHIFT_MYSQL_DB_HOST:$OPENSHIFT_MYSQL_DB_PORT", "adminuHseSMV", "53l_TQarH51S") or die (mysql_error());
$conn = mysql_select_db('teste-sp', $conn)  or die ('Não foi possivel conectar ao banco de dados...');
//$conn = mysql_select_db('php', $conn)  or die ('Não foi possivel conectar ao banco de dados...');

?>