<!DOCTYPE html>
<?php
  include_once('config.php');
?>
<?php
  $sql = "SELECT transactionitems.transactionID as 'transactionID', productName, productPrice, quantity, address, transactionAmount, dateOrdered, transactionStatus
FROM transactions
INNER JOIN transactionitems on transactions.transactionID = transactionitems.transactionID
INNER JOIN transactionstatus on transactions.transactionStatusID = transactionstatus.transactionStatusID
INNER JOIN products on transactionitems.productID = products.productID
WHERE transactionitems.transactionID = " . $_GET['id'] . ";" ;
$sql2 = "SELECT transactionitems.transactionID as 'transactionID', productName, productPrice, quantity, address, transactionAmount, dateOrdered, transactionStatus
FROM transactions
INNER JOIN transactionitems on transactions.transactionID = transactionitems.transactionID
INNER JOIN transactionstatus on transactions.transactionStatusID = transactionstatus.transactionStatusID
INNER JOIN products on transactionitems.productID = products.productID
WHERE transactionitems.transactionID = " . $_GET['id'] . "
LIMIT 1;" ;
  $data = mysqli_query($conn, $sql);
  $data2 = mysqli_query($conn, $sql2);
/*  $stmt->store_result();
  $stmt->bind_result($transactionID, $productName, $productPrice, $quantity, $address, $transactionAmount, $dateOrdered, $transactionStatus);*/
  /*$result = $stmt->get_result();
  $row = $result->fetch_assoc();*/

?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Order Confirmed</title>
	<link rel="icon" href="img/Fevicon.png" type="image/png">
  <link rel="stylesheet" href="vendors/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="vendors/fontawesome/css/all.min.css">
	<link rel="stylesheet" href="vendors/themify-icons/themify-icons.css">
	<link rel="stylesheet" href="vendors/linericon/style.css">
  <link rel="stylesheet" href="vendors/owl-carousel/owl.theme.default.min.css">
  <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">
  <link rel="stylesheet" href="vendors/nice-select/nice-select.css">
  <link rel="stylesheet" href="vendors/nouislider/nouislider.min.css">

  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <!--================ Start Header Menu Area =================-->
  <?php include('header.php');?>
	<!--================ End Header Menu Area =================-->

	<!-- ================ start banner area ================= -->
	<section class="blog-banner-area" id="category">
		<div class="container h-100">
			<div class="blog-banner">
				<div class="text-center">
					<h1>Order Confirmation</h1>
					<nav aria-label="breadcrumb" class="banner-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Shop Category</li>
            </ol>
          </nav>
				</div>
			</div>
    </div>
	</section>
	<!-- ================ end banner area ================= -->

  <!--================Order Details Area =================-->
  <section class="order_details section-margin--small">
    <div class="container">
      <p class="text-center billing-alert">Thank you. Your order has been received.</p>
      <div class="row mb-5">
        <div class="col-md-6 col-xl-4 mb-4 mb-xl-0">
          <div class="confirmation-card">
            <h3 class="billing-title">Order Info</h3>
            <table class="order-rable">
              <?php while($row = mysqli_fetch_array($data2)){?>
              <tr>
                <td>Order number</td>
                <td><?php echo $row['transactionID'];?></td>
              </tr>
              <tr>
                <td>Date</td>
                <td><?php echo $row['dateOrdered'];?></td>
              </tr>
              <tr>
                <td>Total</td>
                <td>Php <?php echo $row['transactionAmount'];?></td>
              </tr>
              <tr>
                <td>Payment method</td>
                <td>: Check payments</td>
              </tr>
            </table>
          </div>
        </div>

        <div class="col-md-6 col-xl-4 mb-4 mb-xl-0">
          <div class="confirmation-card">
            <h3 class="billing-title">Shipping Address</h3>
            <table class="order-rable">

              <tr>
                <td><?php echo $row['address'];?></td>

              </tr>

              </tr>
              <!--?php }?-->
            </table>
          </div>
        </div>
      </div>
      <div class="order_details_table">
        <h2>Order Details</h2>
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Product</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total</th>
              </tr>
            </thead>
            <tbody>
              <?php while($row2 =mysqli_fetch_array($data)){?>
              <tr>
                <td>
                  <p><?php echo $row2['productName'];?></p>
                </td>
                <td>
                  <h5>x <?php echo $row2['quantity'];?></h5>
                </td>
                <td>
                  <p><?php echo ($row2['quantity'] * $row2['productPrice']);?></p>
                </td>
              </tr>
            <?php }?>

              <tr>
                <td>
                  <h4>Subtotal</h4>
                </td>
                <td>
                  <h5></h5>
                </td>
                <td>
                  <p><?php echo $row['transactionAmount'];?></p>

                </td>
              </tr>
              <tr>
                <td>
                  <h4>Shipping</h4>
                </td>
                <td>
                  <h5></h5>
                </td>
                <td>
                  <p>Flat rate: Php 50.00</p>
                </td>
              </tr>
              <tr>
                <td>
                  <h4>Total</h4>
                </td>
                <td>
                  <h5></h5>
                </td>
                <td>
                  <h4><?php echo $row['transactionAmount'];?></h4>
                </td>
              </tr><?php }?>
            </tbody>

          </table>
        </div>
      </div>
    </div>
  </section>

  <!--================End Order Details Area =================-->



  <!--================ Start footer Area  =================-->
  <?php include('footer.php'); ?>
	<!--================ End footer Area  =================-->



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
