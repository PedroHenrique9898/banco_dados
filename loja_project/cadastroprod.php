<?php
//conectar com o servidor e banco
$conectar = mysql_connect('localhost','root','');
$banco    = mysql_select_db("loja");

if (isset($_POST['gravar']))
{
    $cod_produto         = $_POST['cod_produto'];
    $descricao           = $_POST['descricao'];
    $cor                 = $_POST['cor'];
    $tamanho             = $_POST['tamanho'];
    $preco               = $_POST['preco'];
    $cod_marca           = $_POST['cod_marca'];
    $cod_categoria       = $_POST['cod_categoria'];
    $cod_tipo            = $_POST['cod_tipo'];
    $foto1               = $_FILES['foto1'];
    $foto2               = $_FILES['foto2'];

    

//PARA CONHECIMENTO, CRIPTOGRAFIA DE classificacao
//$classificacao = md5 ($_POST['classificacao']);

    //criar pasta e mover arquivos img
    $diretorio = "fotos/";

    $extensao1 = strtolower(substr($_FILES['foto1']['name'], -4));
    $novo_nome1 = md5(time().$extensao1);
    move_uploaded_file($_FILES['foto1']['tmp_name'], $diretorio.$novo_nome1);

    $extensao2 = strtolower(substr($_FILES['foto2']['name'], -6));
    $novo_nome2 = md5(time().$extensao2);
    move_uploaded_file($_FILES['foto2']['tmp_name'], $diretorio.$novo_nome2);


  

   $sql = "INSERT INTO produto (descricao,cor,tamanho,preco,cod_marca,cod_categoria,cod_tipo, foto1,foto2)
           values ('$descricao','$cor','$tamanho','$preco','$cod_marca','$cod_categoria','$cod_tipo','$novo_nome1','$novo_nome2')";

   

   $resultado = mysql_query($sql);

   if ($resultado == TRUE)
   {
      echo "Dados informados cadastrados com sucesso ";
   }
   else
   {
      echo "Falha ao gravar os dados informados";
   }
}

if (isset($_POST['excluir']))
{
   $cod_produto         = $_POST['cod_produto'];
   $descricao           = $_POST['descricao'];
   $cor                 = $_POST['cor'];
   $tamanho             = $_POST['tamanho'];
   $preco               = $_POST['preco'];
   $cod_marca           = $_POST['cod_marca'];
   $cod_categoria       = $_POST['cod_categoria'];
   $cod_tipo            = $_POST['cod_tipo'];
   $foto1               = $_FILES['foto1'];
   $foto2               = $_FILES['foto2'];

  $sql = "DELETE FROM produto WHERE cod_produto = '$cod_produto'";

  $resultado = mysql_query($sql);

  if ($resultado === TRUE)
  {
     echo 'Exclusao realizada com Sucesso';
  }
  else
  {
     echo 'Erro ao excluir dados.';
  }
}

if (isset($_POST['alterar']))
{
   $cod_produto         = $_POST['cod_produto'];
   $descricao           = $_POST['descricao'];
   $cor                 = $_POST['cor'];
   $tamanho             = $_POST['tamanho'];
   $preco               = $_POST['preco'];
   $cod_marca           = $_POST['cod_marca'];
   $cod_categoria       = $_POST['cod_categoria'];
   $cod_tipo            = $_POST['cod_tipo'];
   $foto1               = $_FILES['foto1'];
   $foto2               = $_FILES['foto2'];

  $sql = "UPDATE produto SET descricao='$descricao',cod_tipo='$cod_tipo',preco='$preco'
          WHERE cod_produto = '$cod_produto'";
  $resultado = mysql_query($sql);

  if ($resultado === TRUE)
  {
     echo 'Dados alterados com Sucesso';
  }
  else
  {
     echo 'Erro ao alterar dados.';
  }
}

if (isset($_POST['pesquisar']))
{
   $sql = mysql_query("SELECT cod_produto,descricao,cod_categoria,cod_tipo,cod_marca,cor,tamanho,preco,foto1,foto2 FROM produto");
   
   if (mysql_num_rows($sql) == 0)
         {echo "Desculpe, mas sua pesquisa não retornou resultados.";}
   else
        {
        echo "<b>Produtos Cadastrados:</b><br><br>";
        while ($dados = mysql_fetch_object($sql))
 	        {
                echo "cod_odigo           : ".$dados->cod_produto  ." ";
                echo "Descricao           : ".$dados->descricao    ."<br>";
                echo "cod_categoria       : ".$dados->cod_categoria." ";
                echo "Tipo                : ".$dados->cod_tipo     ." ";
                echo "cod_marca           : ".$dados->cod_marca    ."";  
                echo "Cor                 : ".$dados->cor          ."<br>";
                echo "Tamanho             : ".$dados->tamanho      ." ";
                echo "Preco               : ".$dados->preco        ."<br>";
                echo '<img src="fotos/'.$dados->foto1         .'"height="200" width="200" />'."  ";
                echo '<img src="fotos/'.$dados->foto2         .'"height="200" width="200" />'."<br><br>";
            }
        }
}
?>