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
            ?>
          </h1>
          <p class="text-center" id="accountType">Merchant</p>
          <br><br>
          <a href="#" class="btn btn-outline-secondary btn-block" role="button">
          Products  &nbsp
          <span class="badge badge-dark">1</span>
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

    <div class="col-sm-5 float-left">
      <div class="container-fluid">
        <div class="column w-75 mt-5">
          <form class="row login_form" action="addProduct.php" id="productForm" method="post">
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
              <input id="productImage" name="productImage" type="text" placeholder="Product Image" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Product Image'" required>
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
              <button type="submit" id="addButton" value="submit" class="btn btn-success">Submit</button>
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
