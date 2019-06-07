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
<!-- Content -->
<?php
  //getPassword
  $email = $_COOKIE['userLogged'];
  $sql = "SELECT password FROM users WHERE email = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $email);
  $stmt->execute();
  //fetching result would go here, but will be covered later
  $stmt->store_result();
  $stmt->bind_result($thePassword);
  $row = $stmt->fetch();
  $stmt->close();
  //Get details
  $email = $_COOKIE['userLogged'];
  $sql = "SELECT firstName, lastName, email ,userID FROM users WHERE email = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $email);
  $stmt->execute();
  //fetching result would go here, but will be covered later
  $stmt->store_result();
  $stmt->bind_result($theFName,$theLName,$theEmail,$theID);
  $row = $stmt->fetch();
  $stmt->close();
?>
<div class="row">
  <div class="container-fluid">
    <?php// include('merchanttemplate.php'); ?>
    <div class="col-sm-5 float-left">
      <div class="container-fluid">
        <div class="column w-75 mt-5">
          <h2 class="ml-3 mb-4">Update Account Type</h2>
          <form class="row login_form" action="" id="productForm" method="post">
            <div class="col-md-12 form-group ml-3">
              <!-- fname -->
              <p>First Name:</p>
              <input type="text" class="form-control" value="<?=$theFName?>" disabled required>
            </div>
            <div class="col-md-12 form-group ml-3">
              <!-- lname -->
              <p>Last Name:</p>
              <input type="text" class="form-control" value="<?=$theLName?>" disabled required>
            </div>
            <div class="col-md-12 form-group ml-3">
              <!-- email -->
              <p>Email:</p>
              <input type="text" class="form-control" value="<?=$theEmail?>" disabled required>
            </div>
            <div class="col-md-12 form-group ml-3">
              <!-- bname -->
              <p>Business Name:</p>
              <input type="text" class="form-control" id="businessName" name="businessName" placeholder="" onfocus="this.placeholder = ''" onblur="this.placeholder = ''" onfocusout="verification()" required>
              <p class="bn-error"></p>
            </div>
            <div class="col-md-12 form-group ml-3">
              <!-- password -->
              <p>Current Password:</p>
              <input type="password" class="form-control" id="currentPassword" name="currentPassword" placeholder="" onfocus="this.placeholder = ''" onblur="this.placeholder = ''" onfocusout="verification()" required>
              <p id="cp-error"></p>
              <p id="error-msg"></p>
            </div>
          </form>
            <div class="col-md-12 form-group ml-3">
              <!-- buttons -->
              <button type="submit" id="updateButton" value="submit" class="btn btn-success">Update</button>
              <button type="button" id="cancelButton" class="btn btn-danger">Cancel</button>
            </div>

        </div>
      </div>
    </div>
  </div>
</div>
<!-- End content -->
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
$("#updateButton").on("click", function(){
  var cp = $("#currentPassword").val();
  var bn = $("#businessName").val();
  var thePassword = "<?php echo $thePassword?>";

  if(cp!=""){
    $.ajax({
      method:"POST",
      url:"changeAccountType.php",
      data:{cp:cp, bn:bn, thePassword:thePassword},
      success:function(data){
        if(data=="Invalid Current Password"){
          //$('#cpassword').html("Invalid Password");
          document.getElementById('currentPassword').style.borderColor = 'red';
          document.getElementById('cp-error').innerHTML = "Please make sure you typed your current password correctly";
          document.getElementById('cp-error').style.color = 'red';
        }
        else if(data=="Success"){
          alert("Account Type changed successfully");
          window.location.replace("merchantprofile.php");
        }
        else{
          alert(data);
        }
      }
    });
  }else{
    alert("Please fill out all the fields in the form");
  }
});
</script>
<script>
  $(document).ready(function(){
    $('#cancelButton').click(function(){
      window.location.replace("customerprofile.php?id=<?php echo $theID;?>");
    });
  });
</script>

<script>
  function verification(){
    if (document.getElementById('businessName').value != "" && document.getElementById('currentPassword').value != ""){
      document.getElementById('updateButton').disabled = false;
      document.getElementById('error-msg').innerHTML = "";
    }
    else{
      document.getElementById('updateButton').disabled = true;
      document.getElementById('error-msg').innerHTML = "Please fill out the required fields";
      document.getElementById('error-msg').style.color = 'red';
    }

  }
</script>
</body>
</html>
