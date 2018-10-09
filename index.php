<!Doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Carrinho PHP</title>
  <style type="text/css">
  <!--
  body {
   margin-left: 0px;
   margin-top: 0px;
   margin-right: 0px;
   margin-bottom: 0px;
 }
 -->
</style>
</head>

<body>
  <?php
  /************************************************************************
ARQUIVO .........: Carrinho de compras simples: usando arrays e session
BY ..............: J�lio C�sar Martini - baphp@imasters.com.br
SITE ............: iMasters - http://www.imasters.com.br
DATA ............: 23/05/2004
ADAPTADO GENERICAMENTE PARA AREA ADMINISTRACAO COM ACESSO BD MYSQL POR JOSE IVAN GERALDO DA SILVA
 DUVIDAS :ivan.geraldo@gmail.com
   ************************************************************************/

//INICIALIZA A SESS�O
  session_start();

  include('conecta.php');

// Conex�o ao banco


// Nome da tabela a ter os registros paginados
  $tabela = "produtos";

// sele��o de registro com limita��o da vari�veis de contagem
  $sql = mysqli_query($conexao, "SELECT * FROM $tabela ORDER BY codigo");

  // Mostragem dos dados
  $produto = buscar_produtos($conexao);

//TOTAL DE PRODUTOS POR LINHA
  $total = 2;
  ?>
<table width="773"  border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td><img src="images/topo.gif" width="773" height="100"></td>
  </tr>
  <tr>
    <td>
      <table border="1" width="100%"> 
        <form name="form1" method="post" action="loga.php?acao=logar">
          <tr>
            <td>Login</td>
            <td><input type="text" name="nome"></td>
            <td><a href="cadastro.php">Cadastro</a></td>
            <td><a href="carrinho.php">Carrinho</a></td>
          </tr>
          <tr>
            <td>Senha</td>
            <td> <input type="password" name="pwd"></td>
            <td> &nbsp;</td>
            <td> &nbsp;</td>
            <td> &nbsp;</td>
          </tr>
          <tr>
            <td COLSPAN=5 align=center>
              <input type="submit" name="logar" value="logar">
            </td>
          </tr>
        </form>
      </table>
    </td>
  </tr>
  <tr>
    <td>
      <table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td align='center'><font face="Arial" size="4"><b>MODELO DE CARRINHO DE COMPRAS</b></font></td>
        </tr>
      </table>
      <table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td><font face='Arial' size='2'>Confira abaixo, os produtos dispon&iacute;veis no site:</font> </td>
        </tr>
        <?php
          $sqlC = "SELECT * FROM categorias ";
          $queryC = mysqli_query($conexao,$sqlC);
          while ($sqlC = mysqli_fetch_assoc($queryC))
          {
        echo $sqlC['nome_categoria'].", ";
        } ?>
      </table><br>  
    
      <form action="carrinho.php" method="post" name="frmcarrinho">
       <input type="hidden" name="opc_efetivar" value="1">

       <table width="90%"  border="0" align="center" cellpadding="0" cellspacing="0"> 
         <tr>
          <?php
    	      //PEGA A CHAVE DO ARRAY
            if ($produto == '') {
              echo "voce nao tem nenhum produto cadastrado.entre na area de administracao,com o login :admin/senha:1234<br>
             cadastre alguns produtos e veja.<BR>
             O usuario que ja esta configurado no bd é login:user/senha:1234";
            } else {
              $chave = array_keys($produto);

    	       //EXIBE OS PRODUTOS
              foreach ($produto as $cadaProd) {
                $cadaProd['codigo'];
                $cadaProd['artista'];
                $cadaProd['album'];
                $cadaProd['preco'];
                $cadaProd['imagem'];
                $cadaProd['autorizado'];
                $cadaProd['detalhes'];
              }
           /*   //VERIFICA
              if ($total == $atual) {
                echo "</tr><tr>";
                $atual = 0;
              }
*/          ?>
              <td width="14%" height="100"><a href="verproduto.php?codigo=<?php echo $cadaProd['codigo']; ?>"<img src="mini.php?imagem=<?php echo $cadaProd['imagem']; ?>"  border="0"></td>
              <td width="36%">        
            <table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td><font face='Arial' size='2'><?php echo $cadaProd['artista']; ?></font></td>
              </tr>
              <tr>
                <td><font face='Arial' size='2'><?php echo $cadaProd['album']; ?></font></td>
              </tr>
              <tr>
                <td><font face='Arial' size='2'>R$ <?php echo $cadaProd['preco']; ?></font></td>
              </tr>
              <tr>
                <td>
                  <input type="hidden" name="<?php echo $cadaProd['codigo']?>"  value="<?php echo $cadaProd['codigo']; ?>">
                  <input type="hidden" name="<?php echo $cadaProd['artista']?>"  value="<?php echo $cadaProd['artista']?>">
                  <input type="hidden" name="<?php echo $cadaProd['album']?>"  value="<?php echo $cadaProd['album']?>">
                    <input type="hidden" name="<?php echo $cadaProd['preco']?>"  value="<?php echo $cadaProd['preco']?>">
                  <input type="text" name=""  size="3" maxlength="3">
                   <input type="image" src="images/carrinho.gif" onClick="javascript: document.forms[0].submit();">
                </td>
              </tr>
            </table>
              </td>
              <?php
      	      /* //SOMA 1 A VARI�VEL CONTROLADORA
                $atual++;
            */}
            mysqli_close($conexao);//FEHA FOR ?>
         </tr>
        </table>   
      </form>
    </td>
  </tr>
  <tr>
    <td><img src="images/rodape.gif" width="773" height="20"></td>
  </tr>
  <tr>
    <td align= center><a href="admin/admin.php">ADMINISTRAR</a></td>
  </tr>
</table>
</body>
</html>