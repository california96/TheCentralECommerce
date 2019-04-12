<?php
require_once('config.php');
 ?>
<?php

$firstName = $_REQUEST['firstName'];
$lastName = $_REQUEST['lastName'];
$email = $_REQUEST['email'];
$password = $_REQUEST['password'];
$confirmPassword = $_REQUEST['confirmPassword'];
$roleID = accountTypeVerification($_POST["accountType"]);
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);
$isEmailValid = false;
$isEmailValid = validEmail(trim($_POST["email"]));

//To prevent a warning/error I needed to put this
global $link;

if($isEmailValid){
  $sql = "SELECT roleID FROM users where email = ?";
  if($stmt = mysqli_prepare($conn, $sql)){
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt,$result);
    $rowCount = 0;
    while (mysqli_stmt_fetch($stmt)) {
      $rowCount++;
    }

  if($rowCount>0){
    //echo "Email already exists in the database";
    //if the email is already used
    if($result==$roleID){
      echo "This email is already used";
    }
    else{
      echo "Your account type will be updated to a Multi Account";
    }
  }
  else{
    echo "Email Valid";
    //if the email is not yet in the database proceed with the registration
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

  }
}
}
//Functions
function validEmail($rEmail){
  $splitEmail = explode ("@", $rEmail);
  if($splitEmail[1]=="iacademy.edu.ph"){
    return true;
  }
  else{
    return false;
  }
}
function accountTypeVerification($fRoleName){
  switch($fRoleName){
    case "merchant":
      return 1;

      break;
    case "customer":
      return 2;

      break;
    default:

      break;
  }
}

?>
