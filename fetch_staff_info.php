<?php
if(isset($_POST['email'])) {
    $host = "localhost";
    $user = "root";
    $pass = "";
    $database = "universitydb";
    $conn = new mysqli($host, $user, $pass, $database);
    if($conn->connect_error) {
        die("Connection error: ". $conn->connect_error);
    } else {
        $response = $conn->query("SELECT StaffEmail FROM Staff WHERE StaffEmail='" . $_POST['email'] . "'");//;$_POST['email']);
        if($response)
            echo json_encode(["exists" => true]);
        else echo json_encode(["exists" => false]);
    }
    $conn->close();
}
?>
