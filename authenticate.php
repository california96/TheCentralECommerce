<?php
include_once('config.php');
 ?>

<?php
$email = $_REQUEST["email"];
$password = $_REQUEST["password"];
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

$sql = "SELECT email, password, firstName, lastName FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $email);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($a, $b, $c, $d);
//$stmt->bind_result($email, $password);
$row = $stmt->fetch();
if(!empty($row)){
  if(password_verify($password, $b))
  {
    echo("User authenticated");
    setcookie("userLogged", $c . " " . $d, 0);
    header("Location: index.php");
  }
  else{
    echo("Username/Password do not match");
    echo "<br>";
    echo $email;
    echo "<br>";
    echo $password;
      echo "<br>";
    echo $hashedPassword;
      echo "<br>";
  }
}
else{
  echo("This user does not exist!");
}
$stmt->close();
$conn->close();
 ?>
