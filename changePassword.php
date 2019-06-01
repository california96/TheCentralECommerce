<?php
require_once('config.php');
 ?>
<?php
$cp = $_POST['cp'];
$np = $_POST['np'];
$cnp = $_POST['cnp'];
$thePassword = $_POST['thePassword'];
$npHashed = password_hash($np, PASSWORD_BCRYPT);
$email = $_COOKIE['userLogged'];
if(password_verify($cp,$thePassword)){
  //I guess database logic goes here
  $sql = "UPDATE users SET password = ? WHERE email = ?";
  if($stmt = $conn->prepare($sql)){
    $stmt->bind_param('ss', $npHashed, $email);
    $stmt->execute();
    $stmt->close();
    echo "Success";
  }
  else{
  }
}else{
  echo "Invalid Current Password";
}
?>
