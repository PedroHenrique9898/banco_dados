<?php
session_start();
$status="";

if (isset($_POST['action']) && $_POST['action']=="remove"){
if(!empty($_SESSION["shopping_cart"])) {
    foreach($_SESSION["shopping_cart"] as $key => $value) {
      if($_POST["code"] == $key){
      unset($_SESSION["shopping_cart"][$key]);
      $status = "<div class='box' style='color:red;'>
      Product is removed from your cart!</div>";
      }
      if(empty($_SESSION["shopping_cart"]))
      unset($_SESSION["shopping_cart"]);
      }
}
}

if (isset($_POST['action']) && $_POST['action']=="change"){
  foreach($_SESSION["shopping_cart"] as &$value){
    if($value['code'] === $_POST["code"]){
        $value['quantity'] = $_POST["quantity"];
        break; 
    }
}

}
?>
<HTML lang="pt-BR">
  <HEAD>
   <TITLE>Carrinho de Livros</TITLE>
   <link rel="stylesheet" href="css.css">
  </HEAD>
<BODY>

<div class="cart">
<?php
if (!empty($_SESSION["shopping_cart"])) {
    $total_price = 0;
?>
<table class="table">
    <tbody>
        <tr>
            <td>Imagem</td>
            <td>Nome</td>
            <td>Quantidade</td>
            <td>Preço Unitário</td>
            <td>Total</td>
        </tr>
        <?php
        foreach ($_SESSION["shopping_cart"] as $product) {
            $total_price += $product["price"] * $product["quantity"];
        ?>
        <tr>
            <td><img src="<?php echo $product["image"]; ?>" width="50" height="40" /></td>
            <td><?php echo $product["name"]; ?></td>
            <td><?php echo $product["quantity"]; ?></td>
            <td>$<?php echo $product["price"]; ?></td>
            <td>$<?php echo $product["price"] * $product["quantity"]; ?></td>
        </tr>
        <?php } ?>
        <tr>
            <td colspan="4" align="right"><strong>Total:</strong></td>
            <td>$<?php echo $total_price; ?></td>
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

</BODY>
</HTML>
