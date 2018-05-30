<?php

require_once 'functions.php';

if (!empty($_POST)) 
{
    $error = '';
    $username = $_POST['username'] ?? '';
    $password = md5($_POST['password'] ?? '');

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($db, $sql);
    $data = mysqli_fetch_assoc($result);

    if ($data !== null)
    {
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $data['role'];
        $_SESSION['userId'] = $data['id'];
        header('Location: dashboard.php');
    }
    else
    {
        $error = 'Incorrect username or password';
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
if (isset($error) && !empty($error))
{
    echo '<div class="alert alert-danger">' . $error . '</div>';
}
?>
<h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
<label for="phone" class="sr-only">Username</label>
<input type="text" id="phone" class="mb-2 form-control" placeholder="Enter username" name="username" required autofocus>
<label for="inputPassword" class="sr-only">Password</label>
<input type="password" id="inputPassword" class="form-control" placeholder="Enter password" name="password" required>
<button class="btn btn-success btn-block mb-3" type="submit">Login</button>
<a href="register.php" class="btn btn-info btn-block">Register</a>
<p class="mt-5 mb-3 text-muted">&copy; 2018</p>
</form>
</body>
</html>
