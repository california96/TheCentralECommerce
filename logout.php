<?php
setcookie("userLogged", "", time() - 10000);
header("Location: index.php");
 ?>
