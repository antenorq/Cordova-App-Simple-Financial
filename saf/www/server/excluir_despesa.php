<?php
include_once('conexao.php');

$usuario = $_POST['usuario'];
$id = $_POST['id'];

$dados = array();

$sql = "DELETE FROM despesa WHERE id = $id and usuario_id = $usuario";
		
$result = $conn->query($sql);

if ($result)
{	
	$dados['sucesso'] = "Despesa excluida com sucesso.";
}
else
{
	$dados['erro'] = "Despesa não foi excluída.";
}	

echo json_encode($dados);

$conn->close();
?>