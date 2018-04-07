<?php
include_once('conexao.php');

$usuario = $_POST['usuario'];
$id = $_POST['id'];

$dados = array();

$sql = "DELETE FROM receita WHERE id = $id and usuario_id = $usuario";
		
$result = $conn->query($sql);

if ($result)
{	
	$dados['sucesso'] = "Receita excluida com sucesso.";
}
else
{
	$dados['erro'] = "Receita não foi excluída.";
}	

echo json_encode($dados);

$conn->close();
?>