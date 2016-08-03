


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Welcome!</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
    <style>


    </style>
    <h1>Resource Analytics</h1>
</head>
<body><div style="width:900px">
<table class="table" border=1>
<thead><tr><th>Resource</th><th>Click Count</th><th>Specialization</th><th>Academic Calendar</th></tr></thead>
<tbody>
	
<?php

$host = "localhost";
$user = "root";
$password  = "";
$database = "universitydb";

$conn = new mysqli($host, $user, $password, $database);

$response = $conn->query("SELECT studentlifedoc, specialization s, academiccalendar as a, count(studentlifedoc) as cnt FROM clickson NATURAL JOIN resources group by studentlifedoc");
$rows = [];
if($response->num_rows > 0) {
	while($row = $response->fetch_assoc()) {
		array_push($rows, $row);
		echo "<tr><td>" . $row['studentlifedoc'] . "</td><td>" . $row['cnt'] ."</td><td>" .$row['s'] . "</td><td>" .$row['a'] . "</td></tr>";
	}
}
$conn->close();

?>

</tbody>
</table>

<button><a href="staff_home.php">Back to Home</a></button>

</div>
</body>
</html>