<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <title>Build Profile Page</title>
    </head>
    <body>
        <span class="number">Basic Info</span><br> 
        Full Name:<input type="text" name="firstName" placeholder="First Name *" readonly/>
        <input type="text" name="lastName" placeholder="Last Name *" readonly/><br>
        Primary email ID:<input type="text" name="emailID" placeholder="Email *" readonly/><br>
        <span class="number">Select your gender:</span>
        <select name="gender">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>
        <br><br>
        <span class="number">Current Address</span><br>
        <input type="text" name="streetNo" placeholder="Street Name *"/>
        <input type="text" name="houseNo" placeholder="House Number *"/><br>
        <input type="text" name="city" placeholder="City *"/><br>
        <input type="text" name="state" placeholder="State *"/>
        <input type="text" name="zipCode" placeholder="Zip Code *"/><br>
        <input type="text" name="country" placeholder="Country *"/>
        <br><br>
        <span class="number">Contact Details</span><br>
        <input type="text" name="phoneNo" placeholder="Mobile Number *"/><br>
        <input type="text" name="emergencyEmail" placeholder=" Please provide parent email id. *"/><br>
        <br><br>
        <span class="number">Academic Interests</span><br>
        GPA:<input type="text" name="gpa" placeholder="Enter your GPA in scale of 4 *"/><br><br>
        <span class="number">Select the major interested in:</span>
        <select name="major">
            <option value="CS">Computer Science</option> <!-- fetch from DB -->
        </select><br><br>
        <span class="number">Term Applying for:</span>
        <select name="term">
            <option value="Spring_2017">Spring-2017</option>
            <option value="Fall_2017">Fall-2017</option>
            <option value="Spring_2018">Spring-2018</option>
        </select><br><br>
        <span class="number">What Degree are you seeking in:</span>
        <select name="degree">
            <option value="BS">BS</option>
            <option value="MS">MS</option>
            <option value="PhD">PhD</option>
            <option value="MBA">MBA</option>
        </select><br><br>
        <span class="number">Extra Curricular Activities</span><br>
        <span class="number">Extra curricular activities interested in:</span>
        <select name="extraCurricular">
            <option value="BS">BS</option> <!-- fetch from DB -->
        </select><br><br>
        <span class="number">Academic Letter:</span>
        <select name="acadLetter">
            <option value="Yes">Yes</option> 
            <option value="No">No</option>
        </select><br><br>
        Relevant Work-Experience:<input type="text" name="year" placeholder="Enter in years *"/><br><br>
    </body>
</html>
