<?php
session_start();

// Conexão com o banco de dados
$conectar = mysql_connect('localhost', 'root', '');
if (!$conectar) {
    die('Erro ao conectar ao banco de dados: ' . mysql_error());
}

$status = "";

// Atualizar quantidade do produto
if (isset($_POST['action']) && $_POST['action'] === "update_quantity") {
    $codigo = $_POST['cod_produto'];
    $new_quantity = intval($_POST['quantity']);
    if ($new_quantity > 0 && isset($_SESSION["shopping_cart"][$codigo])) {
        $_SESSION["shopping_cart"][$codigo]['quantity'] = $new_quantity;
        $status = "<div class='box'>Quantidade atualizada com sucesso!</div>";
    } else {
        $status = "<div class='box' style='color:red;'>Quantidade inválida!</div>";
    }
}

// Remover produto do carrinho
if (isset($_POST['action']) && $_POST['action'] === "remove") {
    $codigo = $_POST['cod_produto'];
    if (isset($_SESSION["shopping_cart"][$codigo])) {
        unset($_SESSION["shopping_cart"][$codigo]);
        $status = "<div class='box' style='color:red;'>Produto removido com sucesso!</div>";
    } else {
        $status = "<div class='box' style='color:red;'>Produto não encontrado no carrinho!</div>";
    }
}

// Limpar carrinho se estiver vazio
if (empty($_SESSION["shopping_cart"])) {
    unset($_SESSION["shopping_cart"]);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Carrinho de Livros</title>
    <link rel="stylesheet" href="css.css">
</head>
<body>
<div class="cart">
    <?php
    if (!empty($_SESSION["shopping_cart"])) {
        $total_price = 0;
    ?>
    <h3>Seu Carrinho de livros</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Imagem</th>
                <th>Descrição</th>
                <th>Preço Unitário</th>
                <th>Quantidade</th>
                <th>Total</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($_SESSION["shopping_cart"] as $codigo => $product) {
                $total_price += $product["preco"] * $product["quantity"];
            ?>
            <tr>
                <td><img src="Fotos/<?php echo $product["fotocapa1"]; ?>" width="100" height="100" /></td>
                <td><?php echo $product["resenha"]; ?></td>
                <td>R$ <?php echo $product["preco"]; ?></td>
                <td>
                    <form method="post" action="">
                        <input type="hidden" name="action" value="update_quantity">
                        <input type="hidden" name="cod_produto" value="<?php echo $codigo; ?>">
                        <input type="number" name="quantity" value="<?php echo $product["quantity"]; ?>" min="1" style="width: 50px;">
                        <button type="submit">Atualizar</button>
                    </form>
                </td>
                <td>R$ <?php echo $product["preco"] * $product["quantity"]; ?></td>
                <td>
                    <form method="post" action="">
                        <input type="hidden" name="action" value="remove">
                        <input type="hidden" name="cod_produto" value="<?php echo $codigo; ?>">
                        <button type="submit" class="remove">Remover</button>
                    </form>
                </td>
            </tr>
            <?php } ?>
            <tr>
                <td colspan="4" align="right"><strong>Total:</strong></td>
                <td><strong>R$ <?php echo $total_price; ?></strong></td>
                <td></td>
            </tr>
        </tbody>
    </table>
    <?php
    } else {
        echo "<h3>Seu carrinho está vazio!</h3>";
    }
    ?>
</div>

<div style="clear:both;"></div>

<div class="message_box" style="margin:10px 0px;">
    <?php echo $status; ?>
</div>
</body>
</html>