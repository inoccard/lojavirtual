<?php
$host = "localhost";
$user = "root";
$senha = "";
$dbname = "comercio";
$conexao = mysqli_connect($host, $user, $senha, $dbname);

function buscar_produtos($conexao){
	$slqBuscarProd = "SELECT * FROM produtos ORDER BY codigo";
	$resultado = mysqli_query($conexao, $slqBuscarProd);
	while ($produto = mysqli_fetch_assoc($resultado)) {
		$produtos[] = $produto;
	}
	return $produtos;
}

function busca_cliente($conexao, $id)
{
	$sqlBusca = 'SELECT * FROM usuarios WHERE codigo = ' . $id;
	$resultado = mysqli_query($conexao, $sqlBusca);
	return mysqli_fetch_assoc($resultado);
}
?>
