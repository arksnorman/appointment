<?php

//session_start();

require_once 'header.php';

$username = $_SESSION["username"];


$conn = mysqli_connect("localhost","root","");
mysqli_select_db($conn,"mulago_db");
if(count($_POST)>0) {
$sql_query = "SELECT * from users WHERE username = '$username'";
$result = mysqli_query($conn, $sql_query);

while($row=mysqli_fetch_array($result)){

		$old_pass = $row["password"];

}

$pwd  =  ($_POST['currentPassword']);
$pass = md5($pwd);

$new_pwd  =  ($_POST['newPassword']);
$new_pass = md5($new_pwd);


if($pass == $old_pass) {

$mysql_query = "UPDATE users set password='$new_pass' WHERE username ='$username'";

	if(mysqli_query($conn, $mysql_query)){

		echo $message = "Password Changed";
	}

} else "Current Password Does Not Match";
}
?>
<!doctype html>
<html>
<head>
<title></title>
<link rel="stylesheet" type="text/css" href="csss/passwd.css" />
<script>
function validatePassword() {
var currentPassword,newPassword,confirmPassword,output = true;

currentPassword = document.frmChange.currentPassword;
newPassword = document.frmChange.newPassword;
confirmPassword = document.frmChange.confirmPassword;

if(!currentPassword.value) {
	currentPassword.focus();
	document.getElementById("currentPassword").innerHTML = "required";
	output = false;
}
else if(!newPassword.value) {
	newPassword.focus();
	document.getElementById("newPassword").innerHTML = "required";
	output = false;
}
else if(!confirmPassword.value) {
	confirmPassword.focus();
	document.getElementById("confirmPassword").innerHTML = "required";
	output = false;
}
if(newPassword.value != confirmPassword.value) {
	newPassword.value="";
	confirmPassword.value="";
	newPassword.focus();
	document.getElementById("confirmPassword").innerHTML = "not same";
	output = false;
} 	
return output;
}
</script>
</head>
<body>

<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-6">
		<div class="card">
  			<div class="card-header text-center">
				<h4>Change Password</h4>
			</div>
			<div class="card-body">
				<form name="frmChange" method="post" action="" onSubmit="return validatePassword()">
                   
				  <div class="form-group">
				    <label style="color:#000">Current Password</label><br>
				    <input type="password" name="currentPassword" class="txtField" style="width:100%"/><span id="currentPassword"  class="required"></span>
				  </div>
				  <div class="form-group">
				    <label style="color:#000">New Password</label><br>
				    <input type="password" name="newPassword" class="txtField" style="width:100%"/><span id="newPassword" class="required"></span>
				  </div>
				  <div class="form-group">
				    <label style="color:#000">Confirm Password</label><br>
				    <input type="password" name="confirmPassword" class="txtField" style="width:100%"/><span id="confirmPassword" class="required"></span>
				  </div>
				  <button type="submit" class="btn btn-primary">Submit</button>
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-3"></div>
</div>

</body>
</html>