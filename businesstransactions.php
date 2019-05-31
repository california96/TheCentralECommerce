<?php
  require_once('config.php');
?>
<?php
//you can't be here, if you already have a cookie
//if(isset($_COOKIE['userLogged'])){
// header("Location: index.php");
//}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>My Profile</title>
	<link rel="icon" href="img/Fevicon.png" type="image/png">
  <link rel="stylesheet" href="vendors/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="vendors/fontawesome/css/all.min.css">
	<link rel="stylesheet" href="vendors/themify-icons/themify-icons.css">
	<link rel="stylesheet" href="vendors/linericon/style.css">
  <link rel="stylesheet" href="vendors/owl-carousel/owl.theme.default.min.css">
  <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">
  <link rel="stylesheet" href="vendors/nice-select/nice-select.css">
  <link rel="stylesheet" href="vendors/nouislider/nouislider.min.css">
  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <link rel="stylesheet" href="css/style.css">

</head>
<body>
  <?php include('header.php');
  ?>
  <?php
  $id = $_REQUEST['id'];
  //For the benefit of getting the numbers
  $sql = "SELECT transactions.transactionID, products.productName, products.productImage, transactionitems.quantity, transactionstatus.transactionStatus, transactions.dateOrdered, CONCAT (users.firstName, ' ', users.lastName) as 'name'
  FROM transactionitems
  INNER JOIN transactions on transactionitems.transactionID = transactions.transactionID
  INNER JOIN products on transactionitems.productID = products.productID
  INNER JOIN transactionstatus on transactions.transactionStatusID = transactionstatus.transactionStatusID
  INNER JOIN users on transactions.customerID = users.userID
  WHERE  (transactions.transactionStatusID in (1,2) )and products.userID = " . $id . "
  GROUP BY transactions.transactionID
  ORDER BY transactions.dateOrdered DESC";
  $preProcessedNos = mysqli_query($conn, $sql);


  ?>
  <div class="row">
    <div class="container-fluid">
      <div class="column w-100 float-left mt-3">
        <h2>Pending Transactions</h2>

          <?php while($numbers = mysqli_fetch_array($preProcessedNos)){?>
            <div class = "table-responsive">
            <table class = "table">
              <thead>
                <tr>
                  <?php
                  $formatDate = strtotime($numbers['dateOrdered']);
                  ?>
                  <th scope = "col">Transaction No: <?php echo $numbers['transactionID'];?><br/><?php echo date("Y-M-d h:i:sa", $formatDate);?>
                  <br/>
                  Ordered by: <?php echo $numbers['name'];?></th>
                  <th scope = "col">Product Name</th>
                  <th scope = "col">Quantity</th>
                  <th scope = "col">Status</th>
                  <th scope = "col">Action</th>
                </tr>
              </thead>

          <?php
          //For unprocessed transactions
            $sql2 = "SELECT transactions.transactionID, products.productName, products.productImage, transactionitems.quantity, transactionstatus.transactionStatus, transactions.dateOrdered, CONCAT (users.firstName, ' ', users.lastName) as 'name'
            FROM transactionitems
            INNER JOIN transactions on transactionitems.transactionID = transactions.transactionID
            INNER JOIN products on transactionitems.productID = products.productID
            INNER JOIN transactionstatus on transactions.transactionStatusID = transactionstatus.transactionStatusID
            INNER JOIN users on transactions.customerID = users.userID
            WHERE  (transactions.transactionStatusID in (1,2) )and products.userID = " . $id . " and transactions.transactionID = " . $numbers['transactionID'] ."
            GROUP BY transactions.transactionID
            ORDER BY transactions.dateOrdered DESC";
              $pendingOrders = mysqli_query($conn, $sql2); ?>
          <?php while($row = mysqli_fetch_array($pendingOrders)) {?>



            <tr>
              <td><img src = "<?php echo $row['productImage'];?>" width = 150px height = 150px></td>
              <td><?php echo $row['productName'];?></td>
              <td><?php echo $row['quantity'];?></td>
              <td><?php echo $row['transactionStatus'];?></td>
              <?php if($row['transactionStatus'] == "Pending"){?>
              <td> <a href = "transactionAction.php?id=<?php echo $numbers['transactionID']?>&action=process&userID=<?php echo $id;?>"<button class = "btn btn-primary">Process Order</button></td>
              <?php }if($row['transactionStatus'] == "Processed"){?>
              <td><a href = "transactionAction.php?id=<?php echo $numbers['transactionID']?>&action=cancel&userID=<?php echo $id;?>"<button class = "btn btn-primary">Cancel</button>
              </td>
              <?php } ?>
                <?php}?>

            </tr>


      <?php }?>
      </table>
      </div>
    <?php }?>
    <?php   $sql3 = "SELECT transactions.transactionID, products.productName, products.productImage, transactionitems.quantity, transactionstatus.transactionStatus, transactions.dateOrdered, CONCAT (users.firstName, ' ', users.lastName) as 'name'
      FROM transactionitems
      INNER JOIN transactions on transactionitems.transactionID = transactions.transactionID
      INNER JOIN products on transactionitems.productID = products.productID
      INNER JOIN transactionstatus on transactions.transactionStatusID = transactionstatus.transactionStatusID
      INNER JOIN users on transactions.customerID = users.userID
      WHERE  (transactions.transactionStatusID in (3,4) )and products.userID = " . $id . "
      GROUP BY transactions.transactionID
      ORDER BY transactions.dateOrdered DESC";
    $oldTrNos = mysqli_query($conn, $sql3);
    ?>
        <h2>Past Transactions</h2>
        <?php while($numbers2 = mysqli_fetch_array($oldTrNos)){?>
        <div class = "table-responsive">
        <table class = "table">
          <thead>
            <tr>
              <?php
              $formatDate2 = strtotime($numbers2['dateOrdered']);
              ?>
              <th scope = "col">Transaction No: <?php echo $numbers2['transactionID'];?><br/><?php echo date("Y-M-d h:i:sa", $formatDate2);?></th>
              <th scope = "col">Product Name</th>
              <th scope = "col">Quantity</th>
              <th scope = "col">Status</th>
            </tr>
          </thead>
          <?php
          //For finished transactions
          $sql4 = "SELECT transactions.transactionID, products.productName, products.productImage, transactionitems.quantity, transactionstatus.transactionStatus, transactions.dateOrdered, CONCAT (users.firstName, ' ', users.lastName) as 'name'
          FROM transactionitems
          INNER JOIN transactions on transactionitems.transactionID = transactions.transactionID
          INNER JOIN products on transactionitems.productID = products.productID
          INNER JOIN transactionstatus on transactions.transactionStatusID = transactionstatus.transactionStatusID
          INNER JOIN users on transactions.customerID = users.userID
          WHERE  (transactions.transactionStatusID in (3,4) )and products.userID = " . $id . " and transactions.transactionID = " . $numbers2['transactionID'] ."
          GROUP BY transactions.transactionID
          ORDER BY transactions.dateOrdered DESC";
          $oldTransactions = mysqli_query($conn, $sql4); ?>
        <?php while($row2 = mysqli_fetch_array($oldTransactions)){?>
          <tr>
            <td><img src = "<?php echo $row2['productImage'];?>" width = 150px height = 150px></td>
            <td><?php echo $row2['productName'];?></td>
            <td><?php echo $row2['quantity'];?></td>
            <td><?php echo $row2['transactionStatus'];?></td>
          </tr>
        <?php }?>
        </table>
      <?php } ?>

      </div>
    </div>
  </div>
</div>
</div>
</div>
  <?php include('footer.php');
  ?>


<script src="vendors/jquery/jquery-3.2.1.min.js"></script>
<script src="vendors/bootstrap/bootstrap.bundle.min.js"></script>
<script src="vendors/skrollr.min.js"></script>
<script src="vendors/owl-carousel/owl.carousel.min.js"></script>
<script src="vendors/nice-select/jquery.nice-select.min.js"></script>
<script src="vendors/jquery.ajaxchimp.min.js"></script>
<script src="vendors/mail-script.js"></script>
<script src="js/main.js"></script>

</body>
</html>
