<!DOCTYPE html>
<?php

?>
<?php
  include('config.php');
?>
<?php
  $sql = "SELECT productID, productName, productImage, productPrice, category
  FROM products INNER JOIN categories on products.categoryID = categories.categoryID";
  $fortrending = mysqli_query($conn, $sql);
 ?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>The Central - Home</title>
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

<?php include 'header.php';
?>
  <main class="site-main">

    <!--================ Hero banner start =================-->
    <section class="hero-banner">
      <div class="container">
        <div class="row no-gutters align-items-center pt-60px">
          <div class="col-5 d-none d-sm-block">
            <div class="hero-banner__img">
              <img class="img-fluid" src="img/home/hero-banner.png" alt="">
            </div>
          </div>
          <div class="col-sm-7 col-lg-6 offset-lg-1 pl-4 pl-md-5 pl-lg-0">
            <div class="hero-banner__content">
              <h1>Hello, and welcome to The Central</h1>
              <h4>Browse products from Game Changers</h4>
              <a class="button button-hero" href="#">Browse Now</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================ Hero banner start =================-->



    <!-- ================ trending product section start ================= -->
    <section class="section-margin calc-60px">
      <div class="container">
        <div class="section-intro pb-60px">
          <p>Popular Items in the market</p>
          <h2>Trending <span class="section-intro__style">Products</span></h2>
        </div>
          <div class="row">
        <?php
        if($fortrending){

        while($row = @mysqli_fetch_array($fortrending)){?>

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
        <?php }}
        mysqli_close($conn)?>
        </div>
      </div>
    </section>
    <!-- ================ trending product section end ================= -->


    <!-- ================ offer section start ================= -->
    <section class="offer" id="parallax-1" data-anchor-target="#parallax-1" data-300-top="background-position: 20px 30px" data-top-bottom="background-position: 0 20px">
      <div class="container">
        <div class="row">
          <div class="col-xl-5">
            <div class="offer__content text-center">
              <h3>Up To 50% Off</h3>
              <h4>Some event</h4>
              <p>Placeholder for event sales</p>
              <a class="button button--active mt-3 mt-xl-4" href="#">Shop Now</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ================ offer section end ================= -->

    <!-- ================ Best Selling item  carousel ================= -->
    <!--section class="section-margin calc-60px">
      <div class="container">
        <div class="section-intro pb-60px">
          <p>Popular Item in the market</p>
          <h2>Best <span class="section-intro__style">Sellers</span></h2>
        </div>
        <div class="owl-carousel owl-theme" id="bestSellerCarousel">
          <div class="card text-center card-product">
            <div class="card-product__img">
              <img class="img-fluid" src="img/product/product1.png" alt="">
              <ul class="card-product__imgOverlay">
                <li><button><i class="ti-search"></i></button></li>
                <li><button><i class="ti-shopping-cart"></i></button></li>
                <li><button><i class="ti-heart"></i></button></li>
              </ul>
            </div>
            <div class="card-body">
              <p>Accessories</p>
              <h4 class="card-product__title"><a href="single-product.html">Quartz Belt Watch</a></h4>
              <p class="card-product__price">$150.00</p>
            </div>
          </div>

          <div class="card text-center card-product">
            <div class="card-product__img">
              <img class="img-fluid" src="img/product/product2.png" alt="">
              <ul class="card-product__imgOverlay">
                <li><button><i class="ti-search"></i></button></li>
                <li><button><i class="ti-shopping-cart"></i></button></li>
                <li><button><i class="ti-heart"></i></button></li>
              </ul>
            </div>
            <div class="card-body">
              <p>Beauty</p>
              <h4 class="card-product__title"><a href="single-product.html">Women Freshwash</a></h4>
              <p class="card-product__price">$150.00</p>
            </div>
          </div>

          <div class="card text-center card-product">
            <div class="card-product__img">
              <img class="img-fluid" src="img/product/product3.png" alt="">
              <ul class="card-product__imgOverlay">
                <li><button><i class="ti-search"></i></button></li>
                <li><button><i class="ti-shopping-cart"></i></button></li>
                <li><button><i class="ti-heart"></i></button></li>
              </ul>
            </div>
            <div class="card-body">
              <p>Decor</p>
              <h4 class="card-product__title"><a href="single-product.html">Room Flash Light</a></h4>
              <p class="card-product__price">$150.00</p>
            </div>
          </div>

          <div class="card text-center card-product">
            <div class="card-product__img">
              <img class="img-fluid" src="img/product/product4.png" alt="">
              <ul class="card-product__imgOverlay">
                <li><button><i class="ti-search"></i></button></li>
                <li><button><i class="ti-shopping-cart"></i></button></li>
                <li><button><i class="ti-heart"></i></button></li>
              </ul>
            </div>
            <div class="card-body">
              <p>Decor</p>
              <h4 class="card-product__title"><a href="single-product.html">Room Flash Light</a></h4>
              <p class="card-product__price">$150.00</p>
            </div>
          </div>

          <div class="card text-center card-product">
            <div class="card-product__img">
              <img class="img-fluid" src="img/product/product1.png" alt="">
              <ul class="card-product__imgOverlay">
                <li><button><i class="ti-search"></i></button></li>
                <li><button><i class="ti-shopping-cart"></i></button></li>
                <li><button><i class="ti-heart"></i></button></li>
              </ul>
            </div>
            <div class="card-body">
              <p>Accessories</p>
              <h4 class="card-product__title"><a href="single-product.html">Quartz Belt Watch</a></h4>
              <p class="card-product__price">$150.00</p>
            </div>
          </div>

          <div class="card text-center card-product">
            <div class="card-product__img">
              <img class="img-fluid" src="img/product/product2.png" alt="">
              <ul class="card-product__imgOverlay">
                <li><button><i class="ti-search"></i></button></li>
                <li><button><i class="ti-shopping-cart"></i></button></li>
                <li><button><i class="ti-heart"></i></button></li>
              </ul>
            </div>
            <div class="card-body">
              <p>Beauty</p>
              <h4 class="card-product__title"><a href="single-product.html">Women Freshwash</a></h4>
              <p class="card-product__price">$150.00</p>
            </div>
          </div>

          <div class="card text-center card-product">
            <div class="card-product__img">
              <img class="img-fluid" src="img/product/product3.png" alt="">
              <ul class="card-product__imgOverlay">
                <li><button><i class="ti-search"></i></button></li>
                <li><button><i class="ti-shopping-cart"></i></button></li>
                <li><button><i class="ti-heart"></i></button></li>
              </ul>
            </div>
            <div class="card-body">
              <p>Decor</p>
              <h4 class="card-product__title"><a href="single-product.html">Room Flash Light</a></h4>
              <p class="card-product__price">$150.00</p>
            </div>
          </div>

          <div class="card text-center card-product">
            <div class="card-product__img">
              <img class="img-fluid" src="img/product/product4.png" alt="">
              <ul class="card-product__imgOverlay">
                <li><button><i class="ti-search"></i></button></li>
                <li><button><i class="ti-shopping-cart"></i></button></li>
                <li><button><i class="ti-heart"></i></button></li>
              </ul>
            </div>
            <div class="card-body">
              <p>Decor</p>
              <h4 class="card-product__title"><a href="single-product.html">Room Flash Light</a></h4>
              <p class="card-product__price">$150.00</p>
            </div>
          </div>
        </div>
      </div>
    </section--!>
    <!-- ================ Best Selling item  carousel end ================= -->



    <!-- ================ Subscribe section start ================= -->
    <section class="subscribe-position">
      <div class="container">
        <div class="subscribe text-center">
          <h3 class="subscribe__title">Subscribe to our newsletter</h3>
          <p>You will receive email alerts for new items on sale.</p>
          <div id="mc_embed_signup">
            <form target="_blank" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01" method="get" class="subscribe-form form-inline mt-5 pt-1">
              <div class="form-group ml-sm-auto">
                <input class="form-control mb-1" type="email" name="EMAIL" placeholder="Enter your email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your Email Address '" >
                <div class="info"></div>
              </div>
              <button class="button button-subscribe mr-auto mb-1" type="submit">Subscribe Now</button>
              <div style="position: absolute; left: -5000px;">
                <input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
              </div>

            </form>
          </div>

        </div>
      </div>
    </section>
    <!-- ================ Subscribe section end ================= -->



  </main>
  <?php
  include('footer.php'); ?>





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
