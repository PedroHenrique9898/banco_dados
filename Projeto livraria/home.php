<?php
session_start();

// Conexão com o banco de dados (usando mysql_*)
$conectar = mysql_connect('localhost', 'root', '');
if (!$conectar) {
    die('Erro de conexão: ' . mysql_error());
}
$db = mysql_select_db('livraria', $conectar);
if (!$db) {
    die('Erro ao selecionar banco: ' . mysql_error());
}

$status = "";
$cart_count = 0;

// Adicionar livro ao carrinho
if (isset($_POST['codigo']) && $_POST['codigo'] != "") {
    $codigo = mysql_real_escape_string($_POST['codigo']);
    $resultado = mysql_query("SELECT resenha, preco, fotocapa1, fotocapa2 FROM livro WHERE codigo = '$codigo'");

    if ($resultado && $row = mysql_fetch_assoc($resultado)) {
        $cartArray = array(
            $codigo => array(
                'resenha'   => $row['resenha'],
                'preco'     => $row['preco'],
                'quantity'  => 1,
                'fotocapa1' => $row['fotocapa1'],
                'fotocapa2' => $row['fotocapa2']
            )
        );

        if (empty($_SESSION["shopping_cart"])) {
            $_SESSION["shopping_cart"] = $cartArray;
            $status = "<div class='box'>Livro foi adicionado ao carrinho!</div>";
        } else {
            $array_keys = array_keys($_SESSION["shopping_cart"]);
            if (in_array($codigo, $array_keys)) {
                $status = "<div class='box' style='color:red;'>Livro já está no carrinho!</div>";
            } else {
                $_SESSION["shopping_cart"] = array_merge($_SESSION["shopping_cart"], $cartArray);
                $status = "<div class='box'>Livro foi adicionado ao carrinho!</div>";
            }
        }
    } else {
        $status = "<div class='box' style='color:red;'>Livro não encontrado!</div>";
    }
}

if (!empty($_SESSION["shopping_cart"])) {
    $cart_count = count($_SESSION["shopping_cart"]);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Pesquisar Livros</title>
    <link rel="stylesheet" href="css.css">
</head>
<body>
<header>
    <img src="logo.avif" alt="Logo" class="logo" style="height: 60px; vertical-align: middle;">
    <a href="http://127.0.0.1:8080/project_livraria/login.html" class="login-btn">Login</a>
    <?php if ($cart_count > 0): ?>
        <div class="cart_div">
            <a href="cart.php">
                <img src="imgg/carrinho.png" height="50" width="50" alt="Carrinho" />
                <span><?= $cart_count ?></span>
            </a>
        </div>
    <?php endif; ?>
    <h1>Livraria - BOOKHOUSE</h1>
</header>

<!-- Carrossel -->
<div class="slider">
    <input type="radio" name="radio-btn" id="radio1" checked>
    <input type="radio" name="radio-btn" id="radio2">
    <input type="radio" name="radio-btn" id="radio3">

    <div class="slides">
        <div class="slide first">
            <img src="imgs/img1.jpg" alt="Imagem 1">
        </div>
        <div class="slide">
            <img src="imgs/img2.jpg" alt="Imagem 2">
        </div>
        <div class="slide">
            <img src="imgs/img3.jpg" alt="Imagem 3">
        </div>
    </div>

    <div class="manual-navigation">
        <label for="radio1" class="manual-btn"></label>
        <label for="radio2" class="manual-btn"></label>
        <label for="radio3" class="manual-btn"></label>
    </div>
</div>

<main>
    <!-- Filtro de Pesquisa -->
    <section class="form-section">
        <h2>Pesquisar Livros</h2>
        <form name="formulario" method="post" action="">
            <div class="form-group">
                <label>Categoria:</label>
                <select name="categoria">
                    <option value="" selected>Selecione...</option>
                    <?php
                    $query = mysql_query("SELECT codigo, nome FROM categoria");
                    while ($categoria = mysql_fetch_assoc($query)) {
                        echo "<option value='{$categoria['codigo']}'>{$categoria['nome']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label>Autor:</label>
                <select name="autor">
                    <option value="" selected>Selecione...</option>
                    <?php
                    $query = mysql_query("SELECT codigo, nome FROM autor");
                    while ($autor = mysql_fetch_assoc($query)) {
                        echo "<option value='{$autor['codigo']}'>{$autor['nome']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label>Editora:</label>
                <select name="editora">
                    <option value="" selected>Selecione...</option>
                    <?php
                    $query = mysql_query("SELECT codigo, nome FROM editora");
                    while ($editora = mysql_fetch_assoc($query)) {
                        echo "<option value='{$editora['codigo']}'>{$editora['nome']}</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" name="pesquisar">Pesquisar</button>
        </form>
    </section>

    <!-- Livros Disponíveis -->
    <h2>Livros Disponíveis</h2>
    <?php
    $sql = "SELECT codigo, fotocapa1, fotocapa2, resenha, preco FROM livro WHERE 1";

    if (isset($_POST['pesquisar'])) {
        if (!empty($_POST['categoria'])) {
            $categoria = mysql_real_escape_string($_POST['categoria']);
            $sql .= " AND codcategoria = '$categoria'";
        }
        if (!empty($_POST['autor'])) {
            $autor = mysql_real_escape_string($_POST['autor']);
            $sql .= " AND codautor = '$autor'";
        }
        if (!empty($_POST['editora'])) {
            $editora = mysql_real_escape_string($_POST['editora']);
            $sql .= " AND codeditora = '$editora'";
        }
    }

    $resultado = mysql_query($sql);
    if (!$resultado) {
        die("Erro na consulta SQL: " . mysql_error() . "<br>Query: $sql");
    }
    echo "<div class='product-list'>";
    while ($row = mysql_fetch_assoc($resultado)) {
        echo "<div class='product_wrapper'>
            <form method='post' action=''>
                <input type='hidden' name='codigo' value='" . $row['codigo'] . "' />
                <div class='image'>
                    <img src='fotos/" . $row['fotocapa1'] . "' height='200' width='140' style='margin:3px;' />
                    <img src='fotos/" . $row['fotocapa2'] . "' height='200' width='140' style='margin:3px;' />
                </div>
                <div class='name'>" . $row['resenha'] . "</div>
                <div class='price'>R$ " . $row['preco'] . "</div>
                <button type='submit' class='buy'>COMPRAR</button>
            </form>
        </div>";
    }
    echo "</div>";
    ?>
</main>

</html>