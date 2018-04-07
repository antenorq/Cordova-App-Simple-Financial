<?php
include_once('conexao.php');

$usuario = $_POST['usuario'];

$dados = array();


$sql = "SELECT c.id, tc.descricao as tipo_categoria, c.descricao as categoria from categoria as c
		LEFT JOIN tipo_categoria as tc on tc.id = c.tipo_id
		WHERE usuario_id = $usuario";
		
$result = $conn->query($sql);

if ($result->num_rows > 0)
{		
	foreach ($result as $row) {
        $rows[] = $row;
	}
	$dados['data'] = $rows;
}
else
{
	$dados['erro'] = "Resultado não retornado";
}

echo json_encode($dados);

$conn->close();
?>