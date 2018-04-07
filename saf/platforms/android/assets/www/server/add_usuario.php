<?php
include_once('conexao.php');

$nome = $_POST['nome'];
$login = $_POST['login'];
$senha = MD5($_POST['senha']);
$email = $_POST['email'];

$dados = array();

if(empty($nome) or empty($login) or empty($senha) or empty($email))
{
	$dados['erro'] = "Preencha todos os dados";
}
else
{
	$sql = "INSERT INTO usuario (nome,login,senha,email) values ('$nome','$login','$senha','$email')";
	$result = $conn->query($sql);
	
	if ($result)
	{   
		$dados['sucesso'] = "Usuário inserido com sucesso.";
	}
	else
	{
		$dados['erro'] = "Usuário já existe tente outro login.";
	}	
}

echo json_encode($dados);

$conn->close();
?>