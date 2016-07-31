<?php 
if(isset($_POST['submit_stud'])) {
  $stud_email = $_POST['stud_email'];
  list($host, $user, $pass, $db) = explode(",", "localhost,root,,universitydb");
  $connection = new mysqli($host, $user, $pass, $db) or die("unable to connect");
	// echo $query;
  if($connection->connect_error) {
    echo "Connection error: " . $connection->connect_error;
  } else {
		# from email get personal information
		$info_query = 'SELECT firstname, lastname, gpa, testscore FROM aspiringstudent WHERE email="' . $stud_email . '"';
		$response = $connection->query($info_query);
  	if($response->num_rows > 0) {
			while($row = $response->fetch_assoc()) {
				$info_row = $row;
			}
		}
		# from email get majors information
		$majors_query = "SELECT degree, startdate, majorid FROM seeking WHERE email='" . $stud_email . "'";
		$response = $connection->query($majors_query);
		if($response->num_rows > 0 ) {
			while($row = $response->fetch_assoc()) {
				$major_row = $row;
			}
		}
		echo print_r(array_merge($major_row, $info_row));
		
		# from majorid fetch major name
		
	  $connection->close();		
  }
}
?>
