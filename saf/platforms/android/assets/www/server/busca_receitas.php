<?php
include_once('conexao.php');

$usuario = $_POST['usuario'];

$dados = array();


$sql = "SELECT r.id,DATE_FORMAT(r.data, '%d/%m/%Y') as data, r.descricao,r.valor, c.descricao as categoria from receita as r
		LEFT JOIN categoria as c on c.id = r.categoria_id
		WHERE r.usuario_id = $usuario";
		
		
		
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