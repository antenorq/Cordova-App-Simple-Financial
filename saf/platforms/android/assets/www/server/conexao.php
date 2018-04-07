<?php
//header("Access-Control-Allow-Origin: *");
$conn = new mysqli("mysql.iztec.com.br","iztec02","financeiro00","iztec02");


$conn->query("SET NAMES 'utf8'");
$conn->query("SET character_set_connection=utf8");
$conn->query("SET character_set_client=utf8");
$conn->query("SET character_set_results=utf8");



// Check connection
if ($conn->connect_error) 
{
	die("Conexão falhou: " . $conn->connect_error);
}
?>