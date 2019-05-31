<!DOCTYPE html>
<?php
  include('config.php');
?>
<?php
  $searchTerm = $_REQUEST['searchterm'];
  $sql = "SELECT productID, productName, productImage, productPrice, category
  FROM products INNER JOIN categories on products.categoryID = categories.categoryID
  WHERE products.productName LIKE '%" .$searchTerm. "%' OR category LIKE '%" .$searchTerm."%' ";


  $searchresults = mysqli_query($conn, $sql);
 ?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Search</title>
	<link rel="icon" href="img/Fevicon.png" type="image/png">
  <link rel="stylesheet" href="vendors/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="vendors/fontawesome/css/all.min.css">
	<link rel="stylesheet" href="vendors/themify-icons/themify-icons.css">
  <link rel="stylesheet" href="vendors/nice-select/nice-select.css">
  <link rel="stylesheet" href="vendors/owl-carousel/owl.theme.default.min.css">
  <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">

  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include('header.php');?>
<main class="site-main">
  <section class="section-margin calc-60px">
    <div class="container">
      <div class="section-intro pb-60px">

        <div class="row">
      <?php
      if(mysqli_num_rows($searchresults)>0){?>

        <h2>Searching results for <span class="section-intro__style"><?php echo $searchTerm?></span></h2>
      </div>
      <?php
      while($row = @mysqli_fetch_array($searchresults)){?>

          <div class="col-md-6 col-lg-4 col-xl-3">
          <div class="card text-center card-product">
            <div class="card-product__img">
              <img class="card-img" src=<?php echo $row['productImage'];?> alt="" width="128px" height="128px">
              <ul class="card-product__imgOverlay">
                <li><button><i class="ti-search"></i></button></li>
                <li><button><i class="ti-shopping-cart"></i></button></li>
              </ul>
            </div>
            <div class="card-body">
              <p><?php echo $row['category'];?></p>
              <h4 class="card-product__title"><a href="single-product.php?id=<?php echo $row['productID'];?>"><?php echo $row['productName'];?></a></h4>
              <p class="card-product__price">Php <?php echo $row['productPrice'];?></p>
            </div>
          </div>
        </div>
      <?php }}else{?>
        <h2> <span class="section-intro__style"><?php echo $searchTerm?></span> returned no results</h2>
      <?php }mysqli_close($conn)?>
      </div>
    </div>
  </section>
</main>
<?php include('footer.php');?>
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
