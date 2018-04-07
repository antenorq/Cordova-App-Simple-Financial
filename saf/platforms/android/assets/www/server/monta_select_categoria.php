<?php
include_once('conexao.php');

$usuario_id = $_POST["usuario_id"];
if(isset($_POST['tipo_id']))
{
	$tipo_id = $_POST['tipo_id'];
}

$dados = array();

if(empty($tipo_id))
{
	$sql = "SELECT * FROM categoria where usuario_id = $usuario_id" ;	
}
else
{
	$sql = "SELECT * FROM categoria where tipo_id = $tipo_id and usuario_id = $usuario_id" ;
}

$result = $conn->query($sql);

if ($result->num_rows > 0)
{
	$count=0;
	while($row = $result->fetch_assoc())
	{
		$dados[$count]['id'] = $row["id"];
		$dados[$count]['descricao'] = $row["descricao"];
		$count++;
	}
}
else
{
	$dados['erro'] = "Falha ao buscar categorias";
}

echo json_encode($dados);

$conn->close();
?>