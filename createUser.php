<?php
    require("header.inc.php");
    
    if (isset($_POST['createButton'])) {
        print("thisHappened");
        $email = mysql_real_escape_string($_POST['email']);
        $pass1 = mysql_real_escape_string($_POST['password1']);
        $pass2 = mysql_real_escape_string($_POST['password2']);
        $realname = mysql_real_escape_string($_POST['realname']);
        $username = mysql_real_escape_string($_POST['username']);
        $query = mysql_query("SELECT `username` FROM `users` WHERE `username` = '".$username."'");
        if ($email == "") {
            print("Error: Email field was left blank.");
        }
        elseif ($pass1 == "" || $pass2 == "") {
            print("Error: One of the password fields was left blank.");
        }
        elseif ($username == "") {
            print("Error: Username field was left blank.");
        }
        elseif ($realname == "") {
            print("Error: Name field was left blank.");
        }
        elseif ($pass1 != $pass2) {
            print("Error: Password fields did not match.");
        }
        elseif (mysql_num_rows($query)) {
            print("Error: This username was already registered.");
        }
        else {
            mysql_query("INSERT INTO `users` (`username`, `password`, `realname`, `email`, `projects`) VALUES ('".$username."', '".sha1($pass1)."', '".$realname."', '".$email."', '')");
            header("Location: ./control.php");
            exit;
        }
    }
?>

<h1>Create Your Account</h1>
<form id="createUserForm" method="post" action="">
    <h2>Username</h2>
    <input type="text" name="username" id="realname" />
    <h2>Name:</h2>
    <input type="text" name="realname" id="realname" />
    <h2>Password:</h2>
    <input type="password" name="password1" id="password1" />
    <h2>Confirm Password:</h2>
    <input type="password" name="password2" id="password2" />
    <h2>Email:</h2>
    <input type="text" name="email" id="email" />
    <br /><br />
    <button type="submit" name="createButton" id="createButton">Create Your Account</button>
</form>

<?php
    include("footer.inc.php");
?>