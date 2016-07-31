<?php 
if(isset($_GET['stud_email'])) {
  $stud_email = $_GET['stud_email'];
  list($host, $user, $pass, $db) = explode(",", "localhost,root,,universitydb");
  $connection = new mysqli($host, $user, $pass, $db) or die("unable to connect");
  if($connection->connect_error) {
    echo "Connection error: " . $connection->connect_error;
  } else {
		# from email get personal information
		$info_query = 'SELECT firstname, lastname, gpa, testscore FROM aspiringstudent WHERE email="' . $stud_email . '"';
		$response = $connection->query($info_query);
  	if($response->num_rows > 0) {
			$info_row = $response->fetch_assoc();
		}
		# from email get majors information
		$majors_query = "SELECT degree, startdate, majorid FROM seeking WHERE email='" . $stud_email . "'";
		$response = $connection->query($majors_query);
		if($response->num_rows > 0 ) {
			$major_row = $response->fetch_assoc();
		}
		# from majorid, degree fetch major name
		$major_name_query = ($major_row['degree'] === "BS") ?
		"SELECT uspecialization AS majorname FROM undergraduatedegree WHERE majorid=" . $major_row['majorid'] . "'":
		"SELECT gspecialization AS majorname FROM graduatedegree WHERE majorid='" . $major_row['majorid'] . "'";
		$response = $connection->query($major_name_query);
		if($response->num_rows > 0) {
			$major_row['majorname'] = $response->fetch_assoc()['majorname'];
		}
		
		# lets fetch extra curricular activities of the student
		$extra_curriculars_query = "SELECT extracurricularname AS name FROM enjoys AS
		A, ExtraCurricularActivities AS B WHERE A.extracurricularid=B.extracurricularid and A.email='" . $stud_email . "'";
		$response = $connection->query($extra_curriculars_query);
		$info_row['extra_curricular_activities'] = [];
		if($response->num_rows > 0) {
			while($row = $response->fetch_assoc()) {
				array_push($info_row['extra_curricular_activities'], $row['name']);
			}
		}
		$student = array_merge($info_row, $major_row);		
		$connection->close();
  }
}
?>

<html lang="en" xmlns="http://www.w3.org/1999/html">
    <head>
        <title>Profile</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		</head>
				<body>
					<?php
						$undergrad = $student['degree'] === 'BS';	
						echo "<h3> ". $student['firstname'] . " " . $student['lastname'] . "</h3>";
						echo "<h4> ". $_GET['stud_email'] . "</h4>";
						echo "<p>Intended Degree: " . $student['degree'] . "</p>";
						echo "<p>Intended Major: " . $student['majorname'] . "</p>";
						echo "<p>Intended Term start date: " . $student['startdate']. "</p>";
						echo "<p>" . ($undergrad ? 'High School ' : '') .  "GPA:" . $student['gpa'] . "</p>";
						echo "<p>" . ($undergrad ? "SAT" : "GRE") . " Score: " . $student['testscore'] . "</p>";
						echo "<p> Extra Curricular Activities: " . implode(", ", $student['extra_curricular_activities']) . "</p>";
					?>
				</body>
</html>