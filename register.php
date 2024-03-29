<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Aroma Shop - Login</title>
	<link rel="icon" href="img/Fevicon.png" type="image/png">
  <link rel="stylesheet" href="vendors/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="vendors/fontawesome/css/all.min.css">
	<link rel="stylesheet" href="vendors/themify-icons/themify-icons.css">
	<link rel="stylesheet" href="vendors/linericon/style.css">
  <link rel="stylesheet" href="vendors/owl-carousel/owl.theme.default.min.css">
  <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">
  <link rel="stylesheet" href="vendors/nice-select/nice-select.css">
  <link rel="stylesheet" href="vendors/nouislider/nouislider.min.css">

  <link rel="stylesheet" href="css/style.css">
</head>
<body>
	<!--================ Start Header Menu Area =================-->
  <?php include('header.php');?>
	<!--================ End Header Menu Area =================-->

  <section class="blog-banner-area" id="category">
		<div class="container h-100">
			<div class="blog-banner">
				<div class="text-center">
					<h1>Register</h1>
					<nav aria-label="breadcrumb" class="banner-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Register</li>
            </ol>
          </nav>
				</div>
			</div>
    </div>
	</section>
	<!-- ================ end banner area ================= -->

  <!--================Login Box Area =================-->
	<section class="login_box_area section-margin">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="login_box_img">
						<div class="hover">
							<h4>Already have an account?</h4>
							<p>There are advances being made in science and technology everyday, and a good example of this is the</p>
							<a class="button button-account" href="login.php">Login Now</a>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="login_form_inner register_form_inner">

						<h3>Create an account</h3>
						<form class="row login_form" action="registercustomer.php" id="register_form" method = "post">
              <div class="col-md-12 form-group">
                <p id="error-msg"></p>
                <select name="accountType" onchange="changeRegistrationForm()" id="account-dropdown" required>
                  <option selected disabled hidden>Choose account type</option>
                  <option value="merchant">Merchant</option>
                  <option value="customer">Customer</option>
                  <!--
                  <option value="multi">Multi</option>
                  <option value="admin">Admin</option>
                  -->
                </select>
              </div>


						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Login Box Area =================-->



  <!--================ Start footer Area  =================-->
	<?php include("footer.php")?>
	<!--================ End footer Area  =================-->



  <script src="vendors/jquery/jquery-3.2.1.min.js"></script>
  <script src="vendors/bootstrap/bootstrap.bundle.min.js"></script>
  <script src="vendors/skrollr.min.js"></script>
  <script src="vendors/owl-carousel/owl.carousel.min.js"></script>
  <script src="vendors/nice-select/jquery.nice-select.min.js"></script>
  <script src="vendors/jquery.ajaxchimp.min.js"></script>
  <script src="vendors/mail-script.js"></script>
  <script src="js/main.js"></script>
  <script>
    function passwordVerify(){
      if (document.getElementById('password').value != "" && document.getElementById('confirmPassword').value != ""){
        if (document.getElementById('password').value == document.getElementById('confirmPassword').value) {
          document.getElementById('error-msg').style.color = 'green';
          document.getElementById('error-msg').innerHTML = 'Passwords match';
          document.getElementById('registerButton').disabled = false;
          //alert("MATCH");
        }
        else {
          document.getElementById('error-msg').style.color = 'red';
          document.getElementById('error-msg').innerHTML = 'Passwords does not match';
          document.getElementById('registerButton').disabled = true;
          //alert("NO MATCH");
        }
      }
      else{
        document.getElementById('error-msg').innerHTML = "";
      }

    }
    function emailVerify(){
      var emailInput = document.getElementById('email');
      var emailParts = emailInput.value.split('@');
      if(emailParts[1]=="iacademy.edu.ph"){
        //alert('Game Changer');
        document.getElementById('email').style.borderColor = 'green';
        //document.getElementById('error-msg').style.color = 'green';
        //document.getElementById('error-msg').innerHTML = 'Email is valid';
        document.getElementById('registerButton').disabled = false;
      }
      else{
        //alert('No Game Changer');
        document.getElementById('email').style.borderColor = 'red';
        //document.getElementById('error-msg').style.color = 'green';
        //document.getElementById('error-msg').innerHTML = 'Email is invalid';
      document.getElementById('registerButton').disabled = true;
      }
    }
    function addRequired(input){
      input.required=true;
    }
    function changeRegistrationForm(){
      var choice = document.getElementById("account-dropdown").value;
      var parent = document.getElementById("register_form");
      var child1 = document.getElementById("fNameDiv");
      var child2 = document.getElementById("lNameDiv");
      var child3 = document.getElementById("emailDiv");
      var child4 = document.getElementById("passwordDiv");
      var child5 = document.getElementById("confirmPasswordDiv");
      var child6 = document.getElementById("businessNameDiv");
      var child7 = document.getElementById("checkBoxDiv");
      var child8 = document.getElementById("buttonDiv");
      var isExist = false;
      var prevAcct = "";
        if(child1 && child6){
          isExist = true;
          prevAcct = "Merchant";
        }
        else if(child1){
          isExist = true;
          prevAcct = "Customer";
        }
        else{
          isExist = false;
          prevAcct = "";
        }
        <!---------->
        if(isExist && prevAcct=="Merchant"){
          parent.removeChild(child1);
          parent.removeChild(child2);
          parent.removeChild(child3);
          parent.removeChild(child4);
          parent.removeChild(child5);
          parent.removeChild(child6);
          parent.removeChild(child7);
          parent.removeChild(child8);
          if(choice=="merchant"){
            <!-- Merchant -->
            document.getElementById('error-msg').innerHTML = '';
            var fNameDiv = document.createElement("div");
            fNameDiv.setAttribute("id", "fNameDiv");
            fNameDiv.setAttribute("class", "col-md-12 form-group");
            var form = document.getElementById("register_form");
            form.appendChild(fNameDiv);
            //For input
            var fName = document.createElement("input");
            fName.setAttribute("type", "text");
            fName.setAttribute("class", "form-control");
            fName.setAttribute("id", "name");
            fName.setAttribute("name", "firstName");
            fName.setAttribute("placeholder", "First Name");
            fName.setAttribute("onfocus", "this.placeholder = ''");
            fName.setAttribute("onblur", "this.placeholder = 'First Name'");
            addRequired(fName);
            var div = document.getElementById("fNameDiv");
            div.appendChild(fName);

            //for last name
            //For div
            var lNameDiv = document.createElement("div");
            lNameDiv.setAttribute("id", "lNameDiv");
            lNameDiv.setAttribute("class", "col-md-12 form-group");
            var form = document.getElementById("register_form");
            form.appendChild(lNameDiv);
            //For input
            var lName = document.createElement("input");
            lName.setAttribute("type", "text");
            lName.setAttribute("class", "form-control");
            lName.setAttribute("id", "name");
            lName.setAttribute("name", "lastName");
            lName.setAttribute("placeholder", "Last Name");
            lName.setAttribute("onfocus", "this.placeholder = ''");
            lName.setAttribute("onblur", "this.placeholder = 'last Name'");
            addRequired(lName);
            var div = document.getElementById("lNameDiv");
            div.appendChild(lName);

            //for email
            //For div
            var emailDiv = document.createElement("div");
            emailDiv.setAttribute("id", "emailDiv");
            emailDiv.setAttribute("class", "col-md-12 form-group");
            var form = document.getElementById("register_form");
            form.appendChild(emailDiv);
            //For input
            var email = document.createElement("input");
            email.setAttribute("type", "email");
            email.setAttribute("class", "form-control");
            email.setAttribute("id", "email");
            email.setAttribute("name", "email");
            email.setAttribute("placeholder", "Email");
            email.setAttribute("onfocus", "this.placeholder = ''");
            email.setAttribute("onblur", "this.placeholder = 'Email'");
            email.setAttribute("onchange","emailVerify()");


            addRequired(email);
            var div = document.getElementById("emailDiv");
            div.appendChild(email);

            //for password
            //For div
            var passwordDiv = document.createElement("div");
            passwordDiv.setAttribute("id", "passwordDiv");
            passwordDiv.setAttribute("class", "col-md-12 form-group");
            var form = document.getElementById("register_form");
            form.appendChild(passwordDiv);
            //For input
            var password = document.createElement("input");
            password.setAttribute("type", "password");
            password.setAttribute("class", "form-control");
            password.setAttribute("id", "password");
            password.setAttribute("name", "password");
            password.setAttribute("placeholder", "Password");
            password.setAttribute("onfocus", "this.placeholder = ''");
            password.setAttribute("onblur", "this.placeholder = 'Password'");
            password.setAttribute("onkeyup","passwordVerify()");
            addRequired(password);

            var div = document.getElementById("passwordDiv");
            div.appendChild(password);

            //for confirm password
            //For div
            var confirmPasswordDiv = document.createElement("div");
            confirmPasswordDiv.setAttribute("id", "confirmPasswordDiv");
            confirmPasswordDiv.setAttribute("class", "col-md-12 form-group");
            var form = document.getElementById("register_form");
            form.appendChild(confirmPasswordDiv);
            //For input
            var confirmPassword = document.createElement("input");
            confirmPassword.setAttribute("type", "password");
            confirmPassword.setAttribute("class", "form-control");
            confirmPassword.setAttribute("id", "confirmPassword");
            confirmPassword.setAttribute("name", "confirmPassword");
            confirmPassword.setAttribute("placeholder", "Confirm Password");
            confirmPassword.setAttribute("onfocus", "this.placeholder = ''");
            confirmPassword.setAttribute("onblur", "this.placeholder = 'Confirm Password'");
            confirmPassword.setAttribute("onkeyup","passwordVerify()");
            addRequired(confirmPassword);
            var div = document.getElementById("confirmPasswordDiv");
            div.appendChild(confirmPassword);

            //for business name
            //For div
            var businessNameDiv = document.createElement("div");
            businessNameDiv.setAttribute("id", "businessNameDiv");
            businessNameDiv.setAttribute("class", "col-md-12 form-group");
            var form = document.getElementById("register_form");
            form.appendChild(businessNameDiv);
            //For input
            var businessName = document.createElement("input");
            businessName.setAttribute("type", "text");
            businessName.setAttribute("class", "form-control");
            businessName.setAttribute("id", "businessName");
            businessName.setAttribute("name", "businessName");
            businessName.setAttribute("placeholder", "Business Name");
            businessName.setAttribute("onfocus", "this.placeholder = ''");
            businessName.setAttribute("onblur", "this.placeholder = 'Business Name'");
            addRequired(businessName);
            var div = document.getElementById("businessNameDiv");
            div.appendChild(businessName);

            //for checkbox
            //For div
            var checkBoxDiv = document.createElement("div");
            checkBoxDiv.setAttribute("id", "checkBoxDiv");
            checkBoxDiv.setAttribute("class", "col-md-12 form-group");
            var form = document.getElementById("register_form");
            form.appendChild(checkBoxDiv);
            //for divdiv
            var checkBoxDivDiv = document.createElement("div");
            checkBoxDivDiv.setAttribute("id", "checkBoxDivDiv");
            checkBoxDivDiv.setAttribute("class", "creat_account");
            var form = document.getElementById("checkBoxDiv");
            form.appendChild(checkBoxDivDiv);
            //For input
            var checkBox = document.createElement("input");
            checkBox.setAttribute("type", "checkbox");
            checkBox.setAttribute("id", "f-option2");
            checkBox.setAttribute("name", "selector");
            var div = document.getElementById("checkBoxDivDiv");
            div.appendChild(checkBox);
            //For input
            var keepMe = document.createElement("label");
            var labelText = document.createTextNode("Keep me logged in");
            keepMe.appendChild(labelText);
            keepMe.setAttribute("for", "f-option2");
            keepMe.setAttribute("id", "keepMe");
            var div = document.getElementById("checkBoxDivDiv");
            div.appendChild(keepMe);

            //for button
            //for div
            var buttonDiv = document.createElement("div");
            buttonDiv.setAttribute("id", "buttonDiv");
            buttonDiv.setAttribute("class", "col-md-12 form-group");
            var form = document.getElementById("register_form");
            form.appendChild(buttonDiv);
            //for btn
            var button = document.createElement("button");
            var btnText = document.createTextNode("Register");
            button.appendChild(btnText);
            button.setAttribute("id", "registerButton");
            button.setAttribute("type", "submit");
            button.setAttribute("value", "submit");
            button.setAttribute("class", "button button-register w-100");
            var div = document.getElementById("buttonDiv");
            div.appendChild(button);
          }
          else if(choice=="customer"){
            <!-- Customer -->
            document.getElementById('error-msg').innerHTML = '';
            //For first name
            //For div
            var fNameDiv = document.createElement("div");
            fNameDiv.setAttribute("id", "fNameDiv");
            fNameDiv.setAttribute("class", "col-md-12 form-group");
            var form = document.getElementById("register_form");
            form.appendChild(fNameDiv);
            //For input
            var fName = document.createElement("input");
            fName.setAttribute("type", "text");
            fName.setAttribute("class", "form-control");
            fName.setAttribute("id", "name");
            fName.setAttribute("name", "firstName");
            fName.setAttribute("placeholder", "First Name");
            fName.setAttribute("onfocus", "this.placeholder = ''");
            fName.setAttribute("onblur", "this.placeholder = 'First Name'");
            addRequired(fName);
            var div = document.getElementById("fNameDiv");
            div.appendChild(fName);

            //for last name
            //For div
            var lNameDiv = document.createElement("div");
            lNameDiv.setAttribute("id", "lNameDiv");
            lNameDiv.setAttribute("class", "col-md-12 form-group");
            var form = document.getElementById("register_form");
            form.appendChild(lNameDiv);
            //For input
            var lName = document.createElement("input");
            lName.setAttribute("type", "text");
            lName.setAttribute("class", "form-control");
            lName.setAttribute("id", "name");
            lName.setAttribute("name", "lastName");
            lName.setAttribute("placeholder", "Last Name");
            lName.setAttribute("onfocus", "this.placeholder = ''");
            lName.setAttribute("onblur", "this.placeholder = 'last Name'");
            addRequired(lName);
            var div = document.getElementById("lNameDiv");
            div.appendChild(lName);

            //for email
            //For div
            var emailDiv = document.createElement("div");
            emailDiv.setAttribute("id", "emailDiv");
            emailDiv.setAttribute("class", "col-md-12 form-group");
            var form = document.getElementById("register_form");
            form.appendChild(emailDiv);
            //For input
            var email = document.createElement("input");
            email.setAttribute("type", "email");
            email.setAttribute("class", "form-control");
            email.setAttribute("id", "email");
            email.setAttribute("name", "email");
            email.setAttribute("placeholder", "Email");
            email.setAttribute("onfocus", "this.placeholder = ''");
            email.setAttribute("onblur", "this.placeholder = 'Email'");
            email.setAttribute("onchange","emailVerify()");


            addRequired(email);
            var div = document.getElementById("emailDiv");
            div.appendChild(email);

            //for password
            //For div
            var passwordDiv = document.createElement("div");
            passwordDiv.setAttribute("id", "passwordDiv");
            passwordDiv.setAttribute("class", "col-md-12 form-group");
            var form = document.getElementById("register_form");
            form.appendChild(passwordDiv);
            //For input
            var password = document.createElement("input");
            password.setAttribute("type", "password");
            password.setAttribute("class", "form-control");
            password.setAttribute("id", "password");
            password.setAttribute("name", "password");
            password.setAttribute("placeholder", "Password");
            password.setAttribute("onfocus", "this.placeholder = ''");
            password.setAttribute("onblur", "this.placeholder = 'Password'");
            password.setAttribute("onkeyup","passwordVerify()");
            addRequired(password);
            var div = document.getElementById("passwordDiv");
            div.appendChild(password);

            //for confirm password
            //For div
            var confirmPasswordDiv = document.createElement("div");
            confirmPasswordDiv.setAttribute("id", "confirmPasswordDiv");
            confirmPasswordDiv.setAttribute("class", "col-md-12 form-group");
            var form = document.getElementById("register_form");
            form.appendChild(confirmPasswordDiv);
            //For input
            var confirmPassword = document.createElement("input");
            confirmPassword.setAttribute("type", "password");
            confirmPassword.setAttribute("class", "form-control");
            confirmPassword.setAttribute("id", "confirmPassword");
            confirmPassword.setAttribute("name", "confirmPassword");
            confirmPassword.setAttribute("placeholder", "Confirm Password");
            confirmPassword.setAttribute("onfocus", "this.placeholder = ''");
            confirmPassword.setAttribute("onblur", "this.placeholder = 'Confirm Password'");
            confirmPassword.setAttribute("onkeyup","passwordVerify()");
            addRequired(confirmPassword);
            var div = document.getElementById("confirmPasswordDiv");
            div.appendChild(confirmPassword);



            //for checkbox
            //For div
            var checkBoxDiv = document.createElement("div");
            checkBoxDiv.setAttribute("id", "checkBoxDiv");
            checkBoxDiv.setAttribute("class", "col-md-12 form-group");
            var form = document.getElementById("register_form");
            form.appendChild(checkBoxDiv);
            //for divdiv
            var checkBoxDivDiv = document.createElement("div");
            checkBoxDivDiv.setAttribute("id", "checkBoxDivDiv");
            checkBoxDivDiv.setAttribute("class", "creat_account");
            var form = document.getElementById("checkBoxDiv");
            form.appendChild(checkBoxDivDiv);
            //For input
            var checkBox = document.createElement("input");
            checkBox.setAttribute("type", "checkbox");
            checkBox.setAttribute("id", "f-option2");
            checkBox.setAttribute("name", "selector");
            var div = document.getElementById("checkBoxDivDiv");
            div.appendChild(checkBox);
            //For input
            var keepMe = document.createElement("label");
            var labelText = document.createTextNode("Keep me logged in");
            keepMe.appendChild(labelText);
            keepMe.setAttribute("for", "f-option2");
            keepMe.setAttribute("id", "keepMe");
            var div = document.getElementById("checkBoxDivDiv");
            div.appendChild(keepMe);

            //for button
            //for div
            var buttonDiv = document.createElement("div");
            buttonDiv.setAttribute("id", "buttonDiv");
            buttonDiv.setAttribute("class", "col-md-12 form-group");
            var form = document.getElementById("register_form");
            form.appendChild(buttonDiv);
            //for btn
            var button = document.createElement("button");
            var btnText = document.createTextNode("Register");
            button.appendChild(btnText);
            button.setAttribute("id", "registerButton");
            button.setAttribute("type", "submit");
            button.setAttribute("value", "submit");
            button.setAttribute("class", "button button-register w-100");
            var div = document.getElementById("buttonDiv");
            div.appendChild(button);
          }
        }
        else if(isExist && prevAcct=="Customer"){
          parent.removeChild(child1);
          parent.removeChild(child2);
          parent.removeChild(child3);
          parent.removeChild(child4);
          parent.removeChild(child5);
          parent.removeChild(child7);
          parent.removeChild(child8);
          if(choice=="merchant"){
            <!-- Merchant -->
            document.getElementById('error-msg').innerHTML = '';
            var fNameDiv = document.createElement("div");
            fNameDiv.setAttribute("id", "fNameDiv");
            fNameDiv.setAttribute("class", "col-md-12 form-group");
            var form = document.getElementById("register_form");
            form.appendChild(fNameDiv);
            //For input
            var fName = document.createElement("input");
            fName.setAttribute("type", "text");
            fName.setAttribute("class", "form-control");
            fName.setAttribute("id", "name");
            fName.setAttribute("name", "firstName");
            fName.setAttribute("placeholder", "First Name");
            fName.setAttribute("onfocus", "this.placeholder = ''");
            fName.setAttribute("onblur", "this.placeholder = 'First Name'");
            addRequired(fName);
            var div = document.getElementById("fNameDiv");
            div.appendChild(fName);

            //for last name
            //For div
            var lNameDiv = document.createElement("div");
            lNameDiv.setAttribute("id", "lNameDiv");
            lNameDiv.setAttribute("class", "col-md-12 form-group");
            var form = document.getElementById("register_form");
            form.appendChild(lNameDiv);
            //For input
            var lName = document.createElement("input");
            lName.setAttribute("type", "text");
            lName.setAttribute("class", "form-control");
            lName.setAttribute("id", "name");
            lName.setAttribute("name", "lastName");
            lName.setAttribute("placeholder", "Last Name");
            lName.setAttribute("onfocus", "this.placeholder = ''");
            lName.setAttribute("onblur", "this.placeholder = 'last Name'");
            addRequired(lName);
            var div = document.getElementById("lNameDiv");
            div.appendChild(lName);

            //for email
            //For div
            var emailDiv = document.createElement("div");
            emailDiv.setAttribute("id", "emailDiv");
            emailDiv.setAttribute("class", "col-md-12 form-group");
            var form = document.getElementById("register_form");
            form.appendChild(emailDiv);
            //For input
            var email = document.createElement("input");
            email.setAttribute("type", "email");
            email.setAttribute("class", "form-control");
            email.setAttribute("id", "email");
            email.setAttribute("name", "email");
            email.setAttribute("placeholder", "Email");
            email.setAttribute("onfocus", "this.placeholder = ''");
            email.setAttribute("onblur", "this.placeholder = 'Email'");
            email.setAttribute("onchange","emailVerify()");


            addRequired(email);
            var div = document.getElementById("emailDiv");
            div.appendChild(email);

            //for password
            //For div
            var passwordDiv = document.createElement("div");
            passwordDiv.setAttribute("id", "passwordDiv");
            passwordDiv.setAttribute("class", "col-md-12 form-group");
            var form = document.getElementById("register_form");
            form.appendChild(passwordDiv);
            //For input
            var password = document.createElement("input");
            password.setAttribute("type", "password");
            password.setAttribute("class", "form-control");
            password.setAttribute("id", "password");
            password.setAttribute("name", "password");
            password.setAttribute("placeholder", "Password");
            password.setAttribute("onfocus", "this.placeholder = ''");
            password.setAttribute("onblur", "this.placeholder = 'Password'");
            password.setAttribute("onkeyup","passwordVerify()");
            addRequired(password);

            var div = document.getElementById("passwordDiv");
            div.appendChild(password);

            //for confirm password
            //For div
            var confirmPasswordDiv = document.createElement("div");
            confirmPasswordDiv.setAttribute("id", "confirmPasswordDiv");
            confirmPasswordDiv.setAttribute("class", "col-md-12 form-group");
            var form = document.getElementById("register_form");
            form.appendChild(confirmPasswordDiv);
            //For input
            var confirmPassword = document.createElement("input");
            confirmPassword.setAttribute("type", "password");
            confirmPassword.setAttribute("class", "form-control");
            confirmPassword.setAttribute("id", "confirmPassword");
            confirmPassword.setAttribute("name", "confirmPassword");
            confirmPassword.setAttribute("placeholder", "Confirm Password");
            confirmPassword.setAttribute("onfocus", "this.placeholder = ''");
            confirmPassword.setAttribute("onblur", "this.placeholder = 'Confirm Password'");
            confirmPassword.setAttribute("onkeyup","passwordVerify()");
            addRequired(confirmPassword);
            var div = document.getElementById("confirmPasswordDiv");
            div.appendChild(confirmPassword);

            //for business name
            //For div
            var businessNameDiv = document.createElement("div");
            businessNameDiv.setAttribute("id", "businessNameDiv");
            businessNameDiv.setAttribute("class", "col-md-12 form-group");
            var form = document.getElementById("register_form");
            form.appendChild(businessNameDiv);
            //For input
            var businessName = document.createElement("input");
            businessName.setAttribute("type", "text");
            businessName.setAttribute("class", "form-control");
            businessName.setAttribute("id", "businessName");
            businessName.setAttribute("name", "businessName");
            businessName.setAttribute("placeholder", "Business Name");
            businessName.setAttribute("onfocus", "this.placeholder = ''");
            businessName.setAttribute("onblur", "this.placeholder = 'Business Name'");
            addRequired(businessName);
            var div = document.getElementById("businessNameDiv");
            div.appendChild(businessName);

            //for checkbox
            //For div
            var checkBoxDiv = document.createElement("div");
            checkBoxDiv.setAttribute("id", "checkBoxDiv");
            checkBoxDiv.setAttribute("class", "col-md-12 form-group");
            var form = document.getElementById("register_form");
            form.appendChild(checkBoxDiv);
            //for divdiv
            var checkBoxDivDiv = document.createElement("div");
            checkBoxDivDiv.setAttribute("id", "checkBoxDivDiv");
            checkBoxDivDiv.setAttribute("class", "creat_account");
            var form = document.getElementById("checkBoxDiv");
            form.appendChild(checkBoxDivDiv);
            //For input
            var checkBox = document.createElement("input");
            checkBox.setAttribute("type", "checkbox");
            checkBox.setAttribute("id", "f-option2");
            checkBox.setAttribute("name", "selector");
            var div = document.getElementById("checkBoxDivDiv");
            div.appendChild(checkBox);
            //For input
            var keepMe = document.createElement("label");
            var labelText = document.createTextNode("Keep me logged in");
            keepMe.appendChild(labelText);
            keepMe.setAttribute("for", "f-option2");
            keepMe.setAttribute("id", "keepMe");
            var div = document.getElementById("checkBoxDivDiv");
            div.appendChild(keepMe);

            //for button
            //for div
            var buttonDiv = document.createElement("div");
            buttonDiv.setAttribute("id", "buttonDiv");
            buttonDiv.setAttribute("class", "col-md-12 form-group");
            var form = document.getElementById("register_form");
            form.appendChild(buttonDiv);
            //for btn
            var button = document.createElement("button");
            var btnText = document.createTextNode("Register");
            button.appendChild(btnText);
            button.setAttribute("id", "registerButton");
            button.setAttribute("type", "submit");
            button.setAttribute("value", "submit");
            button.setAttribute("class", "button button-register w-100");
            var div = document.getElementById("buttonDiv");
            div.appendChild(button);
          }
          else if(choice=="customer"){
            <!-- Customer -->
            document.getElementById('error-msg').innerHTML = '';
            //For first name
            //For div
            var fNameDiv = document.createElement("div");
            fNameDiv.setAttribute("id", "fNameDiv");
            fNameDiv.setAttribute("class", "col-md-12 form-group");
            var form = document.getElementById("register_form");
            form.appendChild(fNameDiv);
            //For input
            var fName = document.createElement("input");
            fName.setAttribute("type", "text");
            fName.setAttribute("class", "form-control");
            fName.setAttribute("id", "name");
            fName.setAttribute("name", "firstName");
            fName.setAttribute("placeholder", "First Name");
            fName.setAttribute("onfocus", "this.placeholder = ''");
            fName.setAttribute("onblur", "this.placeholder = 'First Name'");
            addRequired(fName);
            var div = document.getElementById("fNameDiv");
            div.appendChild(fName);

            //for last name
            //For div
            var lNameDiv = document.createElement("div");
            lNameDiv.setAttribute("id", "lNameDiv");
            lNameDiv.setAttribute("class", "col-md-12 form-group");
            var form = document.getElementById("register_form");
            form.appendChild(lNameDiv);
            //For input
            var lName = document.createElement("input");
            lName.setAttribute("type", "text");
            lName.setAttribute("class", "form-control");
            lName.setAttribute("id", "name");
            lName.setAttribute("name", "lastName");
            lName.setAttribute("placeholder", "Last Name");
            lName.setAttribute("onfocus", "this.placeholder = ''");
            lName.setAttribute("onblur", "this.placeholder = 'last Name'");
            addRequired(lName);
            var div = document.getElementById("lNameDiv");
            div.appendChild(lName);

            //for email
            //For div
            var emailDiv = document.createElement("div");
            emailDiv.setAttribute("id", "emailDiv");
            emailDiv.setAttribute("class", "col-md-12 form-group");
            var form = document.getElementById("register_form");
            form.appendChild(emailDiv);
            //For input
            var email = document.createElement("input");
            email.setAttribute("type", "email");
            email.setAttribute("class", "form-control");
            email.setAttribute("id", "email");
            email.setAttribute("name", "email");
            email.setAttribute("placeholder", "Email");
            email.setAttribute("onfocus", "this.placeholder = ''");
            email.setAttribute("onblur", "this.placeholder = 'Email'");
            email.setAttribute("onchange","emailVerify()");


            addRequired(email);
            var div = document.getElementById("emailDiv");
            div.appendChild(email);

            //for password
            //For div
            var passwordDiv = document.createElement("div");
            passwordDiv.setAttribute("id", "passwordDiv");
            passwordDiv.setAttribute("class", "col-md-12 form-group");
            var form = document.getElementById("register_form");
            form.appendChild(passwordDiv);
            //For input
            var password = document.createElement("input");
            password.setAttribute("type", "password");
            password.setAttribute("class", "form-control");
            password.setAttribute("id", "password");
            password.setAttribute("name", "password");
            password.setAttribute("placeholder", "Password");
            password.setAttribute("onfocus", "this.placeholder = ''");
            password.setAttribute("onblur", "this.placeholder = 'Password'");
            password.setAttribute("onkeyup","passwordVerify()");
            addRequired(password);
            var div = document.getElementById("passwordDiv");
            div.appendChild(password);

            //for confirm password
            //For div
            var confirmPasswordDiv = document.createElement("div");
            confirmPasswordDiv.setAttribute("id", "confirmPasswordDiv");
            confirmPasswordDiv.setAttribute("class", "col-md-12 form-group");
            var form = document.getElementById("register_form");
            form.appendChild(confirmPasswordDiv);
            //For input
            var confirmPassword = document.createElement("input");
            confirmPassword.setAttribute("type", "password");
            confirmPassword.setAttribute("class", "form-control");
            confirmPassword.setAttribute("id", "confirmPassword");
            confirmPassword.setAttribute("name", "confirmPassword");
            confirmPassword.setAttribute("placeholder", "Confirm Password");
            confirmPassword.setAttribute("onfocus", "this.placeholder = ''");
            confirmPassword.setAttribute("onblur", "this.placeholder = 'Confirm Password'");
            confirmPassword.setAttribute("onkeyup","passwordVerify()");
            addRequired(confirmPassword);
            var div = document.getElementById("confirmPasswordDiv");
            div.appendChild(confirmPassword);

            //for checkbox
            //For div
            var checkBoxDiv = document.createElement("div");
            checkBoxDiv.setAttribute("id", "checkBoxDiv");
            checkBoxDiv.setAttribute("class", "col-md-12 form-group");
            var form = document.getElementById("register_form");
            form.appendChild(checkBoxDiv);
            //for divdiv
            var checkBoxDivDiv = document.createElement("div");
            checkBoxDivDiv.setAttribute("id", "checkBoxDivDiv");
            checkBoxDivDiv.setAttribute("class", "creat_account");
            var form = document.getElementById("checkBoxDiv");
            form.appendChild(checkBoxDivDiv);
            //For input
            var checkBox = document.createElement("input");
            checkBox.setAttribute("type", "checkbox");
            checkBox.setAttribute("id", "f-option2");
            checkBox.setAttribute("name", "selector");
            var div = document.getElementById("checkBoxDivDiv");
            div.appendChild(checkBox);
            //For input
            var keepMe = document.createElement("label");
            var labelText = document.createTextNode("Keep me logged in");
            keepMe.appendChild(labelText);
            keepMe.setAttribute("for", "f-option2");
            keepMe.setAttribute("id", "keepMe");
            var div = document.getElementById("checkBoxDivDiv");
            div.appendChild(keepMe);

            //for button
            //for div
            var buttonDiv = document.createElement("div");
            buttonDiv.setAttribute("id", "buttonDiv");
            buttonDiv.setAttribute("class", "col-md-12 form-group");
            var form = document.getElementById("register_form");
            form.appendChild(buttonDiv);
            //for btn
            var button = document.createElement("button");
            var btnText = document.createTextNode("Register");
            button.appendChild(btnText);
            button.setAttribute("id", "registerButton");
            button.setAttribute("type", "submit");
            button.setAttribute("value", "submit");
            button.setAttribute("class", "button button-register w-100");
            var div = document.getElementById("buttonDiv");
            div.appendChild(button);
          }
        }
        else{
          if(choice=="merchant"){
            <!-- Merchant -->
            document.getElementById('error-msg').innerHTML = '';
            var fNameDiv = document.createElement("div");
            fNameDiv.setAttribute("id", "fNameDiv");
            fNameDiv.setAttribute("class", "col-md-12 form-group");
            var form = document.getElementById("register_form");
            form.appendChild(fNameDiv);
            //For input
            var fName = document.createElement("input");
            fName.setAttribute("type", "text");
            fName.setAttribute("class", "form-control");
            fName.setAttribute("id", "name");
            fName.setAttribute("name", "firstName");
            fName.setAttribute("placeholder", "First Name");
            fName.setAttribute("onfocus", "this.placeholder = ''");
            fName.setAttribute("onblur", "this.placeholder = 'First Name'");
            addRequired(fName);
            var div = document.getElementById("fNameDiv");
            div.appendChild(fName);

            //for last name
            //For div
            var lNameDiv = document.createElement("div");
            lNameDiv.setAttribute("id", "lNameDiv");
            lNameDiv.setAttribute("class", "col-md-12 form-group");
            var form = document.getElementById("register_form");
            form.appendChild(lNameDiv);
            //For input
            var lName = document.createElement("input");
            lName.setAttribute("type", "text");
            lName.setAttribute("class", "form-control");
            lName.setAttribute("id", "name");
            lName.setAttribute("name", "lastName");
            lName.setAttribute("placeholder", "Last Name");
            lName.setAttribute("onfocus", "this.placeholder = ''");
            lName.setAttribute("onblur", "this.placeholder = 'last Name'");
            addRequired(lName);
            var div = document.getElementById("lNameDiv");
            div.appendChild(lName);

            //for email
            //For div
            var emailDiv = document.createElement("div");
            emailDiv.setAttribute("id", "emailDiv");
            emailDiv.setAttribute("class", "col-md-12 form-group");
            var form = document.getElementById("register_form");
            form.appendChild(emailDiv);
            //For input
            var email = document.createElement("input");
            email.setAttribute("type", "email");
            email.setAttribute("class", "form-control");
            email.setAttribute("id", "email");
            email.setAttribute("name", "email");
            email.setAttribute("placeholder", "Email");
            email.setAttribute("onfocus", "this.placeholder = ''");
            email.setAttribute("onblur", "this.placeholder = 'Email'");
            email.setAttribute("onchange","emailVerify()");


            addRequired(email);
            var div = document.getElementById("emailDiv");
            div.appendChild(email);

            //for password
            //For div
            var passwordDiv = document.createElement("div");
            passwordDiv.setAttribute("id", "passwordDiv");
            passwordDiv.setAttribute("class", "col-md-12 form-group");
            var form = document.getElementById("register_form");
            form.appendChild(passwordDiv);
            //For input
            var password = document.createElement("input");
            password.setAttribute("type", "password");
            password.setAttribute("class", "form-control");
            password.setAttribute("id", "password");
            password.setAttribute("name", "password");
            password.setAttribute("placeholder", "Password");
            password.setAttribute("onfocus", "this.placeholder = ''");
            password.setAttribute("onblur", "this.placeholder = 'Password'");
            password.setAttribute("onkeyup","passwordVerify()");
            addRequired(password);

            var div = document.getElementById("passwordDiv");
            div.appendChild(password);

            //for confirm password
            //For div
            var confirmPasswordDiv = document.createElement("div");
            confirmPasswordDiv.setAttribute("id", "confirmPasswordDiv");
            confirmPasswordDiv.setAttribute("class", "col-md-12 form-group");
            var form = document.getElementById("register_form");
            form.appendChild(confirmPasswordDiv);
            //For input
            var confirmPassword = document.createElement("input");
            confirmPassword.setAttribute("type", "password");
            confirmPassword.setAttribute("class", "form-control");
            confirmPassword.setAttribute("id", "confirmPassword");
            confirmPassword.setAttribute("name", "confirmPassword");
            confirmPassword.setAttribute("placeholder", "Confirm Password");
            confirmPassword.setAttribute("onfocus", "this.placeholder = ''");
            confirmPassword.setAttribute("onblur", "this.placeholder = 'Confirm Password'");
            confirmPassword.setAttribute("onkeyup","passwordVerify()");
            addRequired(confirmPassword);
            var div = document.getElementById("confirmPasswordDiv");
            div.appendChild(confirmPassword);

            //for business name
            //For div
            var businessNameDiv = document.createElement("div");
            businessNameDiv.setAttribute("id", "businessNameDiv");
            businessNameDiv.setAttribute("class", "col-md-12 form-group");
            var form = document.getElementById("register_form");
            form.appendChild(businessNameDiv);
            //For input
            var businessName = document.createElement("input");
            businessName.setAttribute("type", "text");
            businessName.setAttribute("class", "form-control");
            businessName.setAttribute("id", "businessName");
            businessName.setAttribute("name", "businessName");
            businessName.setAttribute("placeholder", "Business Name");
            businessName.setAttribute("onfocus", "this.placeholder = ''");
            businessName.setAttribute("onblur", "this.placeholder = 'Business Name'");
            addRequired(businessName);
            var div = document.getElementById("businessNameDiv");
            div.appendChild(businessName);

            //for checkbox
            //For div
            var checkBoxDiv = document.createElement("div");
            checkBoxDiv.setAttribute("id", "checkBoxDiv");
            checkBoxDiv.setAttribute("class", "col-md-12 form-group");
            var form = document.getElementById("register_form");
            form.appendChild(checkBoxDiv);
            //for divdiv
            var checkBoxDivDiv = document.createElement("div");
            checkBoxDivDiv.setAttribute("id", "checkBoxDivDiv");
            checkBoxDivDiv.setAttribute("class", "creat_account");
            var form = document.getElementById("checkBoxDiv");
            form.appendChild(checkBoxDivDiv);
            //For input
            var checkBox = document.createElement("input");
            checkBox.setAttribute("type", "checkbox");
            checkBox.setAttribute("id", "f-option2");
            checkBox.setAttribute("name", "selector");
            var div = document.getElementById("checkBoxDivDiv");
            div.appendChild(checkBox);
            //For input
            var keepMe = document.createElement("label");
            var labelText = document.createTextNode("Keep me logged in");
            keepMe.appendChild(labelText);
            keepMe.setAttribute("for", "f-option2");
            keepMe.setAttribute("id", "keepMe");
            var div = document.getElementById("checkBoxDivDiv");
            div.appendChild(keepMe);

            //for button
            //for div
            var buttonDiv = document.createElement("div");
            buttonDiv.setAttribute("id", "buttonDiv");
            buttonDiv.setAttribute("class", "col-md-12 form-group");
            var form = document.getElementById("register_form");
            form.appendChild(buttonDiv);
            //for btn
            var button = document.createElement("button");
            var btnText = document.createTextNode("Register");
            button.appendChild(btnText);
            button.setAttribute("id", "registerButton");
            button.setAttribute("type", "submit");
            button.setAttribute("value", "submit");
            button.setAttribute("class", "button button-register w-100");
            var div = document.getElementById("buttonDiv");
            div.appendChild(button);
          }
          else if(choice=="customer"){
            <!-- Customer -->
            document.getElementById('error-msg').innerHTML = '';
            //For first name
            //For div
            var fNameDiv = document.createElement("div");
            fNameDiv.setAttribute("id", "fNameDiv");
            fNameDiv.setAttribute("class", "col-md-12 form-group");
            var form = document.getElementById("register_form");
            form.appendChild(fNameDiv);
            //For input
            var fName = document.createElement("input");
            fName.setAttribute("type", "text");
            fName.setAttribute("class", "form-control");
            fName.setAttribute("id", "name");
            fName.setAttribute("name", "firstName");
            fName.setAttribute("placeholder", "First Name");
            fName.setAttribute("onfocus", "this.placeholder = ''");
            fName.setAttribute("onblur", "this.placeholder = 'First Name'");
            addRequired(fName);
            var div = document.getElementById("fNameDiv");
            div.appendChild(fName);

            //for last name
            //For div
            var lNameDiv = document.createElement("div");
            lNameDiv.setAttribute("id", "lNameDiv");
            lNameDiv.setAttribute("class", "col-md-12 form-group");
            var form = document.getElementById("register_form");
            form.appendChild(lNameDiv);
            //For input
            var lName = document.createElement("input");
            lName.setAttribute("type", "text");
            lName.setAttribute("class", "form-control");
            lName.setAttribute("id", "name");
            lName.setAttribute("name", "lastName");
            lName.setAttribute("placeholder", "Last Name");
            lName.setAttribute("onfocus", "this.placeholder = ''");
            lName.setAttribute("onblur", "this.placeholder = 'last Name'");
            addRequired(lName);
            var div = document.getElementById("lNameDiv");
            div.appendChild(lName);

            //for email
            //For div
            var emailDiv = document.createElement("div");
            emailDiv.setAttribute("id", "emailDiv");
            emailDiv.setAttribute("class", "col-md-12 form-group");
            var form = document.getElementById("register_form");
            form.appendChild(emailDiv);
            //For input
            var email = document.createElement("input");
            email.setAttribute("type", "email");
            email.setAttribute("class", "form-control");
            email.setAttribute("id", "email");
            email.setAttribute("name", "email");
            email.setAttribute("placeholder", "Email");
            email.setAttribute("onfocus", "this.placeholder = ''");
            email.setAttribute("onblur", "this.placeholder = 'Email'");
            email.setAttribute("onchange","emailVerify()");


            addRequired(email);
            var div = document.getElementById("emailDiv");
            div.appendChild(email);

            //for password
            //For div
            var passwordDiv = document.createElement("div");
            passwordDiv.setAttribute("id", "passwordDiv");
            passwordDiv.setAttribute("class", "col-md-12 form-group");
            var form = document.getElementById("register_form");
            form.appendChild(passwordDiv);
            //For input
            var password = document.createElement("input");
            password.setAttribute("type", "password");
            password.setAttribute("class", "form-control");
            password.setAttribute("id", "password");
            password.setAttribute("name", "password");
            password.setAttribute("placeholder", "Password");
            password.setAttribute("onfocus", "this.placeholder = ''");
            password.setAttribute("onblur", "this.placeholder = 'Password'");
            password.setAttribute("onkeyup","passwordVerify()");
            addRequired(password);
            var div = document.getElementById("passwordDiv");
            div.appendChild(password);

            //for confirm password
            //For div
            var confirmPasswordDiv = document.createElement("div");
            confirmPasswordDiv.setAttribute("id", "confirmPasswordDiv");
            confirmPasswordDiv.setAttribute("class", "col-md-12 form-group");
            var form = document.getElementById("register_form");
            form.appendChild(confirmPasswordDiv);
            //For input
            var confirmPassword = document.createElement("input");
            confirmPassword.setAttribute("type", "password");
            confirmPassword.setAttribute("class", "form-control");
            confirmPassword.setAttribute("id", "confirmPassword");
            confirmPassword.setAttribute("name", "confirmPassword");
            confirmPassword.setAttribute("placeholder", "Confirm Password");
            confirmPassword.setAttribute("onfocus", "this.placeholder = ''");
            confirmPassword.setAttribute("onblur", "this.placeholder = 'Confirm Password'");
            confirmPassword.setAttribute("onkeyup","passwordVerify()");
            addRequired(confirmPassword);
            var div = document.getElementById("confirmPasswordDiv");
            div.appendChild(confirmPassword);


            //for checkbox
            //For div
            var checkBoxDiv = document.createElement("div");
            checkBoxDiv.setAttribute("id", "checkBoxDiv");
            checkBoxDiv.setAttribute("class", "col-md-12 form-group");
            var form = document.getElementById("register_form");
            form.appendChild(checkBoxDiv);
            //for divdiv
            var checkBoxDivDiv = document.createElement("div");
            checkBoxDivDiv.setAttribute("id", "checkBoxDivDiv");
            checkBoxDivDiv.setAttribute("class", "creat_account");
            var form = document.getElementById("checkBoxDiv");
            form.appendChild(checkBoxDivDiv);
            //For input
            var checkBox = document.createElement("input");
            checkBox.setAttribute("type", "checkbox");
            checkBox.setAttribute("id", "f-option2");
            checkBox.setAttribute("name", "selector");
            var div = document.getElementById("checkBoxDivDiv");
            div.appendChild(checkBox);
            //For input
            var keepMe = document.createElement("label");
            var labelText = document.createTextNode("Keep me logged in");
            keepMe.appendChild(labelText);
            keepMe.setAttribute("for", "f-option2");
            keepMe.setAttribute("id", "keepMe");
            var div = document.getElementById("checkBoxDivDiv");
            div.appendChild(keepMe);

            //for button
            //for div
            var buttonDiv = document.createElement("div");
            buttonDiv.setAttribute("id", "buttonDiv");
            buttonDiv.setAttribute("class", "col-md-12 form-group");
            var form = document.getElementById("register_form");
            form.appendChild(buttonDiv);
            //for btn
            var button = document.createElement("button");
            var btnText = document.createTextNode("Register");
            button.appendChild(btnText);
            button.setAttribute("id", "registerButton");
            button.setAttribute("type", "submit");
            button.setAttribute("value", "submit");
            button.setAttribute("class", "button button-register w-100");
            var div = document.getElementById("buttonDiv");
            div.appendChild(button);
          }
        }
      }
  </script>
</body>
</html>
