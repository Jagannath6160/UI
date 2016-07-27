<?php
if (isset($_POST['degree'])) {

    $degree = $_POST['degree'];
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "universitydb";
    $conn = new mysqli($host, $user, $password, $database);
    $majors = [];

    $tables = ["Bachelors" => "undergraduatedegree", "Masters" => "graduatedegree", "PhD" => "graduatedegree"];
    $columns = ["Bachelors" => "uspecialization", "Masters" => "gspecialization", "PhD" => "gspecialization"];
    list($table, $column) = [$tables[$degree], $columns[$degree]];

    if ($conn->connect_error) {
        die("connection failed: " . $conn->connect_error);
    } else {
        // fetching  majors by degree from the database
        $response = $conn->query("SELECT " . $column . " FROM " . $table);
        if ($response->num_rows > 0) {
            while ($row = $response->fetch_assoc()) {
                array_push($majors, $row[$column]);
            }
        }
    }
    $conn->close();
    echo json_encode($majors);
}
?>
