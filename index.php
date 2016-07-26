<!DOCTYPE html>
    <html lang="en">
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
    <?php
    
    $servername = 'localhost';
    $username ='root';
    $password = ''; 
    $db='StudentDatabase';
    
    $conn = new mysqli($servername, $username, $password,$db);
    
    if($conn-> connect_error)
    die("connection failed: ". $conn->connect_error);
      
      echo "Connected Successfully";    
        ?>
        
        
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
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Dashboard</a></li>
            <li><a href="#">Age</a></li>
            <li><a href="#">Gender</a></li>
            <li><a href="#">Geo</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row content">
        <div class="col-sm-3 sidenav hidden-xs">
          <h2>Welcome, Staff</h2>
          <ul class="nav nav-pills nav-stacked">
            <li class="active"><a href="#section1">My Basic Information</a></li>
            <li><a href="#section2">Search Students</a></li>
            <li><a href="#section3">Logout</a></li>
          </ul><br>
        </div>
        <br>
        
        <div class="col-sm-9">
          <div class="well">
            <h4>Information</h4>
            <p>ID: <?php echo "   800937153" ?></p>
            <p>Name:<?php echo "   Dinesh Panchananam" ?></p>
            <p>Email: <?php echo "dpanchan@uncc.edu" ?></p>
          </div>
        </div>

        <div class="col-sm-9">
            <h4>Search Students Criteria</h4>
                <form class="navbar-form navbar-left" role="search" method="post">
                <label for="degree">Degree</label>
                  <select class="form-control" id="degree" name ="degree">
                    <option>Bachelors</option>
                    <option>Masters</option>
                    <option>PhD</option>
                  </select>          <br>  
                  <label for="major">Major</label>
                  <select class="form-control" id="major" name="major">
                    <option>Computer Science</option>
                    <option>Biology</option>
                    <option>Finance</option>
                  </select>            <br>
                
                <label for="eca">Extra Curricular Interests</label>
                  <select class="form-control" id="eca" name="eca">
                    <option>Football</option>
                    <option>Baseball</option>
                    <option>Piano</option>
                    <option>Judo</option>
                  </select><br>
                <label for="region">Region</label> <input type="text" class="form-control" placeholder="Search"/><br>
                  <label for="gpa">GPA</label>
                  <select class="form-control" id="gpa" name="gpa">
                    <option>3.4</option>
                    <option>3.6</option>
                    <option>3.8</option>
                    <option>4.0</option>
                  </select> <br>
      <button type="submit" class="btn btn-default" name="submit">Submit</button>

    </form>
        </div>

      </div>
    </div>
    <?php
       $testSearch = "SELECT * FROM Aspring Student WHERE gpa=3.4";
       $testResult = mysql_query($testSearch) or die(mysql_error());
       $finalResult= mysql_fetch_assoc($testResult);
       foreach($finalResult as $result){ echo '<p>'.$result.'<p>';}
       
             ?>
    <?php
     if(isset($_POST["submit"])){
          $degree=$_POST["degree"];
          echo '<p>'.$degree.'</p>';
          $major = $_POST["major"];
          echo '<p>'.$major.'</p>';
         $extraC = $_POST["eca"];
         echo '<p>'.$extraC.'</p>'; 
         $gpa = $_POST["gpa"];
         echo '<p>'.$gpa.'</p>';         
     } 
     else echo 'error';
     ?>
    </body>
    </html>