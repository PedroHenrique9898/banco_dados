<?php
$conectar = mysql_connect('localhost', 'root', '');
if (!$conectar) {
    die('Erro ao conectar ao MySQL: ' . mysql_error());
}
$banco = mysql_select_db("livraria", $conectar);
if (!$banco) {
    die('Erro ao selecionar banco de dados: ' . mysql_error());
}

if (isset($_POST['gravar'])) {
    $codigo        = $_POST['codigo'];
    $titulo        = $_POST['titulo'];
    $nrpaginas     = $_POST['nrpaginas'];
    $ano           = $_POST['ano'];
    $codautor      = $_POST['codautor'];
    $codcategoria  = $_POST['codcategoria'];
    $codeditora    = $_POST['codeditora'];
    $resenha       = $_POST['resenha'];
    $preco         = $_POST['preco'];

    $diretorio = "fotos/";

    $extensao1 = strtolower(substr($_FILES['fotocapa1']['name'], -4));
    $novo_nome1 = md5(time() . rand()) . $extensao1;
    move_uploaded_file($_FILES['fotocapa1']['tmp_name'], $diretorio . $novo_nome1);

    $extensao2 = strtolower(substr($_FILES['fotocapa2']['name'], -4));
    $novo_nome2 = md5(time() . rand()) . $extensao2;
    move_uploaded_file($_FILES['fotocapa2']['tmp_name'], $diretorio . $novo_nome2);

    $sql = "INSERT INTO livro 
        (codigo, titulo, nrpaginas, ano, codautor, codcategoria, codeditora, resenha, preco, fotocapa1, fotocapa2)
        VALUES 
        ('$codigo', '$titulo', '$nrpaginas', '$ano', '$codautor', '$codcategoria', '$codeditora', '$resenha', '$preco', '$novo_nome1', '$novo_nome2')";

    $resultado = mysql_query($sql);

    if ($resultado) {
        echo "Dados informados cadastrados com sucesso.";
    } else {
        echo "Falha ao gravar os dados informados. Erro: " . mysql_error();
    }
}

if (isset($_POST['excluir'])) {
    $codigo = $_POST['codigo'];
    $sql = "DELETE FROM livro WHERE codigo = '$codigo'";
    $resultado = mysql_query($sql);

    if ($resultado) {
        echo 'Exclusão realizada com sucesso.';
    } else {
        echo 'Erro ao excluir dados. Erro: ' . mysql_error();
    }
}

if (isset($_POST['alterar'])) {
    $codigo        = $_POST['codigo'];
    $titulo        = $_POST['titulo'];
    $nrpaginas     = $_POST['nrpaginas'];
    $ano           = $_POST['ano'];
    $codautor      = $_POST['codautor'];
    $codcategoria  = $_POST['codcategoria'];
    $codeditora    = $_POST['codeditora'];
    $resenha       = $_POST['resenha'];
    $preco         = $_POST['preco'];

    $sql = "UPDATE livro SET 
        -- titulo='$titulo', 
        -- nrpaginas='$nrpaginas', 
        -- ano='$ano', 
        -- codautor='$codautor', 
        -- codcategoria='$codcategoria', 
        -- codeditora='$codeditora', 
        resenha='$resenha', 
        preco='$preco'
        WHERE codigo = '$codigo'";
    $resultado = mysql_query($sql);

    if ($resultado) {
        echo 'Dados alterados com sucesso.';
    } else {
        echo 'Erro ao alterar dados. Erro: ' . mysql_error();
    }
}

if (isset($_POST['pesquisar'])) {
    $sql = mysql_query("SELECT codigo, titulo, nrpaginas, ano, codautor, codcategoria, codeditora, resenha, preco, fotocapa1, fotocapa2 FROM livro");

    if (mysql_num_rows($sql) == 0) {
        echo "Desculpe, mas sua pesquisa não retornou resultados.";
    } else {
        echo "<b>Livros Cadastrados:</b><br><br>";
        while ($dados = mysql_fetch_object($sql)) {
            echo "Código: " . $dados->codigo . "<br>";
            echo "Titulo: " . $dados->titulo . "<br>";
            echo "Número de Páginas: " . $dados->nrpaginas . "<br>";
            echo "Ano: " . $dados->ano . "<br>";
            echo "Código do Autor: " . $dados->codautor . "<br>";
            echo "Código da Categoria: " . $dados->codcategoria . "<br>";
            echo "Código da Editora: " . $dados->codeditora . "<br>";
            echo "Resenha: " . $dados->resenha . "<br>";
            echo "Preço: " . $dados->preco . "<br>";
            echo '<img src="fotos/' . $dados->fotocapa1 . '" height="200" width="200" />' . "  ";
            echo '<img src="fotos/' . $dados->fotocapa2 . '" height="200" width="200" />' . "<br><br>";
        }
    }
}
?>