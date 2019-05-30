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
  <div class="row">
    <div class="container-fluid">
      <div class="column w-100 float-left mt-3">
        <h2>Pending Transactions</h2>
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
          </div>
        <?php

        ?>

          <li>Transaction 1</li>
          <li>Transaction 2</li>
          <li>Transaction 3</li>
          <li>Transaction 4</li>
          <li>Transaction 5</li>

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
