<?php
session_start();
include 'Cart.php';
$cart = new Cart;
setcookie("userLogged", "", time() - 10000);
header("Location: index.php");
$cart->destroy();
 ?>
