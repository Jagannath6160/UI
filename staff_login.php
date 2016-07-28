<?php
if(isset($_POST['submit'])) {

}
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <title>Staff Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<h4>Welcome to the Staff login Page</h4>
<h5>Please login with your credentials</h5>
</head>
<body>
    <form action="" method="POST">
<label for="email"> Email</label>
<input name="email" type="email" required/>
<br>
<label for="password">Password</label>
<input name="password" type="password" required/><br>
<button name="submit" type="submit">login</button>
</form>


<p>Don't have an account? Register <a href="staff_register.php">here</a></p>
</body>
</html>