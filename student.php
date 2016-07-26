
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

$student_major = $_POST["major"];
if(isset($_POST["course"])){
    $student_degree = $_POST["course"];
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
$db='StudentDatabase';
$table = 'person';

$con = mysqli_connect($host,$user,$password,$db);

if($con){
    echo "Connected Succesfully";
    
    
}


$insert_query = 'insert into '.$table.'(email,fname,lname,gender,phonenumber,dob,streetaddress,city,state,pincode,
                role) values ("' . $student_Email . '","' . $student_FName . '","' . $student_LName . '","' . $student_Gender . '","' . $student_Mobile . '",
                "' . $student_DOB . '",
                "' . $student_Address . '",
                "",
                "",
                "",
                ""
                )';
                
                
                 
     if(!mysqli_query($con,$insert_query))
        {
            echo ("Error inserting data to the table\nquery:$insert_query");
         
        } else{
            echo ("Successfully inserted the data");
        }


}   



?>
<!DOCTYPE html>
<html>
<head>
<title>Student Registration Form</title>
<style type="text/css">
h3{font-family: Calibri;
font-size: 22pt;
font-style: normal;
font-weight: bold; 
color:SlateBlue;
text-align: center; 
text-decoration: underline }
table{
font-family: Calibri; 
color:white; 
font-size: 11pt; 
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
<h3>STUDENT REGISTRATION FORM</h3>
<form action="" method="POST">
  
<table align="center" cellpadding = "10">
 <!----- First Name ------------------->
<td>FIRST NAME</td>
<td><input type="text" name="First_Name" maxlength="30"/>
(max 30 characters a-z and A-Z)
</td>
 </tr>
  
 <!----- Last Name -------------------->
 <tr>
 <td>LAST NAME</td>
 <td><input type="text" name="Last_Name" 
             maxlength="30"/>
 (max 30 characters a-z and A-Z)
 </td>
 </tr>
  
 <!----- Date Of Birth ----------------->
 <tr>
 <td>DATE OF BIRTH</td>
  
 <td>
 <select name="Birthday_day" id="Birthday_Day">
 <option value="-1">Day:</option>
 <option value="1">1</option>
 <option value="2">2</option>
 <option value="3">3</option>
  
 <option value="4">4</option>
 <option value="5">5</option>
 <option value="6">6</option>
 <option value="7">7</option>
 <option value="8">8</option>
 <option value="9">9</option>
 <option value="10">10</option>
 <option value="11">11</option>
 <option value="12">12</option>
  
 <option value="13">13</option>
<option value="14">14</option>
 <option value="15">15</option>
 <option value="16">16</option>
 <option value="17">17</option>
<option value="18">18</option>
 <option value="19">19</option>
 <option value="20">20</option>
 <option value="21">21</option>
  
 <option value="22">22</option>
 <option value="23">23</option>
 <option value="24">24</option>
 <option value="25">25</option>
<option value="26">26</option>
 <option value="27">27</option>
 <option value="28">28</option>
 <option value="29">29</option>
 <option value="30">30</option>
  
 <option value="31">31</option>
 </select>
  
 <select id="Birthday_Month" name="Birthday_Month">
 <option value="-1">Month:</option>
 <option value="January">Jan</option>
 <option value="February">Feb</option>
 <option value="March">Mar</option>
 <option value="April">Apr</option>
 <option value="May">May</option>
 <option value="June">Jun</option>
 <option value="July">Jul</option>
 <option value="August">Aug</option>
 <option value="September">Sep</option>
 <option value="October">Oct</option>
 <option value="November">Nov</option>
 <option value="December">Dec</option>
 </select>
  
 <select name="Birthday_Year" id="Birthday_Year">
  
 <option value="-1">Year:</option>
 <option value="2012">2012</option>
 <option value="2011">2011</option>
 <option value="2010">2010</option>
 <option value="2009">2009</option>
 <option value="2008">2008</option>
 <option value="2007">2007</option>
 <option value="2006">2006</option>
 <option value="2005">2005</option>
 <option value="2004">2004</option>
 <option value="2003">2003</option>
 <option value="2002">2002</option>
 <option value="2001">2001</option>
 <option value="2000">2000</option>
  
 <option value="1999">1999</option>
 <option value="1998">1998</option>
 <option value="1997">1997</option>
 <option value="1996">1996</option>
 <option value="1995">1995</option>
 <option value="1994">1994</option>
 <option value="1993">1993</option>
 <option value="1992">1992</option>
 <option value="1991">1991</option>
 <option value="1990">1990</option>
  
 <option value="1989">1989</option>
 <option value="1988">1988</option>
 <option value="1987">1987</option>
 <option value="1986">1986</option>
 <option value="1985">1985</option>
 <option value="1984">1984</option>
 <option value="1983">1983</option>
 <option value="1982">1982</option>
 <option value="1981">1981</option>
 <option value="1980">1980</option>
 </select>
 </td>
 </tr>
  
 <!----- Email Id -------------->
 <tr>
 <td>EMAIL ID</td>
 <td><input type="text" name="Email_Id" maxlength="100" />
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
  
 <!----- Gender ---------------->
 <tr>
 <td>GENDER</td>
 <td>
 Male <input type="radio" name="Gender" value="Male" />
 Female <input type="radio" name="Gender" value="Female" />
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
 BasketBall
 <input type="checkbox" name="check_list[]" value="EC_BASKETBALL" />
 Football
 <input type="checkbox" name="check_list[]" value="EC_FOOTBALL" />
 Soccer
 <input type="checkbox" name="check_list[]" value="EC_SOCCER" />
 Music
 <input type="checkbox" name="check_list[]" value="EC_MUSIC" />
 <br />
 Others
 <input type="checkbox" name="EC_OTHER" value="EC_OTHER">
 <input type="text" name="Other_Hobby" maxlength="30" />
 </td>
 </tr>
  
 
  
 <!----- Course ------------->
 <tr>
 <td>DEGREE<br />SEEKING</td>
 <td>
 BS<input type="radio" name="course" value="BS"/>
 MS<input type="radio" name="course" value="MS"/>
 PHD<input type="radio" name="course" value="PHD"/>
 
 </td>
 </tr>
 
 <!----- MAJOR INTERESTED IN ------------->
 <tr>
 <td>MAJOR INTERESTED IN</td>
 <td><input type="text" name="major" maxlength="30"/></td>
 
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
  
 </form>
  
 </body>
 </html>