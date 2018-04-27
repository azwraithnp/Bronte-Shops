<?php

$db = 'user';
$host = 'localhost';
$user = 'root';
$pass = '';

$errors = array();

$conn = mysqli_connect($host, $user, $pass, $db);
		

//if the submit button is clicked
if (isset($_POST['submit'])) 
{
	$fname=mysqli_real_escape_string($conn, $_POST['fname']);
	$lname=mysqli_real_escape_string($conn, $_POST['lname']);
	$email=mysqli_real_escape_string($conn, $_POST['email']);
	$pass=mysqli_real_escape_string($conn, $_POST['pass']);
	$age=mysqli_real_escape_string($conn, $_POST['age']);
	$passcon=mysqli_real_escape_string($conn, $_POST['passcon']);
	//ensure that form filled are filled properly
	
	if (empty($fname)) {
		array_push($errors, "First name required!");
	}
	if(empty($lname)){
		array_push($errors, "Last name required!");	
	}
	if (empty($email)) {
		array_push($errors, "Email required!");
	}
	if(empty($age))
	{
		array_push($errors, "Age required!");
	}
	if (empty($pass)) {
		array_push($errors, "Password required!");
	}
	if ($pass != $passcon) {
		array_push($errors, "The two passwords do not match!");
	}
	//if there are no errors save it to database
	if (count($errors) == 0){
		$pass = md5($pass); //encrypt password before storing in database
		$sql = "INSERT INTO user (fname, lname, age, email, password, isAdmin) VALUES ('$fname','$lname','$age','$email', '$pass', '0')";
		$result = mysqli_query($conn,$sql);
		

		header('location:admin/index.html');//redirect to homepage
} 
}


if (isset($_POST['submitadmin'])) 
{
	$fname=mysqli_real_escape_string($conn, $_POST['fname']);
	$lname=mysqli_real_escape_string($conn, $_POST['lname']);
	$email=mysqli_real_escape_string($conn, $_POST['email']);
	$pass=mysqli_real_escape_string($conn, $_POST['pass']);
	$age=mysqli_real_escape_string($conn, $_POST['age']);
	$admin=mysqli_real_escape_string($conn, $_POST['admin']);
	$passcon=mysqli_real_escape_string($conn, $_POST['passcon']);
	if (empty($fname)) {
		array_push($errors, "First name required!");
	}
	if(empty($lname)){
		array_push($errors, "Last name required!");	
	}
	if (empty($email)) {
		array_push($errors, "Email required!");
	}
	if(empty($age))
	{
		array_push($errors, "Age required!");
	}
	if (empty($pass)) {
		array_push($errors, "Password required!");
	}
	if ($pass != $passcon) {
		array_push($errors, "The two passwords do not match!");
	}
	//if there are no errors save it to database
	if (count($errors) == 0){
		$pass = md5($pass); //encrypt password before storing in database
		$sql = "INSERT INTO user (fname, lname, age, email, password, isAdmin) VALUES ('$fname','$lname','$age', '$email', '$pass', '$admin')";
		$result = mysqli_query($conn,$sql);
		

	header('location:data.php');//redirect to homepage
} 
}



//login form page
if (isset($_POST['login'])) {
	$email=mysql_real_escape_string($_POST['email']);
	$pass=mysql_real_escape_string($_POST['password']);

//ensure that form filled are filled properly

if (empty($email)) {
	array_push($errors, "Email required!");
}
if (empty($pass)) {
	array_push($errors, "Password required!");
}
if (count($errors) == 0) {
	$pass = md5($pass);//encrypt password before storing in database
	$query = "SELECT * FROM user WHERE email = '$email' AND pass = '$pass'";
	$result = mysqli_query($conn, $query);
	if(mysqli_num_rows($result) == 1){
		//log user in
		$_SESSION['username'] = $username;
		$_SESSION['success'] =  "";
		header('location:admin/pages/dashboard/data.php');//redirect to Dashboard
	}
	else{
		array_push($errors, "Wrong username/password combination!");
		}
}
}

// logout
if (isset($_GET['logout'])) {
	session_destroy();
	$_SESSION['status'] = 0;
	unset($_SESSION['id']);
	header('location: ../index.php');
}


?>


