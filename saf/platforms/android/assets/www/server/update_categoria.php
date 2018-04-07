<?php
include_once('conexao.php');

$descricao = $_POST['descricao'];
$id = $_POST['id'];
$tipo_id = $_POST['tipo_id'];
$usuario = $_POST['usuario'];

$dados = array();

if(empty($descricao) or empty($tipo_id))
{
	$dados['erro'] = "Preencha todos os dados";
}
else
{
	$sql = "UPDATE categoria SET descricao='$descricao', tipo_id='$tipo_id' where id='$id' and usuario_id='$usuario'";
	$result = $conn->query($sql);
	
	if ($result)
	{   
		$dados['sucesso'] = "Categoria atualizada com sucesso.";
	}
	else
	{
		$dados['erro'] = "Categoria não foi inserida.";
	}	
}

echo json_encode($dados);

$conn->close();
?>