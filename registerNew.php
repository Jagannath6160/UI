<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
    <title>Register your Profile!!</title>
    <link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css" />
         
</head>

<?php 
$servername = "localhost";
$username = "root";
$password = "";
$db ="UNIVERSITYDB";

$conn = new mysqli($servername,$username,$password,$db);

if($conn->connect_error){
die("Connection failed: " . $conn->connect.error);
}else echo "Connected Successfully";
?>

<body>
<form method="post">
    <label>Your First Name</label><br>
    <input type="text" name="firstName" placeholder="firstName"/> <br>
    <label>Your Last Name</label><br>
    <input type="text" name="lastName" placeholder="lastName"/><br>
    <label>Your Email Name</label><br>
    <input type="text" name="email" placeholder="email"/><br>
    <label>Pick a Password</label><br>
    <input type="password" name="passWord" placeholder="password"/>
    
    <br><input type="submit" name="Submit" value="Submit"/> <br>
</form>

<?php
if(isset($_POST["Submit"])){

$firstName = $_POST["firstName"];
$lastName = $_POST["lastName"];
$email = $_POST["email"];
$passWord = $_POST["passWord"];

$sql = "INSERT INTO AspiringStudent(email,LastName,FirstName,Password,GPA,TestScore)
        VALUES('{$conn->real_escape_string($email)}','{$conn->real_escape_string($lastName)}','{$conn->real_escape_string($firstName)}','{$conn->real_escape_string($passWord)}',NULL,NULL)";
    $insert = $conn->query($sql);
        if($insert){
        echo "Success!";
        }else {
        die("Error : {$conn->errno} :{$conn->error}");
        }
}
?>

</body> 