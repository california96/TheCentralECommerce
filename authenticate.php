<?php
include_once('config.php');
 ?>

<?php
$email = $_REQUEST["email"];
$password = $_REQUEST["password"];
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);
$sql = "SELECT email, password, firstName, lastName, roleID FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $email);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($a, $b, $c, $d, $e);
//$stmt->bind_result($email, $password);
$row = $stmt->fetch();
if(!empty($row)){
  if(password_verify($password, $b))
  {
    echo("User authenticated");
    setcookie("userLogged", $a, 0);
    if($e=="1"){
      //customer
      header("Location: index.php");
    }
    else{
      //merchant
      header("Location: merchantprofile.php");
    }
  }
  else{
    header("Location: login.php");
  }
}
else{
  echo("This user does not exist!");
}
$stmt->close();
$conn->close();
 ?>
