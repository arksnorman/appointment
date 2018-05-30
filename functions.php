<?php

session_start();
$db = mysqli_connect('127.0.0.1', 'root', 'root', 'mulago');

function register(
    $age,
    $email,
    $gender,
    $username,
    $password,
    $lastName,
    $firstName,
    $phoneNumber,
    $role = 'client'
)
{
    global $db;
    $password = md5($password);
    $sql = "
        INSERT INTO users(username, email, password, phone, role, first_name, last_name, age, gender)
        VALUES(
        '$username', 
        '$email', 
        '$password', 
        '$phoneNumber', 
        '$role', 
        '$firstName', 
        '$lastName', 
        '$age', 
        '$gender'
        )";
    return mysqli_query($db, $sql);
}

function getUserById($id) :array
{
	global $db;
	$query = "SELECT * FROM users WHERE id=" . $id;
	$result = mysqli_query($db, $query);
	return mysqli_fetch_assoc($result);
}

function e($val)
{
	global $db;
	return mysqli_real_escape_string($db, trim($val));
}

function isLoggedIn() :bool
{
	return isset($_SESSION['username']) && !empty($_SESSION['username']);
}

function logout() :void
{
    unset($_SESSION);
    session_destroy();
}

function isAdmin() { return ($_SESSION['role'] ?? '') === 'staff'; }

function createAppointment(string $illness = '', string $description = '') :bool
{
    global $db;
    $active = 1;
    $userId = $_SESSION['userId'];
	$dateCreated = date('Y-m-d h:i:sa');
	$sql = "INSERT INTO 
        appointments(illness, description, active, date_created, user_id) 
        VALUES('$illness', '$description', '$active', '$dateCreated', '$userId')";
	return mysqli_query($db, $sql);
}

function findUserByEmail($email) :bool
{
    global $db;
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($db, $query);
    return count(mysqli_fetch_assoc($result)) > 0;
}

function findUserByUsername($email) :bool
{
    global $db;
    $query = "SELECT * FROM users WHERE username = '$email'";
    $result = mysqli_query($db, $query);
    return count(mysqli_fetch_assoc($result)) > 0;
}

function getUserAppointments(int $id)
{
    $results = [];
    global $db;
    $sql = "SELECT * FROM appointments WHERE user_id = '$id'";
    $result = mysqli_query($db, $sql);
    if (mysqli_num_rows($result) > 0)
    {
        while($row = mysqli_fetch_assoc($result))
        {
            $results[] = $row;
        }
        return $results;
    }
    return [];
}