<?php
include_once('conexao.php');

$usuario_id = $_POST['usuario_id'];
$antiga_senha = MD5($_POST['antiga_senha']);
$nova_senha = MD5($_POST['nova_senha']);

$dados = array();

if(empty($_POST['antiga_senha']) or empty($_POST['nova_senha']))
{
	$dados['erro'] = "Preencha todos os dados";
}
else
{
	$sql1 = "SELECT * from usuario where senha = '$antiga_senha' and id = '$usuario_id' ";
	$result1 = $conn->query($sql1);
	
	if ($result1->num_rows > 0)
	{
		$sql = "UPDATE usuario set senha = '$nova_senha' where id = '$usuario_id' ";
		$result = $conn->query($sql);
		
		if ($result)
		{   
			$dados['sucesso'] = "Senha atualizada com sucesso.";
		}
		else
		{
			$dados['erro'] = "Senha não foi atualizada.";
		}	
	}
	else
	{
		$dados['erro'] = "Senha antiga digitada errada.";
	}

	
	
}

echo json_encode($dados);

$conn->close();
?>