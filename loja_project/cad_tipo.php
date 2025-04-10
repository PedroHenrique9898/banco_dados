<?php

// fazer conexão com o banco
$conectar = mysql_connect("localhost","root","");
$banco = mysql_select_db("loja");

// if para a opção dos botões
if(isset($_POST['Gravar'])){
    $cod_tipo = $_POST['cod_tipo'];
    $nome      = $_POST['nome'];
    // capturar as variáveis inseridas no HTML

    // variável que guarda o comando SQL pro BD
    $sql = "insert into tipo (nome) values ('$nome')";

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
    $cod_tipo = $_POST['cod_tipo'];
    $nome      = $_POST['nome'];

    $sql = "update tipo set nome = '$nome'where cod_tipo = '$cod_tipo'";

    $resultado = mysql_query($sql);

    if ($resultado == TRUE){
        echo("Dados alterados com sucesso!");
    }
    else{
        echo("Erro. Tente novamente.");
    }
}

if(isset($_POST['Excluir'])){
    $cod_tipo = $_POST['cod_tipo'];
    $nome      = $_POST['nome'];


    $sql = "delete from tipo where cod_tipo = '$cod_tipo'";

    $resultado = mysql_query($sql);

    if ($resultado == TRUE){
        echo("Dados excluídos com sucesso!");
    }
    else{
        echo("Erro. Tente novamente.");
    }
}

if(isset($_POST['Pesquisar'])){
    $cod_tipo = $_POST['cod_tipo'];
    $nome      = $_POST['nome'];


    $sql = "select * from tipo";

    $resultado = mysql_query($sql);

    if (mysql_num_rows($resultado) == 0){
        echo "Erro. Tente novamente";
    }
    else{
        echo "<b>"."Pesquisa de Marcas: "."</b><br>";
        
        while ($dados = mysql_fetch_array($resultado)){
                echo "cod_tipo: " . $dados['cod_tipo'] . "<br>" . "Nome: ".$dados['nome'];
            }
    }
}

?>