<?php

require_once 'functions.php';

if (!empty($_POST))
{
    var_dump($_POST);
    $age = (int)e($_POST['age'] ?? 0);
    $email = e($_POST['email'] ?? '');
    $errors = [];
    $gender = e($_POST['gender'] ?? '');
    $username = e($_POST['username'] ?? '');
    $password = e($_POST['password'] ?? '');
    $lastName = e($_POST['lastName'] ?? '');
    $firstName = e($_POST['firstName'] ?? '');
    $phoneNumber = e($_POST['phoneNumber'] ?? '');
    $passwordRepeated = e($_POST['passwordRepeated'] ?? '');

    if (empty($username))
        $errors[] = 'Username is required';
    if (findUserByUsername($username))
        $errors[] = 'Username already exists';
    if (empty($email))
        $errors[] = 'Email is required';
    if (findUserByEmail($email))
        $errors[] = 'Email already exists';
    if (empty($phoneNumber))
        $errors[] = 'Phone number is required';
    if (empty($password))
        $errors[] = 'Password is required';
    if ($password !== $passwordRepeated)
        $errors[] = 'Passwords do not match';

    if (empty($errors))
    {
        if (register($age, $email, $gender, $username, $password, $lastName, $firstName, $phoneNumber))
        {
            $success = 'Successfully registered. Click <a href="index.php">here</a> to login';
        }
        else
        {
            $errors[] = 'Server error. Try again later';
        }
    }
}

?>

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">

<title>Sign in</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

<!-- Custom styles for this template -->
<link href="signin.css" rel="stylesheet">
</head>

<body class="text-center">
	<form class="form-signin" method="post" action="">
		<?php
            if (isset($success))
                echo '<div class="alert alert-success">' . $success . '</div>';
			if (!empty($errors))
			    foreach ($errors as $error)
			        echo '<div class="alert alert-danger">' . $error . '</div>';
		?>
		<h1 class="h3 mb-3 font-weight-normal">Fill in the form to register</h1>
		<label for="email" class="sr-only">Email</label>
		<input type="email" id="email" class="mb-2 form-control" placeholder="Enter email" name="email" required autofocus>
        <label for="username" class="sr-only">Username</label>
        <input type="text" id="username" class="mb-2 form-control" placeholder="Enter username" name="username" required>
        <label for="firstName" class="sr-only">First name</label>
        <input type="text" id="firstName" class="mb-2 form-control" placeholder="Enter first name" name="firstName" required>
        <label for="lastName" class="sr-only">Last name</label>
        <input type="text" id="lastName" class="mb-2 form-control" placeholder="Enter last name" name="lastName" required>
        <label for="phoneNumber" class="sr-only">Phone number</label>
        <input type="text" id="phoneNumber" class="mb-2 form-control" placeholder="Enter phone number" name="phoneNumber" required>
		<label for="gender" class="sr-only">Gender</label>
        <select class="form-control mb-2" name="gender" id="gender" required>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>
        <label for="age" class="sr-only">Age</label>
        <input type="number" id="age" class="mb-2 form-control" name="age" placeholder="Enter age" required>
        <label for="password" class="sr-only">Password</label>
		<input type="password" id="password" class="form-control" placeholder="Enter password" name="password" required>
        <label for="passwordRepeated" class="sr-only">Password</label>
        <input type="password" id="passwordRepeated" class="form-control" placeholder="Repeat password" name="passwordRepeated" required>
		<button class="btn btn-success btn-block mb-3" type="submit">Register</button>
		<a href="index.php" class="btn btn-info btn-block">Go to home</a>
		<p class="mt-5 mb-3 text-muted">&copy; 2018</p>
	</form>
</body>
</html>
