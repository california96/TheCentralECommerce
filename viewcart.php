
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Aroma Shop - Cart</title>
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
					<h1>Shopping Cart</h1>
					<nav aria-label="breadcrumb" class="banner-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
            </ol>
          </nav>
				</div>
			</div>
    </div>
	</section>
	<!-- ================ end banner area ================= -->



  <!--================Cart Area =================-->
  <section class="cart_area">
      <div class="container">
          <div class="cart_inner">
              <div class="table-responsive">
                  <table class="table">
                      <thead>
                          <tr>
                              <th scope="col">Product</th>
                              <th scope="col">Price</th>
                              <th scope="col">Quantity</th>
                              <th scope="col">Total</th>
                          </tr>
                      </thead>
                      <tbody>
                        <?php
                        if($cart->total_items() > 0){
                          $cartItems = $cart->contents();
                          foreach($cartItems as $item){ ?>
                          <tr>
                              <td>
                                  <div class="media">
                                      <div class="d-flex">
                                          <img src=<?php echo $item['productImage'];?> width = "70" height = "70">
                                      </div>
                                      <div class="media-body">
                                          <!--p><a href = "singleproduct.php?id="<?php echo $item['productID'];?><?php echo $item['productName'];?></p-->
                                          <p><a href = "single-product.php?id=<?php echo $item['productID'];?>"><?php echo $item['productName'];?></a></p>
                                      </div>
                                  </div>
                              </td>
                              <td>
                                  <h5>Php <?php echo $item['productPrice'];?></h5>
                              </td>
                              <td>
                                  <div class="product_count">
                                      <input type="number" name="qty" id="sst" maxlength="12" value=<?php echo $item['qty'];?> title="Quantity:"
                                          class="input-text qty" onchange="updateCartItem(this, '<?php echo $item['productID']; ?>')">

                                  </div>
                              </td>
                              <td>
                                  <h5><?php echo $item['subtotal'];?></h5>
                              </td>
                              <td>
                                 <a href="cartAction.php?action=removeCartItem&id=<?php echo $item['productID']; ?>"  onclick="return confirm('Are you sure?')"><img src = "img/x.png" width = 30px, height = 30px></a>
                              </td>
                          </tr>
                        <?php } }else{ ?>
                          <tr><td colspan = "5"><p>Nothing in your cart...yet</p></td>
                          <?php } ?>
                          <!--tr class="bottom_button">
                              <td>
                                  <a class="button" href="index.php">Continue Shopping</a>
                              </td>

                          </tr-->
                          <tr>
                              <td>
                                  <h5>Subtotal</h5>
                              </td>
                              <td>
                                  <h5>Php <?php echo $cart->total();?></h5>
                              </td>
                          </tr>

                          <!--tr class="shipping_area">
                              <td class="d-none d-md-block">

                              </td>
                              <td>

                              </td>
                              <td>
                                  <h5>Shipping</h5>
                              </td>
                              <td>
                                  <div class="shipping_box">
                                      <ul class="list">
                                          <li><a href="#">Flat Rate: $5.00</a></li>
                                          <li><a href="#">Free Shipping</a></li>
                                          <li><a href="#">Flat Rate: $10.00</a></li>
                                          <li class="active"><a href="#">Local Delivery: $2.00</a></li>
                                      </ul>
                                      <h6>Calculate Shipping <i class="fa fa-caret-down" aria-hidden="true"></i></h6>
                                      <select class="shipping_select">
                                          <option value="1">Bangladesh</option>
                                          <option value="2">India</option>
                                          <option value="4">Pakistan</option>
                                      </select>
                                      <select class="shipping_select">
                                          <option value="1">Select a State</option>
                                          <option value="2">Select a State</option>
                                          <option value="4">Select a State</option>
                                      </select>
                                      <input type="text" placeholder="Postcode/Zipcode">
                                      <a class="gray_btn" href="#">Update Details</a>
                                  </div>
                              </td>
                          </tr-->
                          <tr class="out_button_area">
                              <td class="d-none-l">

                              </td>

                              <td>

                              </td>
                              <td>
                                  <div class="checkout_btn_inner d-flex align-items-center">
                                      <a class="gray_btn" href="index.php">Continue Shopping</a>
                                      <a class="primary-btn ml-2" href="checkout.php">Proceed to checkout</a>
                                  </div>
                              </td>
                          </tr>
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
  </section>
  <!--================End Cart Area =================-->



  <!--================ Start footer Area  =================-->
	<?php include('footer.php');?>
	<!--================ End footer Area  =================-->



  <script src="vendors/jquery/jquery-3.2.1.min.js"></script>
  <script src="vendors/bootstrap/bootstrap.bundle.min.js"></script>
  <script src="vendors/skrollr.min.js"></script>
  <script src="vendors/owl-carousel/owl.carousel.min.js"></script>
  <script src="vendors/nice-select/jquery.nice-select.min.js"></script>
  <script src="vendors/jquery.ajaxchimp.min.js"></script>
  <script src="vendors/mail-script.js"></script>
  <script src="js/main.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script>
  function updateCartItem(obj,id){
    $.get("cartAction.php", {action:"updateCartItem", id:id, qty:obj.value}, function(data){
        if(data == 'ok'){
            location.reload();
        }else{
            alert('Cart update failed, please try again.');
        }
    });
}
    </script>
</body>
</html>
