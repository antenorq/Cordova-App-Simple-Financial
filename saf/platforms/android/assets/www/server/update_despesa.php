<?php
include_once('conexao.php');

$usuario_id = $_POST["usuario_id"];
$descricao = $_POST['descricao'];
$id = $_POST['id'];
$valor = $_POST['valor'];
$data = implode('-', array_reverse(explode('/', $_POST['data'])));
$categoria = $_POST['categoria'];

$dados = array();

if(empty($descricao) or empty($valor) or empty($categoria))
{
	$dados['erro'] = "Preencha todos os dados";
}
else
{
	$sql = "UPDATE despesa SET descricao='$descricao', valor='$valor', data='$data', categoria_id=$categoria  where id='$id' and usuario_id='$usuario_id'";
	$result = $conn->query($sql);
	
	if ($result)
	{
		$dados['sucesso'] = "Despesa atualizada com sucesso.";
	}
	else
	{
		$dados['erro'] = "Despesa não foi atualizada.";
	}	
}

echo json_encode($dados);

$conn->close();
?>