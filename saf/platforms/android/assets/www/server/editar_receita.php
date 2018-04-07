<?php
include_once('conexao.php');

$usuario = $_POST['usuario'];
$id = $_POST['id'];

$dados = array();

$sql = "SELECT * FROM receita where id = $id and usuario_id = $usuario";
		
$result = $conn->query($sql);

if ($result->num_rows > 0)
{
	while($row = $result->fetch_assoc())
	{
		$dados['id'] = $row["id"];		
		$dados['descricao'] = $row["descricao"];
		$dados['valor'] = $row["valor"];
		$dados['data'] = implode('/', array_reverse(explode('-', $row["data"])));
		$dados['categoria_id'] = $row["categoria_id"];
	}
}
else
{
	$dados['erro'] = "Falha ao buscar a receita";
}	

echo json_encode($dados);

$conn->close();
?>