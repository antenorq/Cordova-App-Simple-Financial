<?php
include_once('conexao.php');

$usuario_id = $_POST["usuario_id"];
$descricao = $_POST['descricao'];
$valor = $_POST['valor'];
$data = implode('-', array_reverse(explode('/', $_POST['data'])));
$categoria = $_POST['categoria'];

$dados = array();

if(empty($descricao) or empty($valor) or empty($data) or empty($categoria))
{
	$dados['erro'] = "Preencha todos os dados";
}
else
{
	$sql = "INSERT INTO despesa (descricao,valor,data,categoria_id,usuario_id) values ('$descricao','$valor','$data','$categoria','$usuario_id')";
	$result = $conn->query($sql);
	
	if ($result)
	{	
		$dados['sucesso'] = "Despesa inserida com sucesso.";
	}
	else
	{
		$dados['erro'] = "Despesa não foi inserida.";
	}	
}

echo json_encode($dados);

$conn->close();
?>