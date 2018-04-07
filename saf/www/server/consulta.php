<?php
include_once('conexao.php');

$data_de = implode('-', array_reverse(explode('/', $_POST["data_de"])));
$data_ate = implode('-', array_reverse(explode('/', $_POST["data_ate"])));
$tipo = $_POST['tipo'];
$categoria = $_POST['categoria'];
$usuario_id = $_POST["usuario_id"];

$dados = array();
$sql='';

if(empty($data_de) or empty($data_ate) or $tipo == '' or $categoria == '')
{
	$dados['erro'] = "Preencha todos os dados";
}
else
{
	
	if($tipo==0) //TODOS
	{
		$sql = "
			(
			SELECT DATE_FORMAT(r.data, '%d/%m/%Y') as data,r.descricao, valor, r.usuario_id, tc.id as tipo, cat.descricao as categoria
			FROM receita r, categoria cat, tipo_categoria tc

			where r.usuario_id = $usuario_id and
				  r.categoria_id = cat.id and
				  cat.tipo_id = tc.id and				  
			";
			
			if($categoria > 0){	$sql .= "r.categoria_id = $categoria and";	}
			
			$sql .=
			" 	  data BETWEEN '$data_de' and '$data_ate'
			)      
			UNION
			(
			SELECT DATE_FORMAT(d.data, '%d/%m/%Y') as data,d.descricao, valor, d.usuario_id, tc.id as tipo, cat.descricao as categoria

			FROM despesa d, categoria cat, tipo_categoria tc

			where d.usuario_id = $usuario_id and
				  d.categoria_id = cat.id and
				  cat.tipo_id = tc.id and
			
			";
			
			if($categoria > 0){	$sql .= "d.categoria_id = $categoria and";	}
			
			$sql .=
			"	 data BETWEEN '$data_de' and '$data_ate'
			)
			order by tipo asc
			";
	}
	
	if($tipo==1) //RECEITA
	{
		$sql = "			
			SELECT DATE_FORMAT(r.data, '%d/%m/%Y') as data,r.descricao, valor, r.usuario_id, tc.id as tipo, cat.descricao as categoria
			FROM receita r, categoria cat, tipo_categoria tc

			where r.usuario_id = 1 and
				  r.categoria_id = cat.id and
				  cat.tipo_id = tc.id and
			";
			
			if($categoria > 0){	$sql .= "r.categoria_id = $categoria and";	}
			
			$sql .=
			"	  data BETWEEN '$data_de' and '$data_ate'

			order by tipo asc
			";
	}
	if($tipo==2) //DESPESA
	{
		$sql = "			
			SELECT DATE_FORMAT(d.data, '%d/%m/%Y') as data,d.descricao, valor, d.usuario_id, tc.id as tipo, cat.descricao as categoria
			FROM despesa d, categoria cat, tipo_categoria tc

			where d.usuario_id = 1 and
				  d.categoria_id = cat.id and
				  cat.tipo_id = tc.id and
			";
			
			if($categoria > 0){	$sql .= "d.categoria_id = $categoria and";}
			
			$sql .=
			"	  data BETWEEN '$data_de' and '$data_ate'

			order by tipo asc
			";
	}
	
	
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
	
}

echo json_encode($dados);

$conn->close();
?>