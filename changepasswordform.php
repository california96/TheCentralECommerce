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

<div class="row">
  <div class="container-fluid">
    <div class="col-sm-5 float-left">
      <div class="container-fluid">
        <div class="column w-75 mt-5">
          <h2 class="ml-3 mb-4">Change Password</h2>
          <?php
            //Get password
            $email = $_COOKIE['userLogged'];
            $sql = "SELECT password,roleID FROM users WHERE email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            //fetching result would go here, but will be covered later
            $stmt->store_result();
            $stmt->bind_result($thePassword,$theRole);
            $row = $stmt->fetch();
            $stmt->close();
          ?>
          <form class="row login_form" action="" id="changePasswordForm" method="post">


            <!-- Current -->
            <div class="col-md-12 form-group ml-3">
              <input id="cpassword" name="cpassword" type="password" placeholder="Current Password" onchange="verification()" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Current Password'" required>
              <p id="cp-error"></p>
            </div>
            <!-- New -->
            <div class="col-md-12 form-group ml-3">
              <input id="npassword" name="npassword" type="password" placeholder="New Password" onchange="verification()" onfocus="this.placeholder = ''" onblur="this.placeholder = 'New Password'" required>
            </div>
            <!-- Confirm New -->
            <div class="col-md-12 form-group ml-3">
              <input id="cnpassword" name="cnpassword" type="password" placeholder="Confirm New Password" onchange="verification()" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Confirm New Password'" required>
              <p id="cnp-error"></p>
            </div>
            </form>
            <!-- Buttons -->
            <div class="col-md-12 form-group ml-3">
              <button id="saveButton" class="btn btn-success w-50 mt-3">Save Changes</button>
              <button id="cancelButton" class="btn btn-danger w-50 mt-3">Cancel</button>
            </div>

        </div>
      </div>
    </div>
  </div>
</div>

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
//Supposedly JQuery Ajax script
$(document).ready(function(){
  $("#saveButton").on("click", function(){
    var cp = $("#cpassword").val();
    var np = $("#npassword").val();
    var cnp = $("#cnpassword").val();
    var thePassword = "<?php echo $thePassword?>";  

    if(cp!="" & np!="" & cnp!=""){
      $.ajax({
        method:"POST",
        url:"changePassword.php",
        data:{cp:cp,np:np,cnp:cnp,thePassword:thePassword},
        success:function(data){
          if(data=="Invalid Current Password"){
            //$('#cpassword').html("Invalid Password");
            document.getElementById('cpassword').style.borderColor = 'red';
            document.getElementById('cp-error').innerHTML = "Please make sure you typed your current password correctly";
            document.getElementById('cp-error').style.color = 'red';
          }
          else if(data=="Success"){
            alert("Password changed successfully");
            var theRole = "<?php echo $theRole?>";
            if(theRole=="1"){
              window.location.replace("customerprofile.php");
            }
            else if(theRole=="2"){
              window.location.replace("merchantprofile.php");
            }
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
  $('#cancelButton').click(function(){
    var theRole = "<?php echo $theRole?>";
    if(theRole=="1"){
      window.location.replace("customerprofile.php");
    }
    else if(theRole=="2"){
      window.location.replace("merchantprofile.php");
    }
  });
});
</script>
<script>
  function verification(){
    if (document.getElementById('npassword').value != "" && document.getElementById('cnpassword').value != ""){
      if (document.getElementById('npassword').value == document.getElementById('cnpassword').value) {
        document.getElementById('npassword').style.borderColor = 'green';
        document.getElementById('cnpassword').style.borderColor = 'green';
        document.getElementById('cnp-error').innerHTML = "Passwords match";
        document.getElementById('cnp-error').style.color = 'green';
        document.getElementById('saveButton').disabled = false;
        //alert("MATCH");
      }
      else {
        document.getElementById('npassword').style.borderColor = 'red';
        document.getElementById('cnpassword').style.borderColor = 'red';
        document.getElementById('cnp-error').innerHTML = "Passwords does not match";
        document.getElementById('cnp-error').style.color = 'red';
        document.getElementById('saveButton').disabled = true;
        //alert("NO MATCH");
      }
    }
    else{
      document.getElementById('error-msg').innerHTML = "";
    }

  }
</script>


</body>
</html>
