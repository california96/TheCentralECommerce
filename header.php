<?php
session_start();
?>
<?php
  require_once('config.php');
?>
<!--================ Start Header Menu Area =================-->
<header class="header_area">
  <div class="main_menu">
    <nav class="navbar navbar-expand-lg navbar-light">
      <div class="container">
        <a class="navbar-brand logo_h" href="index.php"><h2>The Central</h2></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
          <ul class="nav navbar-nav menu_nav ml-auto mr-auto">
            <li class="nav-item active"><a class="nav-link" href="index.php">Home</a></li>
            <li class="nav-item submenu dropdown">
              <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                aria-expanded="false">Shop</a>
              <ul class="dropdown-menu">
                <li class="nav-item"><a class="nav-link" href="category.php">Shop Category</a></li>
                <li class="nav-item"><a class="nav-link" href="cart.php">Shopping Cart</a></li>
              </ul>
            </li>
            <li class="nav-item submenu dropdown">
              <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                aria-expanded="false">Pages</a>
              <ul class="dropdown-menu">
                <li class="nav-item"><a class="nav-link" href="register.html">Register</a></li>
                <li class="nav-item"><a class="nav-link" href="tracking-order.html">Tracking</a></li>
              </ul>
            </li>
            <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
          </ul>

          <ul class="nav-shop">
            <li class="nav-item"><button><i class="ti-search"></i></button></li>
            <!--<li class="nav-item"><button><i class="ti-shopping-cart"></i><span class="nav-shop__circle">3</span></button> </li>-->
            <!--<li class="nav-item"><a class="button button-header" href="#">Buy Now</a></li>-->
          </ul>
          <ul class="nav navbar-nav menu_nav ml-auto mr-auto">
          <li class="nav-item submenu dropdown">
            <?php
              if(isset($_COOKIE['userLogged'])){
            ?>
                <a href="#" class="button-header nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                  <?php
                    $email = $_COOKIE['userLogged'];
                    $sql = "SELECT firstName, lastName, roleID FROM users where email = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param('s', $email);
                    $stmt->execute();
                    $stmt->store_result();
                    $stmt->bind_result($fname, $lname, $rid);
                    $row = $stmt->fetch();
                    echo $fname . " " . $lname;
                  ?>
                </a>
                <ul class="dropdown-menu">
                  <?php
                  if($rid==1){
                  ?>
                    <li class="nav-item"><a class="nav-link" href="customerprofile.php">View Profile</a></li>
                  <?php
                  } else {
                  ?>
                    <li class="nav-item"><a class="nav-link" href="merchantprofile.php">View Profile</a></li>
                  <?php
                  }
                  ?>
                  <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                </ul>
          <?php } else { ?>
            <li class="nav-item"><a class="button button-header" href="login.php">Login</a></li><?php }?>
          </li>
          </ul>

        </div>
      </div>
    </nav>
  </div>
</header>
<!--================ End Header Menu Area =================-->