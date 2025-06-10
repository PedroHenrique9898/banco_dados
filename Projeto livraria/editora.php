<?php

$conectar = mysql_connect("localhost","root","");
$banco = mysql_select_db("livraria");

if (isset($_POST["Gravar"])){
    $codigo = $_POST["codigo"];
    $nome = $_POST["nome"];
    // pegar as variaveis do inserido no HTML

    // variável que guarda o comando SQL pro BD
    $sql = "insert into editora (codigo, nome) values ('$codigo','$nome')";

    // mandar executar comando SQL
    $resultado = mysql_query($sql);

    // analisar resultado
    if($resultado == TRUE){
        ECHO("Dados gravados com sucesso.");
    }else{
        echo("Erro. Tente novamente.");
    }

}
if(isset($_POST["Alterar"])){
    $codigo = $_POST["codigo"];
    $nome = $_POST["nome"];

    $sql ="update editora set nome = '$nome' where codigo = '$codigo'";

    $resultado = mysql_query($sql);

    if ($resultado = TRUE){
        echo ("Dados alterados com sucesso!");
    }else{
        echo("Erro. Tente novamente.");
    }
}

if(isset($_POST["Excluir"])){
    $codigo = $_POST["codigo"];
    $nome = $_POST["nome"];

    $sql = "delete from ediora where codigo = '$codigo'";

    $resultado = mysql_query($sql);

    if ($resultado = TRUE){
        echo("Dados excluidos com sucesso!");
    }else{
        echo("Erro. Tente novamente.");
    }
}
if(isset($_POST['Pesquisar'])){
    $codigo = $_POST['codigo'];
    $nome   = $_POST['nome'];

    $sql = "select * from editora";

    $resulado = mysql_query($sql);

    if (mysql_num_rows($resultado) == 0){
        echo("Erro. Tente novamente.");
    }else{
        echo "<br>" . "Pesquisa das Editoras:: "."</b><br>";
        while ($dados = mysql_fetch_array($resulado)){
            echo "codigo: " . $dados['codigo'] . "<br>" . "Nome: ".$dados['nome'];
        }
    }
}

?>






    

