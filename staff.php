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

        .mybox {
            width: 200px;
            float: left;
            margin-right: 20px;
            margin-top: 10px;
        }

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

        $(document).ready(function () {
            $("#degree").val("Bachelors");
            getMajors({value: "Bachelors"});
            $("#infoDiv").hide();
            $("#searchDiv").show();
            $("#searchTab").addClass("active");

            $("#infoTab").click(function () {
                $("#infoTab").addClass("active");
                $("#searchTab").removeClass("active");
                $("#infoDiv").show();
                $("#searchDiv").hide();

            });

            $("#searchTab").click(function () {
                $("#searchTab").addClass("active");
                $("#infoTab").removeClass("active");
                $("#infoDiv").hide();
                $("#searchDiv").show();
            });

            $("#searchBtn").click(function(){
            	$("#results").show();
            });

            $("#range-slider-gpa").slider({
                range: true,
                min: 200,
                max: 400,
                values: [270, 400],
                slide: function (event, ui) {
                    $("#amount").val(ui.values[0] / 100.0 + " - " + parseFloat(ui.values[1] / 100.0));
                }
            });


            $("#amount").val($("#range-slider-gpa").slider("values", 0) / 100.0 + " - " + $("#range-slider-gpa").slider("values", 1) / 100.0);


            $("#range-slider-satGre").slider({
                range: true,
                min: 100,
                max: 1400,
                values: [100, 1200],
                slide: function (event, ui) {
                    $("#satGre").val(ui.values[0] + " - " + parseFloat(ui.values[1]));
                }
            });


            $("#satGre").val($("#range-slider-satGre").slider("values", 0) + " - " + $("#range-slider-satGre").slider("values", 1));


        });


        function getMajors(self) {
            $.post("get_majors.php", {"degree": self.value}, function () {
                // console.log("AJAX callback success.");
            }).done(function (data) {
                options = $("#major");
                options.empty();
                $.each(JSON.parse(data), function () {
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


<div class="container-fluid">
    <div class="row content">
        <div class="col-sm-3 sidenav hidden-xs">
            <h2>Welcome, <?php session_start();
                echo explode(" ", $_SESSION['staff_name'])[0] ?></h2>
            <ul class="nav nav-pills nav-stacked">
                <li id="infoTab"><a href="#section1">My Information</a></li>
                <li id="searchTab"><a href="#section2">Search Students</a></li>
                <li id="signoutTab"><a href="staff_signout.php">Logout</a></li>
            </ul>
            <br>
        </div>
        <br>

        <div class="col-sm-9" id="infoDiv">
            <div class="well">
                <h4>Information</h4>
                <p>ID: <?php echo $_SESSION['staff_id'] ?></p>
                <p>Name: <?php echo $_SESSION['staff_name'] ?></p>
                <p>Email: <?php echo $_SESSION['email'] ?></p>
            </div>
        </div>

        <div class="col-sm-9" id="searchDiv">
            <h4>Search Students Criteria</h4>
            <form class="navbar-form navbar-left" role="search" method="post">
                <div style="display=inline-block">
                <div class="mybox">
                    <label for="degree">Degree</label><br>
                    <select class="form-control" id="degree" name="degree" onChange="getMajors(this)">
                        <?php
                        foreach ($degrees as $degree) {
                            echo "<option>" . $degree . "</option><br>";
                        }
                        ?>
                    </select>
                </div>

                <div class="mybox">
                <label for="major">Major</label>
                    <select class="form-control" id="major" name="major">

                    </select>
                </div>

                <div class="mybox">
                    <label for="eca">Extra Curricular Interests</label>
                    <select class="form-control" id="eca" name="eca">
                        <?php
                        foreach ($extra_curriculars as $activity) {
                            echo "<option>$activity</option>";
                        }
                        ?>
                    </select>
                </div>
                    </div>



                <div style="display=inline-block">

                    <div class="mybox">
                        <label for="region">Region</label>
                        <select class="form-control" id="region" name="region">
                            <?php
                            foreach ($regions as $region) {
                                echo "<option>" . $region . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="mybox">
                        <label for="amount">GPA range:</label>
                        <input type="text" id="amount" name="gpa" readonly style="border:0; color:#f6931f; font-weight:bold;">
                        <div id="range-slider-gpa"></div>
                    </div>

                    <div class="mybox">
                        <label for="satGre">SAT/GRE range:</label>
                        <input type="text" id="satGre" name="satGre" readonly style="border:0; color:#f6931f; font-weight:bold;">
                        <div width="500px" id="range-slider-satGre"></div>

                    </div>
                </div>

        </div>

        <button id="searchBtn" type="submit" class="btn btn-default"name="submit" style="margin-left: 30px">Submit</button>
        </form>


    <div style="width: 700px">

        <div id="results" class="panel panel-default">
            <div class="panel-heading">Result</div>
            <table class="table">
                <thead> <tr><th>First Name</th> <th>Last Name</th> <th>Email</th> </tr> </thead>
                <tbody>

                <?php
                if(isset($_POST['submit'])) {
                $degree = $_POST['degree'];
                $major = $_POST['major'];
                $extra_curricular = $_POST['eca'];
                $region = $_POST['region'];
                list($gpa_low, $gpa_high) = explode(" - ", $_POST['gpa']);
                list($sat_gre_low, $sat_gre_high) = explode(" - ", $_POST['satGre']);

                $host = "localhost";
                $user = "root";
                $password = "";
                $database = "universitydb";
                $conn = new mysqli($host, $user, $password, $database);

                if ($conn->connect_error) {
                    die("connection failed: " . $conn->connect_error);
                } else {
                    // fetching  majors by degree from the database
                    $response = $conn->query('select firstname, lastname, email from aspiringstudent where (gpa between ' . $gpa_low .  ' and ' . $gpa_high .') and (testscore between '
                        . $sat_gre_low . ' and ' . $sat_gre_high . ')');
                    if ($response->num_rows > 0) {
                        while ($row = $response->fetch_assoc()) {

                            $ema = $row['email'];
                            $fname = $row['firstname'];
                            $lname = $row['lastname'];
							$get_tag = "<a href=\"student_profile.php?stud_email=$ema\">$ema</a>";
                            echo "<tr><td>$fname</td><td>$lname</td><td>$get_tag</td></tr>";

                        }
                    }

                }
                $conn->close();
				}
                ?>
                </tbody>
            </table> </div>
    </div>


</div>


</div>
</div>
</body>
</html>
