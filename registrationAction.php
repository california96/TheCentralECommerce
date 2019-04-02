<?php
	//For Database Connection
	require_once "config.php";

	/*
	//Registration Variable Declaration & Initialization
	$rFirstName = $_POST['rLastName'];
	$rLastName = $_POST['rFirstName'];

	$rPassword = $_POST['rPassword'];
	$rConfirmPassword = $_POST['rConfirmPassword'];
	*/
	//true is returned as 1 and false as 0

	$isEmailBlank = false;
	$isPasswordMatch = false;
	$isEmailValid = false;
	$result;
	//Checks if the method used by the form is POST
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		//Checks if email is blank
		$isEmailBlank = blankEmail(trim($_POST["email"]));
		//Checks if password matches
		$isPasswordMatch = passwordMatch(trim($_POST["password"]),trim($_POST["confirmPassword"]));
		//Checks if email used is iAcademy Email
		$isEmailValid = validEmail(trim($_POST["email"]));

		//Assuming we only care about the email being valid
		if($isEmailValid){
			//Check if the validated email already exists in the Database
			$sql = "SELECT userid FROM users where email = ?";
				//$link is if DB Conn is established?? I guess
				if($stmt = mysqli_prepare($link, $sql)){
					//Bind variables to the prepared statement as parameters
					mysqli_stmt_bind_param($stmt, "s", $rEmail);
					//Initialize the variable to be used as a parameter in the prepared statement
					$rEmail = trim($_POST['email']);
					//Execute query
					mysqli_stmt_execute($stmt);
					//Bind result variables
					mysqli_stmt_bind_result($stmt,$result);
					//Fetch value
					$resultRows = 0;
					while (mysqli_stmt_fetch($stmt)) {
        		$resultRows++;
    			}
						if($resultRows>0){
							echo "Record already exists";

						}
						else{
							echo "Record already exists not";
							//Gets the inputs from the form
							$sql = "INSERT INTO users(email,password,firstName,lastName) VALUES(?,?,?,?)";
							if($stmt = mysqli_prepare($link, $sql)){
								//Bind variables to the prepared statement as parameters
								mysqli_stmt_bind_param($stmt, "ssss", $rEmail, $rPassword, $rFirstName, $rLastName);
								//Initialize the variable to be used as a parameter in the prepared statement
								$rEmail = trim($_POST['email']);
								$rPassword = trim($_POST['password']);
								$rFirstName = trim($_POST['lastName']);
								$rLastName = trim($_POST['firstName']);
								//Execute query
								mysqli_stmt_execute($stmt);

								$stmt->close();
								echo"</br>" . "Registration Successful!!!!";
								//$conn->close();
							}
						}
			}
		}//End of isEmailValid if
		else {
			//if email is not an iacademy email redirect back
			header('Location: register.html');
			//if possible put a popup or an error message somewhere in register.html after being redirected
			exit;
		}
	}//End of POST if



	//Functions below

	//Probably catched by input type="email" in HTML 5
	function validEmail($rEmail){
		$splitEmail = explode ("@", $rEmail);
		if($splitEmail[1]=="iacademy.edu.ph"){
			return true;
		}
		else{
			return false;
		}
	}

	//Probably catched by required in HTML
	function blankEmail($rEmail){
		if(empty(trim($rEmail))){
			return true;
		}
		else{
			return false;
		}
	}

	//Probably implemented via JS
	function passwordMatch($password, $confirmPassword){
		if($password == $confirmPassword){
			return true;
		}
		else{
			return false;
		}
	}

?>
