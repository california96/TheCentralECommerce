<?php
  require_once('config.php');
?>
<?php
$id = $_POST['id']; // the string of the productids and their status
$length = $_POST['length'];

for($ctr = 0; $ctr < $length; $ctr++){
  $datas = explode("," , $id);
  $idata = $datas[$ctr];
  $ipid = detIPid($idata);
  $ists = convertNum(detISts($idata));

  $sql = "UPDATE products SET status = ? WHERE productID = ?";
  if($stmt = $conn->prepare($sql)){
    $stmt->bind_param('ii', $ists, $ipid);
    $stmt->execute();
  }
  else{
  }

}
echo "Yes";




//functions
function detIPid($data){
  $parts = explode("/", $data);
  return $parts[1];
}
function detISts($data){
  $parts = explode("/", $data);
  return $parts[2];
}
function convertNum($data){
  switch($data){
    case "true":
    return 1;
    case "false":
    return 0;
  }
}
?>
