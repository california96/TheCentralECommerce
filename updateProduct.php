<?php
  require_once('config.php');
?>
<?php
  $uProductType = convertCategory($_POST['productType']);
  $uProductName = $_POST['productName'];
  $uProductPrice = $_POST['productPrice'];
  $uProductQuantity = $_POST['productQuantity'];
  $uProductDesc = $_POST['productDescription'];
  $uProductImage = $_POST['productImage'];
  echo $productID = $_POST['hiddenField'];

  $sql = "UPDATE products SET categoryID = ?, productName = ?, productPrice = ?, productQuantity = ?, productDescription = ?, productImage = ? WHERE productID = ?";
  if($stmt = $conn->prepare($sql)){
    $stmt->bind_param("isdissi",$uProductType,$uProductName,$uProductPrice,$uProductQuantity,$uProductDesc,$uProductImage,$productID);
    $stmt->execute();
    header("Location: merchantprofile.php");
    exit;
  }
  else{
    echo "Cannot prepare query: $stmt" . mysqli_error($conn);
  }

  //functions
  function convertCategory($categoryName){
    switch($categoryName){
      case "Clothing":
        return 1;
      break;
      case "Services":
        return 2;
      break;
      case "Accessories":
        return 3;
      break;
      case "Books":
        return 4;
      break;
      case "Food":
        return 5;
      break;
      case "Beauty":
        return 6;
      break;
      case "Electronics":
        return 7;
      break;
    }
  }
?>
