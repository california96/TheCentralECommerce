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
    <?php include('merchanttemplate.php'); ?>
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

                  $sql = "SELECT productName, productPrice, productQuantity, productImage, productID FROM products where userID = ? LIMIT " . $this_page_first_result . ',' .$productsPerPage;
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
                        <!--<a id="edit-button/<?php echo $row['productID']; ?>" class="btn btn-primary w-100 mb-2">Edit</a>-->
                        <!--<a id="remove-button/<?php echo $row['productID'];?>" class="btn btn-danger w-100 mb-2 remButton">Remove</a>-->
                        <form action="updateproductform.php" method="post">
                          <input type="hidden" class="tracker" name="hiddenField" value="<?=$row['productID']?>">
                          <button id="update-button/<?php echo $row['productID']; ?>" class="btn btn-primary w-100 mb-2 updateButton">Update</button>
                        </form>
                        <button id="remove-button/<?php echo $row['productID'];?>" class="btn btn-danger w-100 mb-2 remButton">Remove</button>
                        <p class="card-text text-center">In stock: <?php echo $row['productQuantity']; ?></p>
                       </div>
                    </div>
                    <div class="text-center">

                    </div>
                  </div>
          <?php
                }
                $stmt->close();
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
<script>
  $(document).ready(function(){
    $(".remButton").on("click", function(){
      var remid = $(this).attr('id');
      var sure = confirm("Are you sure you want to remove this product?");
      if(sure){
        //alert(remid);
        $.ajax({
          method:"POST",
          url:"removeProduct.php",
          data:{remid:remid},
          success:function(data){
            if(data=="No"){
              //alert("Unsuccessful");

            }
            else if(data=="Yes"){
              location.reload();
              //alert("Successfully removed");

            }
            else{
              //alert(data);
            }
          }
        });
      }else{
        //alert("Cancelled");
      }
    });

  });
</script>
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
