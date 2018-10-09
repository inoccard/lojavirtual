 <?php
session_start() ;
  // Conexão ao banco
  // Página que faz conexão ao banco
  include ('../conecta.php');
if(!isset($_SESSION["qwert"])) {
  echo "Você precisa estar conectado para ver esta área<br>faça seu <a href=\"../login.php\">login</a>";
}
else {
  echo "Olá&nbsp;". $_SESSION["qwert"];
  echo "&nbsp;<a href=logoutadmin.php>sair</a>"; ?>

  <!DOCTYPE html>
  <html>
  <head>
    <title>PAGINA ADMINISTRAÇÃO DE PRODUTOS</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <link href="text.css" rel="stylesheet" type="text/css">
  </head>
  <body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

  <?php
    $campo1='CODIGO';
    $campo2='Categoria';
    $campo3='Sub-Categoria';
    $campo4='Artista';
    $campo5='Album';
    $campo6='Preco';
    $campo7='Imagem';
    $campo8='Detalhes';
    $campo9='Disponivel';
    $campo10='Alterar';
    $campo11='Excluir';
  ?>

  <table border=1 cellpadding=1 cellspacing=5>
    <tr>
      <td >
        <div align="center"><?phpecho $campo1 ?></div>
      </td>
      <td >
        <div align="center"><?phpecho $campo2 ?></div>
      </td>
      <td >
        <div align="center"><?phpecho $campo3 ?></div>
      </td>
      <td >
        <div align="center"><?phpecho $campo4 ?></div>
      </td>
      <td >
        <div align="center"><?phpecho $campo5 ?></div>
      </td>
      <td >
        <div align="center"><?phpecho $campo6 ?></div>
      </td>
      <td >
        <div align="center"><?phpecho $campo7 ?></div>
      </td>
      <td >
        <div align="center"><?phpecho $campo8 ?></div>
      </td>
      <td >
        <div align="center"><?phpecho $campo9 ?></div>
      </td>
      <td >
        <div align="center"><?phpecho $campo10 ?></div>
      </td>
      <td >
        <div align="center"><?phpecho $campo11 ?></div>
      </td>
    </tr>
  
    <?php
      include ('../admin/pagina.php');

      // Nome da tabela a ter os registros paginados
      $tabela="produtos";
      // Verifica se a variável de complementação de link está vazia
      if($_REQUEST['pagina']==0) {
        $pagina="1";
      }else{
           $pagina=$_REQUEST["pagina"];
      }

      // quantidade de registro por paginação
      $maximo="10";

      // Variáveis de contagem de registro
      $inicio=$pagina-1;
      $inicio=$maximo*$inicio;

      // seleção de registro com limitação da variáveis de contagem
      $sql=mysqli_query($conexao,"SELECT * FROM $tabela ORDER BY codigo LIMIT $inicio,$maximo");

      // Mostragem dos dados
      while($dados=mysqli_fetch_array ($sql)) {
        $nome1 = $dados[0];
        $nome2 = $dados[1];
        $nome3 = $dados[2];
        $nome4 = $dados[3];//PRECO
        $nome4=number_format($nome4, 2, ',', '.'); //preco formatado para padrao brasileiro
        $nome5 = $dados[4];
        $nome6= $dados[5];
        $nome7= $dados[6];
        echo "<tr>";
          echo "<td>$nome1</td>";
          echo "<td>$nome2</td>";
          echo "<td>$nome3</td>";
          echo "<td>$nome4</td>";
          echo "<td ><img src=../mini.php?imagem=$nome5></td>";
          echo "<td >$nome6</td>";
          if ($nome7 == 'sim'){
            echo "<td ><font color=\"#3da35b\">$nome7</font><br></td>";
          }
          else {
            echo "<td ><font color=\"#cb0a0f\">$nome7</font><br></td>";
          }
          echo "<td ><a href=\"alterar_produtos.php?codigo=$nome1\">Alterar</a><br></td>";
          echo "<td ><a href=\"excluir_produtos.php?codigo=$nome1&endereco=$nome5\">Excluir</a><br></td>";
          echo "</tr>";
          echo "<br>";
      }
      mysqli_free_result($sql);
    ?>
  </table><br>

  <?php
    // Calculando pagina anterior
    $menos=$pagina-1;

    // Calculando pagina posterior
    $mais=$pagina+1;

    // Calculos para a mostragem de paginas
    $p_ini=$mais-1;
    $p_ini=$maximo*$p_ini;

    // Querys para a mostragem de paginas
    $p_query=mysqli_query($conexao,"SELECT * FROM $tabela LIMIT $p_ini,$maximo");
    $p_total=mysqli_num_rows($p_query);
    mysqli_close($conexao);
    // Mostragem de pagina
    if($menos>0) {
       echo "<a href=\"?pagina=$menos\">:: anterior</a> ";
    } if($p_total>0) {
       echo  "<a href=\"?pagina=$mais\">proxima ::</a>";
    }
    echo  "<a href=\"foto.php\">ACRESCENTAR ::</a>";
}
  ?>