<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>


    <style>
        /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
        .row.content {
            height: 550px
        }

        /* Set gray background color and 100% height */
        .sidenav {
            background-color: #f1f1f1;
            height: 100%;
        }

        /* On small screens, set height to 'auto' for the grid */
        @media screen and (max-width: 767px) {
            .row.content {
                height: auto;
            }
        }
    </style>

    <script type="text/javascript">

        $(document).ready(function() {
            $("degree").val("Bachelors")
            getMajors({value: "Bachelors"});


            function decimalToGPA(x) {

            }

            $("#range-slider-gpa").slider({
                range: true,
                min: 200,
                max: 400,
                values: [ 270, 400 ],
                slide: function( event, ui ) {
                    $( "#amount" ).val( ui.values[ 0 ]/100.0 + " - " + parseFloat(ui.values[ 1 ]/100.0) );
                }
            });


            $( "#amount" ).val( $( "#range-slider-gpa" ).slider( "values", 0 )/100.0 + " - " + $( "#range-slider-gpa" ).slider( "values", 1 )/100.0 );

        });


        function getMajors(self) {
            $.post("get_majors.php", {"degree" : self.value}, function(){
                // console.log("AJAX callback success.");
            }).done(function(data) {
                options = $("#major");
                options.empty();
                $.each(JSON.parse(data), function() {
                    options.append($("<option />").text(this.toString()));
                });
            });
        }
    </script>

</head>
<?php

$host = 'localhost';
$username = 'root';
$password = '';
$db = 'universitydb';

$conn = new mysqli($host, $username, $password, $db);
$degrees = ["Bachelors", "Masters", "PhD"];

$extra_curriculars = [];
$extra_curriculars_query = "SELECT extracurricularname FROM extracurricularactivities";


$regions = [];
$region_query = "SELECT state, region FROM stateregion ORDER BY state ASC ";


if ($conn->connect_error) {
    die("connection failed: " . $conn->connect_error);
} else {
    // fetching extra curricular activities from the database
    $response = $conn->query($extra_curriculars_query);
    if ($response->num_rows > 0) {
        while ($row = $response->fetch_assoc()) {
            array_push($extra_curriculars, $row['extracurricularname']);
        }
    }

    $response = $conn->query($region_query);
    if ($response->num_rows > 0) {
        while ($row = $response->fetch_assoc()) {
            array_push($regions, $row['state'] . " - " . $row['region']);
        }
    }


}

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
            </ul>
            <br>
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
                <select class="form-control" id="degree" name="degree" onChange="getMajors(this)">
                    <?php
                    foreach ($degrees as $degree) {
                        echo "<option>" . $degree . "</option><br>";
                    }
                    ?>
                </select> <br>
                <label for="major">Major</label>
                <select class="form-control" id="major" name="major">

                </select> <br>
                <label for="eca">Extra Curricular Interests</label>
                <select class="form-control" id="eca" name="eca">
                    <?php
                    foreach ($extra_curriculars as $activity) {
                        echo "<option>$activity</option>";
                    }
                    ?>
                </select><br>
                <label for="region">Region</label>
                <select class="form-control" id="region">
                    <?php
                        foreach ($regions as $region) {
                            echo "<option>" . $region . "</option>";
                        }
                    ?>
                </select><br>
                <p>
                    <label for="amount">GPA range:</label>
                    <input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
                </p>
                <div id="range-slider-gpa"></div>


<!--
                <select class="form-control" id="gpa" name="gpa">
                    <?php /*
                    $start = 2.0;
                    while ($start <= 4) {
                        echo "<option>$start</option><br>";
                        $start += 0.1;
                    }*/
                    ?>
                </select> <a href="#" >Range</a> <br> -->

                <button type="submit" class="btn btn-default" name="submit">Submit</button>

            </form>
        </div>

    </div>
</div>
<?php
$testSearch = "SELECT * FROM Aspring Student WHERE gpa=3.4";
$testResult = mysql_query($testSearch) or die(mysql_error());
$finalResult = mysql_fetch_assoc($testResult);
foreach ($finalResult as $result) {
    echo '<p>' . $result . '<p>';
}

?>
<?php
if (isset($_POST["submit"])) {
    $degree = $_POST["degree"];
    echo '<p>' . $degree . '</p>';
    $major = $_POST["major"];
    echo '<p>' . $major . '</p>';
    $extraC = $_POST["eca"];
    echo '<p>' . $extraC . '</p>';
    $gpa = $_POST["gpa"];
    echo '<p>' . $gpa . '</p>';
} else echo 'error';
?>
</body>
</html>