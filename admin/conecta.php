<?php$host = "localhost";
$user = "root";
$senha = "";
$dbname = "comercio";
$conexao = mysqli_connect($host, $user, $senha,$dbname);
if (mysqli_connect_errno($conexao)) {
	echo "N�o foi poss�vel conectar-se com o banco de dados");
	die();
}
?>