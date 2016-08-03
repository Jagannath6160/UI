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
            width: 280px;
            float: left;
            margin-bottom: 20px;
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

        html {
            height: 100%;
        }

        body {
            min-height: 100%;
        }
    </style>

    <script type="text/javascript">

        $(document).ready(function () {
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

            $("#searchBtn").click(function () {
                $("#results").show();
            });

            $("#range-slider-gpa").slider({
                range: true,
                min: 200,
                max: 400,
                values: [200, 400],
                slide: function (event, ui) {
                    $("#amount").val(ui.values[0] / 100.0 + " - " + parseFloat(ui.values[1] / 100.0));
                }
            });


            $("#amount").val($("#range-slider-gpa").slider("values", 0) / 100.0 + " - " + $("#range-slider-gpa").slider("values", 1) / 100.0);


            $("#range-slider-satGre").slider({
                range: true,
                min: 100,
                max: 1400,
                values: [100, 1400],
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
                //		options.append($("<option />").text("All"));
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

$states = [];
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
            array_push($states, $row['state']);
            $regions[$row['region']] = 1;
        }
    }


}

?>


<body>


<div class="container-fluid">
    <div class="row content">
        <div class="col-sm-3 sidenav hidden-xs" style="width:200px">
            <h4>Welcome, <?php session_start();
                echo explode(" ", $_SESSION['staff_name'])[0] ?></h4>
            <ul class="nav nav-pills nav-stacked">
                <li id="infoTab"><a href="#section1">My Information</a></li>
                <li id="searchTab"><a href="#section2">Search Students</a></li>
                <li><a href="staff_resources.php">Resource Analytics</a></li>
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
                <div style="display:inline-block">
                    <div class="mybox" style="width:200px">
                        <label for="degree">Degree</label><br>
                        <select multiple class="form-control" id="degree" name="degrees[]" onChange="getMajors(this);">
                            <?php
                            foreach ($degrees as $degree) {
                                echo "<option>" . $degree . "</option><br>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="mybox">
                        <label for="major">Major</label><br>
                        <select multiple class="form-control" id="major" name="majors[]">
                        </select>
                    </div>

                    <div class="mybox">
                        <label for="eca">Extra Curricular Interests</label><br>
                        <select multiple class="form-control" id="eca" name="eca[]">
                            <?php
                            foreach ($extra_curriculars as $activity) {
                                echo "<option>$activity</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>


                <div style="display:inline-block">

                    <div class="mybox" style="width:200px">
                        <label for="state">State</label><br>
                        <select multiple class="form-control" id="state" name="states[]">

                            <?php
                            foreach ($states as $state) {
                                echo "<option>" . $state . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mybox" style="width:200px">
                        <label for="state">Region</label><br>
                        <select multiple class="form-control" id="region" name="regions[]">

                            <?php
                            foreach ($regions as $region => $_) {
                                echo "<option>" . $region . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="mybox" style="width:100px">
                        <label for="amount">GPA range:</label><br>
                        <input type="text" id="amount" name="gpa" readonly
                               style="border:0; color:#f6931f; font-weight:bold;">
                        <div id="range-slider-gpa"></div>
                    </div>

                    <div class="mybox" style="width:150px;margin-left:20px">
                        <label for="satGre">SAT/GRE range:</label><br>
                        <input type="text" id="satGre" name="satGre" readonly
                               style="border:0; color:#f6931f; font-weight:bold;">
                        <div width="500px" id="range-slider-satGre"></div>

                    </div>
                </div>
                <div style="display:inline-block">
                    <div class="mybox">

                        <button id="searchBtn" type="submit" class="btn btn-default" name="submit">Submit</
                        </button></div>
                </div>
            </form>


            <div style="width:700px" id="results">
                <?php
                if (isset($_POST['submit'])) {
                    $degrees_0 = isset($_POST['degrees']) ? $_POST['degrees'] : false;
                    $majors = isset($_POST['majors']) ? $_POST['majors'] : false;
                    $extra_curriculars = isset($_POST['eca']) ? $_POST['eca'] : false;
                    $states_0 = isset($_POST['states']) ? $_POST['states'] : false;
                    $regions = isset($_POST['regions']) ? $_POST['regions'] : false;
                    list($gpa_low, $gpa_high) = explode(" - ", $_POST['gpa']);
                    list($sat_gre_low, $sat_gre_high) = explode(" - ", $_POST['satGre']);

                    $degrees = $degrees_0 ? array_map(function ($item) {
                        if ($item == "Bachelors")
                            return "BS";
                        if ($item == "Masters")
                            return "MS";
                        else return "PhD";

                    }, $degrees_0) : false;


                    $degrees_constraint = $degrees ? "(degree IN ('" . implode("', '", $degrees) . "'))" : false;
                    $majors_constraint = $majors ? "(major IN ('" . implode("', '", $majors) . "'))" : false;
                    if (count($degrees) > 1) {
                        $majors_constraint = false;
                    } else if (count($degrees) == 1) {
                        if ($degrees[0] == 'BS') {
                            $majors_table = "undergraduatedegree";
                            $majors_constraint = $majors ? "(uspecialization IN ('" . implode("', '", $majors) . "'))" : false;
                        } else {
                            $majors_table = "graduatedegree";
                            $majors_constraint = $majors ? "(gspecialization IN ('" . implode("', '", $majors) . "'))" : false;

                        }
                    }



                    $states = [];
                    if ($states_0) {
                        $state_conv = ['Alabama' => 'AL','Alaska' => 'AK','Arizona' => 'AZ','Arkansas' => 'AR','California' => 'CA','Colorado' => 'CO','Connecticut' => 'CT','Delaware' => 'DE','Florida' => 'FL','Georgia' => 'GA','Hawaii' => 'HI','Idaho' => 'ID','Illinois' => 'IL','Indiana' => 'IN','International' => 'XX','Iowa' => 'IA','Kansas' => 'KS','Kentucky' => 'KY','Louisiana' => 'LA','Maine' => 'ME','Maryland' => 'MD','Massachusetts' => 'MA','Michigan' => 'MI','Minnesota' => 'MN','Mississippi' => 'MS','Missouri' => 'MO','Montana' => 'MT','Nebraska' => 'NE','Nevada' => 'NV','New Hampshire' => 'NH','New Jersey' => 'NJ','New Mexico' => 'NM','New York' => 'NY','North Carolina' => 'NC','North Dakota' => 'ND','Ohio' => 'OH','Oklahoma' => 'OK','Oregon' => 'OR','Pennsylvania' => 'PA','Rhode Island' => 'RI','South Carolina' => 'SC','South Dakota' => 'SD','Tennessee' => 'TN','Texas' => 'TX','Utah' => 'UT','Vermont' => 'VT','Virginia' => 'VA','Washington' => 'WA','Washington DC' => 'DC','West Virginia' => 'WV','Wisconsin' => 'WI','Wyoming' => 'WY'];
                        foreach($states_0 as $state_) {
                            array_push($states, $state_conv[$state_]);
                        }
                    }
                    $states_constraint = $states ? "(state IN ('" . implode("', '", $states) . "'))" : false;
                    $regions_constraint = $regions ? "(region IN ('" . implode("', '", $regions) . "'))" : false;
                    $extra_curriculars_constraint = $extra_curriculars ? "(extracurricularname IN ('" . implode("', '", $extra_curriculars) . "'))" : false;
                    $gpa_constraint = "(gpa BETWEEN $gpa_low AND $gpa_high)";
                    $testscore_constraint = "(testscore BETWEEN $sat_gre_low AND $sat_gre_high)";


                    $where_clause = implode(" AND ", array_filter([$degrees_constraint, $majors_constraint, $states_constraint, $regions_constraint,
                        $extra_curriculars_constraint, $gpa_constraint, $testscore_constraint],
                        function ($constraint) {
                            return $constraint !== false;
                        }));


                    $statement = "SELECT DISTINCT email FROM aspiringstudent NATURAL JOIN seeking NATURAL JOIN $majors_table NATURAL JOIN address NATURAL JOIN enjoys NATURAL JOIN extracurricularactivities WHERE $where_clause";
                    //    echo $statement;

                    $host = "localhost";
                    $user = "root";
                    $password = "";
                    $database = "universitydb";
                    $conn = new mysqli($host, $user, $password, $database);

                    if ($conn->connect_error) {
                        die("connection failed: " . $conn->connect_error);
                    } else {
                        // fetching  majors by degree from the database
                        $response_0 = $conn->query($statement);
                        $output = [];
                        if ($response_0->num_rows > 0) {
                            while ($row_0 = $response_0->fetch_assoc()) {
                                $stud_email = strtolower($row_0['email']);
                                //                echo $stud_email;
                                # from email get personal information
                                $info_query = 'SELECT firstname, lastname, gpa, testscore FROM aspiringstudent WHERE email="' . $stud_email . '"';
                                $response = $conn->query($info_query);
                                if ($response->num_rows > 0) {
                                    $info_row = $response->fetch_assoc();
                                }

                                //                echo print_r($info_row);

                                # from email get majors information
                                $majors_query = "SELECT degree, startdate, majorid FROM seeking WHERE email='" . $stud_email . "'";
                                $response = $conn->query($majors_query);
                                if ($response->num_rows > 0) {
                                    $major_row = $response->fetch_assoc();
                                }
                                # from majorid, degree fetch major name
                                $major_name_query = ($major_row['degree'] === "BS") ?
                                    "SELECT uspecialization AS majorname FROM undergraduatedegree WHERE majorid='" . $major_row['majorid'] . "'" :
                                    "SELECT gspecialization AS majorname FROM graduatedegree WHERE majorid='" . $major_row['majorid'] . "'";
                                //                echo "#".$major_name_query ."#";
                                $response = $conn->query($major_name_query);
                                if ($response->num_rows > 0) {
                                    $major_row['majorname'] = $response->fetch_assoc()['majorname'];
                                }

                                # from email get address
                                $address_query = "SELECT streetname, city, state, zipcode, apartment, region FROM address WHERE email='$stud_email'";
                                $response = $conn->query($address_query);
                                if ($response->num_rows > 0) {
                                    $info_row['address'] = $response->fetch_assoc();

                                }


                                # lets fetch extra curricular activities of the student
                                $extra_curriculars_query = "SELECT extracurricularname AS name FROM enjoys AS
                A, ExtraCurricularActivities AS B WHERE A.extracurricularid=B.extracurricularid and A.email='" . $stud_email . "'";
                                $response = $conn->query($extra_curriculars_query);
                                $info_row['extra_curricular_activities'] = [];
                                if ($response->num_rows > 0) {
                                    while ($row = $response->fetch_assoc()) {
                                        array_push($info_row['extra_curricular_activities'], $row['name']);
                                    }
                                }
                                $student = array_merge($info_row, $major_row);
                                $output[$stud_email] = $student;
                            }
                        }
                    }
                    $conn->close();
                          if (count($output) == 0) {
                    echo "<script type=\"text/javascript\">$(\"#infoDiv\").hide();$(\"#results\").hide();alert('No students found for this criteria')</script>";
                } else {
                    $counter = 0;
                    echo "<b>Results</b>";
                    foreach ($output as $student) {
                        $address = $student['address'];
                        echo '
                            <div class="panel-group" id="accordion">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse' . $counter . '">
                        ' . $student['firstname'] . " " . $student['lastname'] . '</a>
                                        </h4>
                                    </div>
                                    <div id="collapse' . $counter . '" class="panel-collapse collapse">
                                        <div class="panel-body">
                                        <b>Aspiring for ' . ucfirst($student['degree']) . ' in ' . ucfirst($student['majorname']) . '</b>
                                        <br><b>' . ($student['degree'] == "BS" ? "SAT" : "GRE") . ' score: </b>' . $student['testscore'] .
                            '<br><b>' . ($student['degree'] == "BS" ? "High School" : "Graduate") . ' GPA: </b>' . $student['gpa'] .
                            '<br><b>Extra Curricular Activities: </b>' . implode(", ", $student['extra_curricular_activities']) .
                            '<br><b>Address:</b><br>' . $address['streetname'] . ' Apt ' . $address['apartment'] .
                            '<br>' . $address['city'] . ', ' . $address['state'] . ' - ' . $address['zipcode'] .
                            '
                                        </div>
                                    </div>
                                </div>
                        </td>
                    </tr>';

                        $counter++;
                    }
                }

                }
          
                ?>


            </div>
        </div>

    </div>

</div>

</div>
</div>
</body>
</html>
