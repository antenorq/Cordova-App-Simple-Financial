<?php
include_once('conexao.php');
$dados = array();

$login = $_POST['login'];
$senha = md5($_POST['senha']);

$sql = "SELECT * FROM usuario where login='".$login."' and senha='".$senha."'";
$result = $conn->query($sql);

if ($result->num_rows > 0)
{
    while($row = $result->fetch_assoc())
	{
		$dados['login'] = $row["login"];
		$dados['usuario_id'] = $row["id"];
	}
}
else
{
    $dados['erro'] = "Usuário ou Senha Inválidos.";
}

echo json_encode($dados);

$conn->close();
?> 