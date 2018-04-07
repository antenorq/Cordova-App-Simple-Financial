<?php
include_once('conexao.php');

$usuario = $_POST['usuario'];
$id = $_POST['id'];

$dados = array();

$sql = "DELETE FROM categoria WHERE id = $id and usuario_id = $usuario";
		
$result = $conn->query($sql);

if ($result)
{	
	$dados['sucesso'] = "Categoria excluida com sucesso.";
}
else
{
	$dados['erro'] = "Categoria não foi excluída, pois deve ter alguma receita ou despesa com essa categoria.";
}	

echo json_encode($dados);

$conn->close();
?>