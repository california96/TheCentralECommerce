<?php
require_once 'config.php';

$userID = $_REQUEST['userID'];
if(isset($_REQUEST['action']) && !empty($_REQUEST['action'])){
  if($_REQUEST['action'] == 'process' && !empty($_REQUEST['id'])){
    $sql = "UPDATE transactions SET transactionStatusID = 2 WHERE transactionID = " . $_REQUEST['id'] .";";
    $stmt = mysqli_query($conn, $sql);
    if($stmt){
        header("Location: businesstransactions.php?id=".$userID);
    }

  }
  if($_REQUEST['action'] == 'receive' && !empty($_REQUEST['id'])){
    $sql = "UPDATE transactions SET transactionStatusID = 4 WHERE transactionID = " . $_REQUEST['id'] .";";
    $stmt = mysqli_query($conn, $sql);
    if($stmt){
        header("Location: customerprofile.php?id=".$userID);
    }
  }
  if($_REQUEST['action'] == 'cancel' && !empty($_REQUEST['id'])){
    $sql = "UPDATE transactions SET transactionStatusID = 3 WHERE transactionID = " . $_REQUEST['id'] .";";
    $stmt = mysqli_query($conn, $sql);
    if($stmt){
      header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
  }
}
 ?>
