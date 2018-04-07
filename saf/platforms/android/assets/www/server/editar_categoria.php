<?php
include_once('conexao.php');

$usuario = $_POST['usuario'];
$id = $_POST['id'];

$dados = array();

$sql = "SELECT * FROM categoria where id = $id and usuario_id = $usuario";
		
$result = $conn->query($sql);

if ($result->num_rows > 0)
{
	while($row = $result->fetch_assoc())
	{
		$dados['id'] = $row["id"];
		$dados['tipo_id'] = $row["tipo_id"];
		$dados['descricao'] = $row["descricao"];
	}
}
else
{
	$dados['erro'] = "Falha ao buscar a categoria";
}	

echo json_encode($dados);

$conn->close();
?>