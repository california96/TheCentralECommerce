<?php

  require_once('config.php');
  include "Cart.php";
  $cart = new Cart;
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
              </ul>
            </li>
            <li class="nav-item submenu dropdown">
              <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                aria-expanded="false">Pages</a>
              <ul class="dropdown-menu">

                <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
                <li class="nav-item"><a class="nav-link" href="tracking-order.html">Tracking</a></li>
              </ul>
            </li>
            <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
            <form class = "form-inline" action = "search.php" method = "GET">
            <li class="nav-item"><input class = "form-control mr sm-2" type = 'text' placeholder = 'Search' name = "searchterm"></li>
          </form>
          </ul>

          <ul class="nav-shop">

            <li class="nav-item"><button><a href = "viewcart.php"><i class="ti-shopping-cart"></i><span class="nav-shop__circle"><?php echo count($cart->contents());?></span></a></button> </li>
          </ul>
          <ul class="navbar-nav menu_nav ml-auto mr-auto">
            <?php
            if(isset($_COOKIE['userLogged'])){ ?>
              <?php
                $email = $_COOKIE['userLogged'] != null ? $_COOKIE['userLogged'] : null;
                $sql = "SELECT userID, firstName, lastName, roleID, businessName FROM users where email = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('s', $email);
                $stmt->execute();
                $stmt->store_result();
                $stmt->bind_result($uid, $fname, $lname, $rid, $bname);
                $row = $stmt->fetch();
                ?>
              <li class="nav-item submenu dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                  aria-expanded="false">My Account</a>
                <ul class="dropdown-menu">
                  <?php if($rid == 2){?>
                  <li class="nav-item"><a class="nav-link" href="merchantprofile.php"><?php echo $bname;?></a></li>
                  <?php }else{?>
                  <li class="nav-item"><a class="nav-link" href="customerprofile.php?id=<?php echo $uid;?>"><?php echo $fname . " " . $lname;?></a></li>
                <?php }?>
                  <li class ="nav-item"><a class="nav-link" href ="businesstransactions.php?id=<?php echo $uid;?>">Transactions</a></li>
                  <li class="nav-item"><a class="nav-link" href="logout.php">Signout</a></li>
                </ul>
              </li>
          <?php } else{ ?>
            <li class="nav-item"><a class="button button-header" href="login.php">Login</a></li><?php }?>
          </ul>
        </div>
      </div>
    </nav>
  </div>
</header>
<!--================ End Header Menu Area =================-->
