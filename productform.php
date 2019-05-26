<?php
  include('config.php');
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
  <title>The Central - Login</title>
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
<!--content-->

<div class="row">
  <div class="container-fluid">
    <?php include('merchanttemplate.php'); ?>
    <div class="col-sm-5 float-left">
      <div class="container-fluid">
        <div class="column w-75 mt-5">
          <h2 class="ml-3 mb-4">Product Details</h2>
          <form class="row login_form" action="addProduct.php" id="productForm" method="post" enctype="multipart/form-data">
            <div class="col-md-12 form-group ml-3">
              <select id="productType" name="productType"  required>
                <option selected disabled hidden>Choose product type</option>
                <option value="Clothing">Clothing</option>
                <option value="Services">Services</option>
                <option value="Accessories">Accessories</option>
                <option value="Books">Books</option>
                <option value="Food">Food</option>
                <option value="Beauty">Beauty</option>
                <option value="Electronics">Electronics</option>
              </select>
              <p id="pt-error"></p>
            </div>
            <div class="col-md-12 form-group ml-3">
              <input id="productImage" name="productImage" type="file" placeholder="Product Image" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Product Image'" required>
              <p id="pi-error"></p>
            </div>
            <div class="col-md-12 form-group ml-3">
              <input id="productName" name="productName" type="text" placeholder="Product Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Product Name'" required>
              <p id="pn-error"></p>
            </div>
            <div class="col-md-12 form-group ml-3">
              <input id="productQuantity" name="productQuantity" type="number" placeholder="Product Quantity" min="1" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Product Quantity'" required>
              <p id="pq-error"></p>
            </div>
            <div class="col-md-12 form-group ml-3">
              <input id="productPrice" name="productPrice" type="number" placeholder="Product Price" min="1" step="0.25" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Product Price'" required>
              <p id="pq-error"></p>
            </div>
            <div class="col-md-12 form-group ml-3">
              <textarea id="productDescription" name="productDescription" rows="4" cols="60" placeholder="Product description...." onfocus="this.placeholder = ''" onblur="this.placeholder = 'Product description'" style="resize:none;border-radius: 6px;" required></textarea>
              <p id="pq-error"></p>
            </div>
            <div class="col-md-12 form-group ml-3">
              <button type="submit" id="addButton" value="submit" class="btn btn-success" name = "submit">Submit</button>
              <button type="button" id="cancelButton" class="btn btn-danger">Cancel</button>
              <input type="hidden" id="hiddenField" name="hiddenField" value="<?=$_COOKIE['userLogged']?>">

            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!--contentend-->
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
<script>
  $(document).ready(function(){
    $('#cancelButton').click(function(){
      window.location.replace("merchantprofile.php");
    });
  });
</script>
</body>
</html>
