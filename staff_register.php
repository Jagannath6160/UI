<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <title>Staff Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $("#err_msg").hide();
        });
        function emailExistsAndPasswordsMatch() {
            var email = $("#email").val();
            var endResult = false;
            $.post("fetch_staff_info.php", {"email": email}, function () {
            }).done(function (data) {
                console.log(data);
                var password = $("#pass").val();
                var cpassword = $("#cpass").val();
                if(JSON.parse(data)['exists']) {
                    $("#err_msg").html("Email already exists");
                    $("#err_msg").show();
                } else if(password === cpassword) {
                    endResult = true;
                } else {
                    $("#err_msg").html("Password does not match the confirm password");
                    $("#err_msg").show();
                }
            });
            setInterval(1000);
            return endResult;
        }

    </script>

</head>



<h4>Welcome to the Staff register page</h4>
<body>
<form action="" method="POST" onsubmit="return emailExistsAndPasswordsMatch()">
<label for="fname">First Name</label>
<input type="text" name="fname" required/>
<br>
<label for="lname">Last Name</label>
<input type="text" name="lname" required/>
<br>
    <label for="email"> Email</label>
    <input id="email" name="email" type="email" required/>
    <br><label for="password">Password</label>
<input id="pass" type="password" name="password" required/>
<br>
<label for="cpassword">Confirm Password</label>
<input id="cpass" type="password" name="cpassword" required/>&nbsp<p style="color:red" id="err_msg"></p>
<br>
<input type="submit" value="Register">
</form>
<p>Have an account already? Sign in <a href="staff_login.php">here</a></p>
</body>
</html>