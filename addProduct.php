<?php
require_once('config.php');
 ?>
 <?php
 $productName= $_REQUEST['productName'];
 $productImage = $_REQUEST['productImage'];
 $productPrice = $_REQUEST['productPrice'];
 $productDescription = $_REQUEST['productDescription'];
 $productQuantity = $_REQUEST['productQuantity'];
 $productType = convertCategory($_REQUEST['productType']);
 $email = $_COOKIE['userLogged'];
 $sql = "SELECT userID FROM users where email = ?";
 $stmt = $conn->prepare($sql);
 $stmt->bind_param('s', $email);
 $stmt->execute();
 $stmt->store_result();
 $stmt->bind_result($userID);
 $row = $stmt->fetch();
 mysqli_stmt_close($stmt);
 $sql="INSERT INTO products(productName,productImage,productPrice,productDescription,productQuantity,userID,categoryID) VALUES(?,?,?,?,?,?,?)";
 if($stmt = mysqli_prepare($conn, $sql)){
   mysqli_stmt_bind_param($stmt,"ssdsddd",$productName,$productImage,$productPrice,$productDescription,$productQuantity,$userID,$productType);
   if(mysqli_stmt_execute($stmt)){
     header("Location: login.php");
     exit;
   }
   else{
     echo "Error: $stmt. " . mysqli_error($conn);
   }
 }
 else{
   echo "Cannot prepare query: $stmt" . mysqli_error($conn);
 }
 mysqli_stmt_close($stmt);
 mysqli_close($conn);

 //function
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
