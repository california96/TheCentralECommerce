<?php
require_once('config.php');
 ?>
<?php
$cp = $_POST['cp'];
$bn = $_POST['bn'];
$thePassword = $_POST['thePassword'];
$email = $_COOKIE['userLogged'];
$newRoleID = 2;
if(password_verify($cp,$thePassword)){
  //I guess database logic goes here
  $sql = "UPDATE users SET roleID = ?, businessName = ? WHERE email = ?";
  if($stmt = $conn->prepare($sql)){
    $stmt->bind_param('iss', $newRoleID, $bn, $email);
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
