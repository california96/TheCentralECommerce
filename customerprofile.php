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
  <title>The Central</title>
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
  $id = $_GET['id'];

  $sql2 = "SELECT transactions.transactionID, products.productName, products.productImage, transactionitems.quantity, transactionstatus.transactionStatus, transactions.dateOrdered
  FROM transactionitems
  INNER JOIN transactions on transactionitems.transactionID = transactions.transactionID
  INNER JOIN products on transactionitems.productID = products.productID
  INNER JOIN transactionstatus on transactions.transactionStatusID = transactionstatus.transactionStatusID
  WHERE  transactions.transactionStatusID = 1 and transactions.customerID = ". $id ."
  GROUP BY transactions.transactionID
  ORDER BY transactions.dateOrdered DESC";
  $pendingTrNos = mysqli_query($conn, $sql2);


  ?>
  <div class="row">
    <div class="container-fluid">
      <div class="column w-100 float-left mt-3">
        <h2>Pending Transactions</h2>

          <?php while($numbers = mysqli_fetch_array($pendingTrNos)){?>
            <div class = "table-responsive">
            <table class = "table">
              <thead>
                <tr>
                  <?php
                  $formatDate = strtotime($numbers['dateOrdered']);
                  ?>
                  <th scope = "col">Transaction No: <?php echo $numbers['transactionID'];?><br/><?php echo date("Y-M-d h:i:sa", $formatDate);?></th>
                  <th scope = "col">Product Name</th>
                  <th scope = "col">Quantity</th>
                  <th scope = "col">Status</th>
                  <th scope = "col">Action</th>
                </tr>
              </thead>
          <?php
            $sql = "SELECT transactions.transactionID, products.productName, products.productImage, transactionitems.quantity, transactionstatus.transactionStatus, transactions.dateOrdered
            FROM transactionitems
            INNER JOIN transactions on transactionitems.transactionID = transactions.transactionID
            INNER JOIN products on transactionitems.productID = products.productID
            INNER JOIN transactionstatus on transactions.transactionStatusID = transactionstatus.transactionStatusID
            WHERE  transactions.transactionStatusID = 1 and transactions.transactionid = " . $numbers['transactionID'] . " and transactions.customerID = ". $id ."
            ORDER BY transactions.dateOrdered DESC";
              $pendingOrders = mysqli_query($conn, $sql); ?>
          <?php while($row = mysqli_fetch_array($pendingOrders)) {?>



            <tr>
              <td><img src = "<?php echo $row['productImage'];?>" width = 150px height = 150px></td>
              <td><?php echo $row['productName'];?></td>
              <td><?php echo $row['quantity'];?></td>
              <td><?php echo $row['transactionStatus'];?></td>
              <td><button class = "btn btn-primary">Cancel</td>
            </tr>


      <?php }?>
      </table>
      </div>
    <?php }?>
        <h2>Recent Transactions</h2>
        <div class = "table-responsive">
        <table class = "table">
          <thead>
            <tr>
              <th scope = "col">Transaction ID</th>
              <th scope = "col">Product Name</th>
              <th scope = "col">Quantity</th>
              <th scope = "col">Status</th>
              <th scope = "col">Action</th>
            </tr>
          </thead>
        </table>
        <ul class="w-100" style="font-size:20px">
      <?php

      ?>
          <li>Transaction 1</li>
          <li>Transaction 2</li>
          <li>Transaction 3</li>
          <li>Transaction 4</li>
          <li>Transaction 5</li>
        </ul>
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
