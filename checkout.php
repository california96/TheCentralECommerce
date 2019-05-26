<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Checkout</title>
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
					<h1>Product Checkout</h1>
					<nav aria-label="breadcrumb" class="banner-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Checkout</li>
            </ol>
          </nav>
				</div>
			</div>
    </div>
	</section>
	<!-- ================ end banner area ================= -->


  <!--================Checkout Area =================-->
  <section class="checkout_area section-margin--small">
    <div class="container">
      <div class="billing_details">
            <div class="row">
                <div class="col-lg-8">
                    <h3>Billing Details</h3>

                    <form class="row contact_form" action="cartAction.php?action=placeOrder" method = "post" novalidate="novalidate" id = "order_form">
                      <textarea class="form-control" name="shippingAddress" id="address" rows="1" placeholder="Shipping Address" required style="margin-top: 0px; margin-bottom: 0px; height: 270px;"></textarea>
                      <div class="checkout_btn_inner d-flex align-items-center">
                            <a class="gray_btn" onclick="autoFill(); return true">Ship to iACADEMY</a>

                      </div>

                </div>

                <div class="col-lg-4">
                    <div class="order_box">
                        <h2>Your Order</h2>
                        <ul class="list">
                            <li><a href="#"><h4>Product <span>Total</span></h4></a></li>
                            <?php
                            if($cart->total_items() > 0){
                              $cartItems = $cart->contents();
                              foreach($cartItems as $item){ ?>
                            <li><a href="#"><?php echo $item['productName'];?><span class="middle">x<?php echo $item['qty'];?></span><span class="last">Php <?php echo $item['subtotal'];?></span></a></li>
                          <?php }}?>
                        </ul>
                        <ul class="list list_2">
                            <!--li><a href="#">Subtotal <span></span></a></li-->
                            <li><a href="#">Shipping <span>Php 50.00</span></a></li>
                            <li><a href="#">Total <span><?php echo $cart->total() + 50;?></span></a></li>
                        </ul>
                        <div class="text-center">
                          <button type = "submit"><a class="button button-paypal">Proceed with Payment</a></button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
  </section>
  <!--================End Checkout Area =================-->



  <!--================ Start footer Area  =================-->
  <?php include("footer.php");?>
	<!--================ End footer Area  =================-->
  <script type = "text/javascript">
    function autoFill(){
      document.getElementById('address').value = "iACADEMY Nexus, 7434 Yakal, Makati City";
    }
    function autoChecked(){
      if (document.getElementById('f-option2').checked)
      {
        document.getElementById('address').value = "iACADEMY Nexus, 7434 Yakal, Makati City";

      } else {
          document.getElementById('address').value = "";
      }
    }
  </script>


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
