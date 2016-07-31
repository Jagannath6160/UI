<?php
session_start();
?>
<?php
if(isset($_POST['Submit']))
{
$student_Email = $_POST["username"];
$student_Password = $_POST["password"];

$host ='localhost';
$password='';
$user='root';
$db='universitydb';

$con = mysqli_connect($host,$user,$password,$db);

$select_query = 'SELECT FirstName from aspiringstudent where email = "'.$student_Email.'" and Password = "'.$student_Password.'"';
                          
     if(!mysqli_query($con,$select_query))
        {
            echo ("Error in fetching data.");
         
        } else{
            echo ("Successfully fetched the data");
			echo ($select_query);
        }

$res = $con -> query($select_query);
$rows = $res -> num_rows;
if($rows > 0){
	while($act = $res->fetch_assoc()){
		$_SESSION["FirstName"]= $act["FirstName"]; // Initializing Session
        header("location: home.php"); // Redirecting To Other Page
	}
} else {
$error = "Username or Password is invalid";
}
} 	 
?>

<!DOCTYPE html>
<html>
    <head>
      <title>Bootstrap Example</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
      <style>
        /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
        .row.content {height: 550px}
        
        /* Set gray background color and 100% height */
        .sidenav {
          background-color: #f1f1f1;
          height: 100%;
        }
            
        /* On small screens, set height to 'auto' for the grid */
        @media screen and (max-width: 767px) {
          .row.content {height: auto;}
        }
      </style>
    </head>
    <body>
        <nav class="navbar navbar-inverse visible-xs">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Logo</a>
        </div>
      </div>
    </nav>
	<form action=""  method="post">
	<div class="container-fluid">
      <div class="row content">
        <div class="col-sm-3 sidenav hidden-xs">
          <fieldset>
        <legend><span class="number"></span> Login Info</legend>
        <input type="text" name="username" placeholder="User Name *"/>
        <input type="password" name="password" placeholder="Password *"/>
        
        <input type="submit" name = "Submit" value="Login" />
        <p> New? &nbsp; &nbsp;<a href='register.php'> Signup </a>&nbsp;
        <p><input type='checkbox' name="rem_password" value="Remember me">Remember me </p>
        </fieldset> 
        </div>
        </div>
        </div> 
</form>		
 </body>

</html>