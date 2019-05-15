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

//removed portion

//removed portion

//check if email is valid
if($isEmailValid){
  //Query for getting the roleID for a certain email
  $sql = "SELECT roleID FROM users where email = ?";
  if($stmt = mysqli_prepare($conn, $sql)){
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt,$result);
  }
    $rowCount = 0;
    while (mysqli_stmt_fetch($stmt)) {
      $rowCount++;
    }
  if($rowCount>0){
    //Means the email exists in the database
    echo "Email already used";
  }
  else{
    //Means we add to the database
    echo "Email Valid";
    switch($roleID){
      case 1:
        //Meaning customer
        $sql = "INSERT INTO users(email, password, firstName, lastName, roleID) VALUES(?, ?, ? ,?,?)";

        if($stmt = mysqli_prepare($conn, $sql)){
          mysqli_stmt_bind_param($stmt, "ssssd", $email, $hashedPassword, $firstName,$lastName, $roleID);

          if(mysqli_stmt_execute($stmt)){
            echo "Member registered";
            setcookie("userLogged", $email, 0);
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
        break;
      case 2:
        //Meaning merchant
        $sql = "INSERT INTO users(email, password, firstName, lastName, roleID, businessName) VALUES(?, ?, ?, ?, ?, ?)";
        $businessName = $_REQUEST['businessName'];
        if($stmt = mysqli_prepare($conn, $sql)){
          mysqli_stmt_bind_param($stmt, "ssssds", $email, $hashedPassword, $firstName,$lastName, $roleID, $businessName);

          if(mysqli_stmt_execute($stmt)){
            echo "Member registered";
            setcookie("userLogged", $email, 0);
            header("Location: merchantprofile.php");
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
        break;
    }

  }
}
else{
  echo "Please use an iAcademy Email";
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
    case "customer":
      return 1;

      break;
    case "merchant":
      return 2;

      break;
    default:

      break;
  }
}
?>
