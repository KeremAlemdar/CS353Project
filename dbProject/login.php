<?php
include('./connection/config.php');
session_start();

if (isset($_POST['logIn'])) {
	$email = $_POST['email'];
	$pass = $_POST['pass'];
	$query = "select user_id from account where email='$email' or username='$email' and password='$pass'";
	$result = $mysqli->query($query);
	if ($result->num_rows == 1) {
		$user_id = $result->fetch_array(MYSQLI_NUM)[0];
		$_SESSION['user_id'] = $user_id;
		$query = "select * from Employee where employee_id='$user_id'";
		$result = $mysqli->query($query);
		if ($result->num_rows == 1) { // if enployee
			header("Location: login.php?msg=emp");
		} else {
			$query = "select * from Guide where guide_id='$user_id'";
			$result = $mysqli->query($query);
			if ($result->num_rows == 1) { // guide
				header("Location: login.php?msg=guide");
			} else {
				header("Location: login.php?msg=cust");
			}
		}
	} else {
		echo '<script language="javascript">';
		echo 'alert("Account Not Found")';
		echo '</script>';
	}
}

if (isset($_POST['register'])) {
	$email = $_POST['email'];
	$pss = $_POST['pass'];
	$username = $_POST['username'];
	$fname = $_POST['fname'];
	$phonenum = $_POST['pn'];
	$query = "insert into account values(null, '$username','$pss','$email','$phonenum', '$fname')";
	if ($result = $mysqli->query($query)) {
		$user_id = $mysqli->insert_id;
		$query = "insert into customer values('$user_id')";
		$mysqli->query($query);
		header("Location: login.php?msg=regdone");
	} else {
		// header("Location: login.php?msg=err");
	}
}

if (isset($_POST['registerGuide'])) {
	$email = $_POST['email'];
	$pss = $_POST['pass'];
	$username = $_POST['username'];
	$fname = $_POST['fname'];
	$phonenum = $_POST['pn'];

	$query = "insert into account values(null, '$username','$pss','$email','$phonenum', '$fname')";
	if ($result = $mysqli->query($query)) {
		$user_id = $mysqli->insert_id;
		$query = "insert into guide values('$user_id')";
		if ($result = $mysqli->query($query)) {
			// header("Location: mainPage.php");
		} else {
			// header("Location: login.php?msg=err");
		}
	} else {
		// header("Location: login.php?msg=err");
	}
}
?>

<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="login.css">
</head>

<body>
	<div class="login-wrap">
		<div class="login-html">
			<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>
			<input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>
			<div class="login-form">
				<form name="f1" class="sign-in-htm" action="login.php" onsubmit="return validation()" method="POST">
					<div class="group">
						<label for="user" class="label">E-mail</label>
						<input id="userl" name="email" type="text" class="input">
					</div>
					<div class="group">
						<label for="pass" class="label">Password</label>
						<input id="passl" name="pass" type="pass" class="input" data-type="password">
					</div>
					<div class="group">
						<input type="submit" class="button" value="Sign In" name="logIn">
					</div>
				</form>
				<script>
					function validation() {
						var id = document.f1.email.value;
						var ps = document.f1.passl.value;
						if (id.length == "" && ps.length == "") {
							alert("User Name and Password fields are empty");
							return false;
						} else {
							if (id.length == "") {
								alert("User Name is empty");
								return false;
							}
							if (ps.length == "") {
								alert("Password field is empty");
								return false;
							}
						}
					}
				</script>
				<form name="f2" class="sign-up-htm" action="login.php" onsubmit="return validationS()" method="POST">
					<div class="group">
						<label for="user" class="label">Full Name</label>
						<input id="fname" name="fname" type="text" class="input">
					</div>
					<div class="group">
						<label for="user" class="label">Username</label>
						<input id="user" name="username" type="text" class="input">
					</div>
					<div class="group">
						<label for="pass" class="label">Password</label>
						<input id="pass" name="pass" type="password" class="input">
					</div>
					<div class="group">
						<label for="pass" class="label">Repeat Password</label>
						<input id="passv" name="passv" type="password" class="input">
					</div>
					<div class="group">
						<label for="pass" class="label">Email Address</label>
						<input id="email" name="email" type="text" class="input">
					</div>
					<div class="group">
						<label for="pass" class="label">Phone Number</label>
						<input id="pn" name="pn" type="tel" class="input">
					</div>
					<div class="group">
						<input type="submit" class="button" value="Sign Up" name="register">
					</div>
					<br>
					<div class="group">
						<input type="submit" class="button" value="Sign Up Guide" name="registerGuide">
					</div>
				</form>
				<script>
					function validationS() {
						var id = document.f2.username.value;
						var ps = document.f2.pass.value;
						var psv = document.f2.passv.value;
						var email = document.f2.email.value;
						if (id.length == 0 && ps.length == 0 && psv.length == 0 && email.length == 0) {
							alert("Fill all");
							return false;
						}
						if (ps != psv) {
							alert("Not match");
						}
					}
				</script>
			</div>
		</div>
	</div>
</body>

</html>