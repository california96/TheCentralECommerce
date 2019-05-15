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
<!-- Merchant body -->
<div class="row">
  <div class="container-fluid">
    <div class="col-sm-3 float-left">
      <div class="jumbotron jumbotron-fluid">
        <div class="container-fluid">
          <img src="https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/44ea7750-be82-490f-ae01-c88d3b59d871/d8eiz8l-6ab027d0-1299-47f6-b257-a3fce4ac453c.png/v1/fill/w_1024,h_576,q_80,strp/nura_rikuo___nurarihyon_no_mago_by_klydetheslayer_d8eiz8l-fullview.jpg?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7ImhlaWdodCI6Ijw9NTc2IiwicGF0aCI6IlwvZlwvNDRlYTc3NTAtYmU4Mi00OTBmLWFlMDEtYzg4ZDNiNTlkODcxXC9kOGVpejhsLTZhYjAyN2QwLTEyOTktNDdmNi1iMjU3LWEzZmNlNGFjNDUzYy5wbmciLCJ3aWR0aCI6Ijw9MTAyNCJ9XV0sImF1ZCI6WyJ1cm46c2VydmljZTppbWFnZS5vcGVyYXRpb25zIl19.s4o58ik3xWCHzFZxGyXMzCYBriKJMkjw50sNc5ojpmo" class="rounded mx-auto d-block img-fluid" alt="Nura">
          <h1 class="text-center" id="fullName">
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
            mysqli_stmt_close($stmt);
            ?>
          </h1>
          <p class="text-center" id="accountType">Merchant</p>
          <br><br>
          <a href="#" class="btn btn-outline-secondary btn-block" role="button">
          Products  &nbsp
          <span class="badge badge-dark">
            <?php

            ?>
          </span>
          </a>
          <a href="#" class="btn btn-outline-secondary btn-block" role="button">
          Messages  &nbsp
          <span class="badge badge-dark">3</span>
          </a>
          <a href="#" class="btn btn-outline-secondary btn-block" role="button">
          Change Password
          </a>

        </div>
      </div>
    </div>
    <div class="col-sm-9 float-right">
      <div class="container-fluid">
        <br><br><br>
        <?php
          //start sql query for searching of products of the logged on users
          //get the userID of the logged on user
          $email = $_COOKIE['userLogged'];
          $sql = "SELECT userID FROM users WHERE email = ?";
          $stmt = $conn->prepare($sql);
          $stmt->bind_param("s", $email);
          $stmt->execute();
          //fetching result would go here, but will be covered later
          $stmt->store_result();
          $stmt->bind_result($uid);
          $row = $stmt->fetch();
          $stmt->close();
          //success getting the userid of the user
          ?>

          <?php
          $sql = "SELECT productName, productPrice, productQuantity, productImage FROM products where userID = ?";
          $stmt = $conn->prepare($sql);
          $stmt->bind_param("i", $uid);
          $stmt->execute();
          $result = $stmt->get_result();
          ?>
          <!-- end of retrieving of all the data that belongs to the user -->
          <?php
            //No of products per page
            $productsPerPage = 3;
            //No of total rows/products
            $numberOfProducts = $result->num_rows;
            //No of total pages
            $numberOfPages = ceil($numberOfProducts/$productsPerPage);
            if(!isset($_GET['page'])){
              $page = 1;
            }
            else{
              $page = $_GET['page'];
            }
            $this_page_first_result = ($page - 1) * $productsPerPage;
          ?>
          <!-- end of pagination logic -->

          <?php
            if($result->num_rows === 0){
          ?>
              <div class="column w-100 float-left mr-2 mb-3">
                <h1>No Products</h1>
              </div>
          <?php
            } else {
                  $stmt->close();
                  //No of products per page
                  $productsPerPage = 3;
                  //No of total rows/products
                  $numberOfProducts = $result->num_rows;
                  //No of total pages
                  $numberOfPages = ceil($numberOfProducts/$productsPerPage);
                  if(!isset($_GET['page'])){
                    $page = 1;
                  }
                  else{
                    $page = $_GET['page'];
                  }
                  $this_page_first_result = ($page - 1) * $productsPerPage;

                  $sql = "SELECT productName, productPrice, productQuantity, productImage FROM products where userID = ? LIMIT " . $this_page_first_result . ',' .$productsPerPage;
                  $stmt = $conn->prepare($sql);
                  $stmt->bind_param("i", $uid);
                  $stmt->execute();
                  $result = $stmt->get_result();
                while($row = $result->fetch_assoc()) {
          ?>
                  <div class="column w-25 float-left mr-2 mb-3">
                    <div class="card w-100" >
                      <img class="card-img-top" src=<?php echo $row['productImage'];?> class="rounded mx-auto d-block img-fluid" width="250" height="250">
                      <div class="card-body">
                        <h4 class="card-title text-center"><?php echo $row['productName']; ?></h4>
                        <p class="card-text text-center">Php <?php echo $row['productPrice']; ?></p>
                        <a href="#" class="btn btn-primary w-100 mb-2">Edit</a>
                        <a href="#" class="btn btn-danger w-100 mb-2">Remove</a>
                        <p class="card-text text-center">In stock: <?php echo $row['productQuantity']; ?></p>
                       </div>
                    </div>
                  </div>
          <?php
                }
          ?>

          <?php
            }
          ?>
			  <!--Image Gallery-->
        <!--Image Gallery-->
        <div class="column w-75 float-left">
          <br>
            <ul class="pagination">
        <?php
              for($page=1;$page<=$numberOfPages;$page++){
        ?>
                <li class="page-item">
                  <a class="page-link" href="merchantprofile.php?page=<?php echo $page ?>">
                    <?php
                      echo $page;
                    ?>
                  </a>
                </li>
        <?php
          }
        ?>
            </ul>
        </div>
        <?php

        ?>

          <div class="column w-25 float-left">
            <br>
            <a href="productform.php" class="btn btn-success w-100 mb-2">Add Product</a>
          </div>
		</div>

	  </div>
	</div>
</div>

<!-- End Merchant Body -->

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
<!-- Debugging Codes -->
<!--
alert(productType);
alert(productName);
alert(productImage);
alert(productQuantity);
alert(productPrice);
alert(productDescription);
-->
