<?php
require_once('config.php');
 ?>
<?php

$firstName = $_REQUEST['firstName'];
$lastName = $_REQUEST['lastName'];
$email = $_REQUEST['email'];
$password = $_REQUEST['password'];
$confirmPassword = $_REQUEST['confirmPassword'];
$roleID = 1;
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);
//if they don't match
$sql = "INSERT INTO users(email, password, firstName, lastName, roleID) VALUES(?, ?, ? ,?,?)";

if($stmt = mysqli_prepare($conn, $sql)){
  mysqli_stmt_bind_param($stmt, "ssssd", $email, $hashedPassword, $firstName,$lastName, $roleID);

  if(mysqli_stmt_execute($stmt)){
    echo "Member registered";
    setcookie("userLogged", $firstName . " " . $lastName, 0);
    header("Location: index.php");
    exit;
  }
  else{
    echo "Error: $stmt. " . mysqli_error($conn);
  }
}else{
  echo "Cannot prepare query: $stmt" . mysqli_error($conn);
}
mysqli_stmt_close($stmt);
mysqli_close($conn);

?>
