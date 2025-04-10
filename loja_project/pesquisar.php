<?php
$connect = mysql_connect('localhost','root','');
$db      = mysql_select_db('loja');
?>

<HTML>
<HEAD>
 <TITLE> Home - Pgina de Esporte</TITLE>
</HEAD>
<body>
    <form name="formulario" method="post" action="pesquisar.php">
       <img src="logo.avif" width=200 height=150 align="left">
       <a href="http://127.0.0.1:8080/teste/menu.html"><img src="login.png" width=130 height=60 align="right"></a>
       <br><br>
       <h1>Esportes da Comets</h1><br>
       <br><br>
       <h1>Pesquisas:</h1> 
       
       <!------ pesquisar Categorias -------------->
        <label for="">Categorias: </label>
        <select name="categoria">
        <option value="" selected="selected">Selecione...</option>

        <?php
        $query = mysql_query("SELECT cod_categoria, nome FROM categoria");
        while($categoria = mysql_fetch_array($query))
        {?>
        <option value="<?php echo $categoria['codigo']?>">
                       <?php echo $categoria['nome']   ?></option>
        <?php }
        ?>
        </select>
        
        <!------ pesquisar Classificacao -------------->
        <label for="">Tipo: </label>
        <select name="tipo">
        <option value="" selected="selected">Selecione...</option>

        <?php
        $query = mysql_query("SELECT cod_tipo, nome FROM tipo");
        while($tipo = mysql_fetch_array($query))
        {?>
        <option value="<?php echo $tipo['cod_tipo']?>">
                       <?php echo $tipo['nome']   ?></option>
        <?php }
        ?>
        </select>
        
       <!------ pesquisar marcas -------------->
       <label for="">Marcas: </label>
        <select name="marca">
        <option value="" selected="selected">Selecione...</option>

        <?php
        $query = mysql_query("SELECT cod_marca, nome FROM marca");
        while($marca = mysql_fetch_array($query))
        {?>
        <option value="<?php echo $marca['cod_marca']?>">
                       <?php echo $marca['nome']   ?></option>
        <?php }
        ?>
        </select>

        <input  type="submit" name="pesquisar" value="Pesquisar">
    </form>
<br><br>
<?php

if (isset($_POST['pesquisar']))
{
   $sql_produtos = "SELECT produto.descricao,produto.cor,produto.tamanho,produto.preco,produto.foto1,produto.foto2
   FROM produto";
   
   $seleciona_produtos = mysql_query($sql_produtos);

   //verifica que a op��o marca e modelo foi selecionada ou n�o
$marca          = (empty($_POST['marca']))? 'null' : $_POST['marca'];
$categoria      = (empty($_POST['categoria']))? 'null' : $_POST['categoria'];
$tipo  = (empty($_POST['tipo']))? 'null' : $_POST['tipo'];

//---------- pesquisar  marca escolhida ----------------

if (($marca <> 'null') and ($categoria == 'null') and ($tipo == 'null'))
{
     $sql_produtos       = "SELECT produto.descricao,produto.cor,produto.tamanho,produto.preco,produto.foto1,produto.foto2
                            FROM produto, marca, categoria,tipo
                            WHERE produto.cod_marca = marca.codigo
                            and produto.cod_categoria = categoria.codigo
                            and produto.cod_tipo = tipo.codigo
                            and marca.codigo = '$marca'";
                            
     $seleciona_produtos = mysql_query($sql_produtos);
}


if (($marca == 'null') and ($categoria <> 'null') and ($tipo == 'null'))
{
     $sql_produtos       = "SELECT produto.descricao,produto.cor,produto.tamanho,produto.preco,produto.foto1,produto.foto2
                            FROM produto, marca, categoria,tipo
                            WHERE produto.cod_marca = marca.codigo
                            and produto.cod_categoria = categoria.codigo
                            and produto.cod_tipo = tipo.codigo
                            and categoria.codigo = '$categoria'";
                            
     $seleciona_produtos = mysql_query($sql_produtos);
}

if (($marca == 'null') and ($categoria == 'null') and ($tipo <> 'null'))
{
     $sql_produtos       = "SELECT produto.descricao,produto.cor,produto.tamanho,produto.preco,produto.foto1,produto.foto2
                            FROM produto, marca, categoria,tipo
                            WHERE produto.cod_marca = marca.codigo
                            and produto.cod_categoria = categoria.codigo
                            and produto.cod_tipo = tipo.codigo
                            and tipo.codigo = '$tipo'";
                            
     $seleciona_produtos = mysql_query($sql_produtos);
}

if (($marca <> 'null') and ($categoria <> 'null') and ($tipo <> 'null'))
{
     $sql_produtos       = "SELECT produto.descricao,produto.cod_categoria,produto.cor,produto.tamanho,produto.preco,produto.foto1,produto.foto2
                            FROM produto, marca, categoria,tipo
                            WHERE produto.cod_marca = marca.codigo
                            and produto.cod_categoria = categoria.codigo
                            and produto.cod_tipo = tipo.codigo
                            and marca.codigo = $marca and categoria.codigo = '$categoria' and tipo.codigo = '$tipo' ";
     $seleciona_produtos = mysql_query($sql_produtos);
}

//---------- pesquisar categoria escolhida ----------------

//---------- pesquisar marca e categoria escolhida ----------------

//---------- pesquisar classificacao escolhida ----------------

//---------- pesquisar marca e categoria e classificacao escolhido ----------------

// colocar mais filtros ?????



//---------- mostrar as informa��es dos produtos  ----------------
if(mysql_num_rows($seleciona_produtos) == 0)
{
   echo 'Desculpe, mas sua busca nao retornou resultados ...';
}
else
{
   echo "Resultado da pesquisa de Produtos: <br><br>";
    while ($dados = mysql_fetch_object($seleciona_produtos))
	{
      echo "Descri��o :".$dados->descricao." ";
      echo "  Cor       : ".$dados->cor." ";
      echo "  Tamanho   : ".$dados->tamanho." ";
      echo "  Preco R$  : ".$dados->preco."<br>";
      echo '<img src=".fotos/'.$dados->foto1.'" height="100" width="150" />'." ";
      echo '<img src=".fotos/'.$dados->foto2.'" height="100" width="150" />'."<br><br>";
	}
   }
}
?>
</body>

</HTML>
