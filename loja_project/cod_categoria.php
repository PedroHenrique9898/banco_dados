<?php

// fazer conexão com o banco
$conectar = mysql_connect("localhost","root","");
$banco = mysql_select_db("loja");

// if para a opção dos botões
if(isset($_POST['Gravar'])){
    $cod_categoria = $_POST['cod_categoria'];
    $nome      = $_POST['nome'];
    // capturar as variáveis inseridas no HTML

    // variável que guarda o comando SQL pro BD
    $sql = "insert into categoria (nome) values ('$nome')";

    // mandar executar comando SQL
    $resultado = mysql_query($sql);

    // analisar resultado
    if ($resultado == TRUE){
        echo("Dados gravados com sucesso.");
    }
    else{
        echo("Erro. Tente novamente.");
    }

}

if(isset($_POST['Alterar'])){
    $cod_categoria = $_POST['cod_categoria'];
    $nome      = $_POST['nome'];

    $sql = "update categoria set nome = '$nome' where cod_categoria = '$cod_categoria'";

    $resultado = mysql_query($sql);

    if ($resultado == TRUE){
        echo("Dados alterados com sucesso!");
    }
    else{
        echo("Erro. Tente novamente.");
    }
}

if(isset($_POST['Excluir'])){
    $cod_categoria = $_POST['cod_categoria'];
    $nome      = $_POST['nome'];


    $sql = "delete from categoria where cod_categoria = '$cod_categoria'";

    $resultado = mysql_query($sql);

    if ($resultado == TRUE){
        echo("Dados excluídos com sucesso!");
    }
    else{
        echo("Erro. Tente novamente.");
    }
}

if(isset($_POST['Pesquisar'])){
    $cod_categoria = $_POST['cod_categoria'];
    $nome      = $_POST['nome'];


    $sql = "select * from categoria";

    $resultado = mysql_query($sql);

    if (mysql_num_rows($resultado) == 0){
        echo "Erro. Tente novamente";
    }
    else{
        echo "<b>"."Pesquisa de Categoria: "."</b><br>";
        
        while ($dados = mysql_fetch_array($resultado)){
                echo "codigo da categoria: " . $dados['cod_categoria']. "<br>" . "Nome: ".$dados['nome'];
            }
    }
}

?>