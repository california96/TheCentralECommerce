<?php
require_once('config.php');
?>
<?php

$id = detProd($_POST['remid']);
//echo $id;

$sql = "DELETE FROM products WHERE productID = ?";
if($stmt = $conn->prepare($sql)){
  echo "Yes";
  $stmt->bind_param('i', $id);
  $stmt->execute();
}
else{
  echo "No";
}
//functions
function detProd($str){
  $parts = explode("/", $str);
  return $parts[1];
}
?>
