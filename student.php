<?php
session_start();
?>
<?php
if(isset($_POST['Submit'])){
$student_FName = $_POST["First_Name"];
$student_LName = $_POST["Last_Name"];
$student_DOB = $_POST["Birthday_day"].$_POST["Birthday_Month"].$_POST["Birthday_Year"];
$student_Email = $_POST["Email_Id"];
$student_Mobile = $_POST["Mobile_Number"];
if(isset($_POST["Gender"])){
    $student_Gender = $_POST["Gender"];
    
}

//$student_major = $_POST["major"];
if(isset($_POST["course"])){
    $student_degree = $_POST["course"];  
}
if(isset($_POST["major"])){
    
    $host = "localhost";
        $username = "root";
        $password =  "";
        $database = "universitydb";
        $endl = "\n";
        $query = "SELECT MajorID FROM Major";
        $connection =  new mysqli($host, $username, $password, $database);
        if($connection->connect_error) {
        die("Connection error: " . $connection->connect_error);    
        }
        $result = $connection->query($query);  
        if($result->num_rows > 0) {
        while($activity = $result->fetch_assoc()) {
            $majorID = $activity['MajorID'];
            $insert_query = 'insert into Seeking (Degree,StartDate,Email,MajorID) values ("' .$student_degree  . '","' . "" . '","'.$student_Email . '","'.$majorID.'")';
                
     
        }
        if(!mysqli_query($connection,$insert_query))
        {
            echo '<script type="text/javascript">alert("Error while inserting data in database");</script>';
            echo("Error description: " . mysqli_error($connection));
         
        } else{
            echo '<script type="text/javascript">alert("Inserted data successfully");</script>';
        }
            
        }
        $connection->close();
}
$student_Address = $_POST["Address"].$_POST["City"].$_POST["Pin_Code"].$_POST["State"].$_POST["Country"];
$student_Extra = [];
if(!empty($_POST['check_list'])){
// Loop to store and display values of individual checked checkbox.
foreach($_POST['check_list'] as $selected){
 $student_Extra[] = $selected;
}
$count = count($student_Extra);

for($x=0;$x < $count ; $x++){
    //echo $student_Extra[$x];
    if($student_Extra[$x] == "EC_OTHER"){
        $student_Extra[$x] = $_POST["Other_Hobby"];
    }
}
}



$host ='localhost';
$password='';
$user='root';
$db='UNIVERSITYDB';
$table = 'contacts';

$con = mysqli_connect($host,$user,$password,$db);

if($con){
    //echo "Connected Succesfully";
    
    
}


$insert_query = 'insert into '.$table.'(email,phone,preferredContact) values ("' . $student_Email . '","' . $student_Mobile . '","")';
                
     if(!mysqli_query($con,$insert_query))
        {
            echo '<script type="text/javascript">alert("Error while inserting data in database");</script>';
            echo("Error description: " . mysqli_error($con));
         
        } else{
            echo '<script type="text/javascript">alert("Inserted data successfully");</script>';
        }
}   

?>
<!DOCTYPE html>
<html>
<head>
<title>Student Registration Form</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <style type="text/css">
h5{font-family: Calibri;
font-size: 22pt;
font-style: normal;
font-weight: bold; 
color:SlateBlue;
text-align: center; 
text-decoration: underline }
table{
font-family: Calibri; 
color:white; 
font-size: 15pt; 
font-style: normal;
text-align:; background-color: #eff3f6; 
color: #000; border-collapse: collapse; 
border: 2px solid navy}
table.inner{border: 0px}

.btnLogin
{
    -moz-border-radius:2px;
    -webkit-border-radius:2px;
    border-radius:15px;
    background:#a1d8f0;
    background:-moz-linear-gradient(top, #badff3, #7acbed);
    background:-webkit-gradient(linear, center top, 
    center bottom, from(#badff3), to(#7acbed));
    -ms-filter: "progid:DXImageTransform.Microsoft.gradient
    (startColorStr='#badff3', EndColorStr='#7acbed')";
    border:1px solid #7db0cc !important;
    cursor: pointer;
    padding:11px 16px;
    font:bold 11px/14px Verdana, Tahomma, Geneva;
    text-shadow:rgba(0,0,0,0.2) 0 1px 0px; 
    color:#fff;
    -moz-box-shadow:inset rgba(255,255,255,0.6) 0 1px 1px, 
    rgba(0,0,0,0.1) 0 1px 1px;
    -webkit-box-shadow:inset rgba(255,255,255,0.6) 0 1px 1px, 
    rgba(0,0,0,0.1) 0 1px 1px;
    box-shadow:inset rgba(255,255,255,0.6) 0 1px 1px, 
    rgba(0,0,0,0.1) 0 1px 1px;
    margin-center:12px;
    float:center;
 padding:7px 21px;
}

.btnLogin:hover,
.btnLogin:focus,
.btnLogin:active{
 background:#a1d8f0;
 background:-moz-linear-gradient(top, #7acbed, #badff3);
 background:-webkit-gradient(linear, center top, center bottom, 
 from(#7acbed), to(#badff3));
-ms-filter: "progid:DXImageTransform.Microsoft.gradient
(startColorStr='#7acbed', EndColorStr='#badff3')";
}
.btnLogin:active
{
    text-shadow:rgba(0,0,0,0.3) 0 -1px 0px; 
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

    <div class="container-fluid">
      <div class="row content">
        <div class="col-sm-3 sidenav hidden-xs">
          <h2>Welcome, <?php echo $_SESSION["FirstName"];?></p></h2>
          <ul class="nav nav-pills nav-stacked">
            <li><a href="login.php">Logout</a></li>
          </ul><br>
        </div>
        <br>

		<div class="col-sm-9">
          <div class="well">

<h5>STUDENT REGISTRATION FORM</h5>
<form action="" method="POST">
  
<table align="center" cellpadding = "10">
 <!----- First Name ------------------->
<td>FIRST NAME</td>
<td><input type="text" name="First_Name" maxlength="30" value= "<?php echo $_SESSION["FirstName"];?>" readonly/>
(max 30 characters a-z and A-Z)
</td>
 </tr>
  
 <!-- Last Name -------------------->
 <tr>
 <td>LAST NAME</td>
 <td><input type="text" name="Last_Name" 
             maxlength="30" value= "<?php echo $_SESSION["LastName"];?>" readonly/>
 (max 30 characters a-z and A-Z)
 </td>
 </tr>
  
 <!----- Email Id -------------->
 <tr>
 <td>EMAIL ID</td>
 <td><input type="text" name="Email_Id" maxlength="100" value = "<?php echo $_SESSION["email"];?>" readonly/>
        </td>
 </tr>
  
 <!----- Mobile Number --------->
 <tr>
 <td>MOBILE NUMBER</td>
 <td>
 <input type="text" name="Mobile_Number" maxlength="10" />
 (10 digit number)
 </td>
 </tr>
  
 <!----- Address -------------->
 <tr>
 <td>ADDRESS <br /><br /><br /></td>
 <td><textarea name="Address" rows="4" cols="30">
        </textarea></td>
 </tr>
  
 <!----- City ----------------->
 <tr>
 <td>CITY</td>
 <td><input type="text" name="City" maxlength="30" />
 (max 30 characters a-z and A-Z)
 </td>
 </tr>
  
 <!----- Pin Code ------------->
 <tr>
 <td>PIN CODE</td>
 <td><input type="text" name="Pin_Code" maxlength="6" />
 (6 digit number)
 </td>
 </tr>
  
 <!----- State --------------->
 <tr>
 <td>STATE</td>
 <td><input type="text" name="State" maxlength="30" />
 (max 30 characters a-z and A-Z)
 </td>
 </tr>
  
 <!----- Country ------------->
 <tr>
 <td>COUNTRY</td>
 <td><input type="text" name="Country" value="US" 
             readonly="readonly" /></td>
 </tr>
  
 <!----- Hobbies ------------->
  
 <tr>
<td>EXTRA CURRICULAR <br /><br /><br /></td>
<td>
    <select name="extra" id="extra" multivalued = "true">
    <?php
        $host = "localhost";
        $username = "root";
        $password =  "";
        $database = "universitydb";
        $endl = "\n";
        $query = "SELECT extracurricularname FROM extracurricularactivities";
        $connection =  new mysqli($host, $username, $password, $database);
        if($connection->connect_error) {
        die("Connection error: " . $connection->connect_error);    
        }
        $result = $connection->query($query);  
        if($result->num_rows > 0) {
			echo "<option>" . "none" . "</option>";
        while($activity = $result->fetch_assoc()) { 
            echo "<option>" . $activity['extracurricularname'] . "</option>";      
        }
        }
        $connection->close();
    ?>
    </select>
</tr>
  
 
  
 <!----- Course ------------->
 <tr>
 <td>DEGREE<br />SEEKING</td>
 <td>
 BS<input type="radio" id ="course" name="course" value="BS" />
 MS<input type="radio" id ="course" name="course" value="MS"/>
 PHD<input type="radio" id ="course" name="course" value="PHD"/>

 
 </td>
 </tr>
 
 
 <!----- MAJOR INTERESTED IN ------------->
 <tr>
    
 <td>MAJOR INTERESTED IN</td>
 <td><select id="major" name="major">
    
 </select></td>
 </tr>
   <!--<input type="text" name="major" maxlength="30"/></td> >
 
 
 </tr>
  
 <!----- Submit and Reset ------>
 <tr>
 <td colspan="2" align="center">
<input type="submit" name="Submit" class="btnLogin" value="Submit" 
 tabindex="4">
<input type="submit" name="Reset"class="btnLogin" value="Reset" 
 tabindex="4">
 </td>
 </tr>
 </table>
  </div>
  </div>
 </form>
  
 </body>
<script type="text/javascript"></script>
<script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
<script type="text/javascript">
$("input[name=course]:radio").change(function(){
    var deg = $('input[name=course]:checked').val();
    $.post('degmajor.php',{deg:deg}, function(data){
    $("#major").append(data);
   });
});
</script>
 </html>