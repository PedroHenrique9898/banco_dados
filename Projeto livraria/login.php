<?php
// Conectar ao banco com mysqli
$conectar = mysqli_connect('localhost', 'root', '', 'livraria');

if (!$conectar) {
    die("Erro ao conectar com o banco de dados: " . mysqli_connect_error());
}

if (isset($_POST['conectar'])) {
    // Pegando os dados do formulário
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    // Evita SQL Injection
    $login = mysqli_real_escape_string($conectar, $login);
    $senha = mysqli_real_escape_string($conectar, $senha);

    // Consulta ao banco
    $sql = "SELECT login, senha FROM usuario WHERE login = '$login' AND senha = '$senha'";
    $resultado = mysqli_query($conectar, $sql);

    if (mysqli_num_rows($resultado) <= 0) {
        // Login ou senha inválidos
        echo "<script language='javascript' type='text/javascript'>
                alert('Login e/ou senha incorretos');
                window.location.href='login.html';
              </script>";
    } else {
        // Login válido
        setcookie('login', $login, time() + 3600); // cookie de 1 hora
        header('Location: http://127.0.0.1:8080/project_livraria/menu.html');
        exit();
    }
}
?>
