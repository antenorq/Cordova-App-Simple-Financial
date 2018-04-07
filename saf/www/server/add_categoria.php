<?php
include_once('conexao.php');

$descricao = $_POST['descricao'];
$tipo_id = $_POST['tipo_id'];
$usuario = $_POST['usuario'];

$dados = array();

if(empty($descricao) or empty($tipo_id))
{
	$dados['erro'] = "Preencha todos os dados";
}
else
{
	$sql = "INSERT INTO categoria (descricao,tipo_id,usuario_id) values ('$descricao','$tipo_id','$usuario')";
	$result = $conn->query($sql);
	
	if ($result)
	{   
		$dados['sucesso'] = "Categoria inserida com sucesso.";
	}
	else
	{
		$dados['erro'] = "Categoria não foi inserida.";
	}	
}

echo json_encode($dados);

$conn->close();
?>