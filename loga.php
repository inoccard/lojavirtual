<?php
session_start();
  include('conecta.php');

if ($_GET['acao'] == "logar") {
    $conn = mysqli_connect("localhost", "root", "", "comercio"); //configure os dados do seu MySQL
    if (mysqli_connect_errno($conexao)) {
        echo "Problemas para conectar no banco. Verifique os dados!";
        die();
    }

    $nome = $_POST['nome'];
    $q_user = mysqli_query($conexao,"SELECT * FROM usuarios WHERE login='$nome'");

    if (mysqli_num_rows($q_user) == 1) {

        $query = mysqli_query($conexao,"SELECT * FROM usuarios WHERE login='$nome'");
        $dados = mysqli_fetch_array($query);
        if ($_POST['pwd'] == $dados['senha'] and $nome == 'admin') {
            $_SESSION["qwert"] = $nome;
            header("Location: admin/admin.php");
            exit;
        }
        if ($_POST['pwd'] == $dados['senha'] and $nome != 'admin') {
            $_SESSION["qwert"] = $nome;
            header("Location:index.php");
            exit;
        } else {
            header("Location: login.php?login=falhou&causa=" . urlencode('Senha Errada'));
            exit;
        }
    } else {
        header("Location: login.php?login=falhou&causa=" . urlencode('User Inv�lido'));
        exit;
    }
}

//agora a parte que verifica se o login j� foi feito
if ($_SESSION["nome"] == false) {
    header("Location: login.php");
}
?>

