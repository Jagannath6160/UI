<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html" id="htmlStaff">
    <head>
        <title>Staff Login</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="style/main.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  
    
    </head>
    <body>
        <h4 class ="h">Welcome to the Staff login Page</h4>
        
        <div class="staff_form_div">
            <form method="POST" id="formContent_registerPage">
            <label for="email"> Email</label>
            <input name="email" type="email" required/>
            <br>
            <label for="password">Password</label>
            <input name="password" type="password" required/><br>
            <button name="submit" type="submit">login</button>
            </form>
       
        </div>
        
    </body>
</html>

<?php
if(isset($_POST['email'])) {
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "universitydb";
    $conn = new mysqli($host, $user, $password, $database);
    $email = $_POST['email'];
    $password = $_POST['password'];
    $query = 'SELECT StaffId AS id, StaffName AS name, StaffPassword AS password FROM Staff WHERE StaffEmail="' . $email . '"';
    if ($conn->connect_error) {
        die("connection failed: " . $conn->connect_error);
    } else {
        $response = $conn->query($query);
        if ($response->num_rows > 0) {
            while ($row = $response->fetch_assoc()) {
                $password_match = ($row['password'] == $password);
                if ($password_match) {
                    session_start();
                    $_SESSION['email'] = $email;
                    $_SESSION['staff_id'] = $row['id'];
                    $_SESSION['staff_name'] = $row['name'];
                    header("Location: staff_home.php");
                    die();
                } else {
                    echo '<script type="text/javascript">alert("The email and password you entered don\'t match.");</script>';
                }
            }
        }   else {
            echo '<script type="text/javascript">alert("An account does not exist with this email");</script>';
        }

    }

    $conn->close();
}
?>
