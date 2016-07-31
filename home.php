<?php
session_start();
?>
<!DOCTYPE html>
    <html lang="en">
    <head>
      <title>Student Home</title>
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
            <a class="active" href="student.php">Build your student profile</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="resources.php"> Access Resources</a>
          </div>
        </div>
      </div>
    </div>
    </body>
    </html>