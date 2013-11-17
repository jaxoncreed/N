<?php
    require("config.php");
    session_start();
    
    //Checks to see if the user is logged in. If he/she is, then it returns thier data. If not, then it returns false
    function isLoggedIn() {
        $sessID = mysql_real_escape_string(session_id());
        $hash = mysql_real_escape_string(sha1($sessID.$_SERVER['HTTP_USER_AGENT']));
        $query = mysql_query("SELECT `users` FROM `active_users` WHERE `session_id` = '".$sessID."' AND `hash` = '".$hash."' AND `expires` > ".time());
        if (mysql_num_rows($query)) {
            $data = mysql_fetch_assoc($query);
            return ($data['users']);
        }
        else {
            return false;
        }
    }
    
    function getUser() {
        $user = isLoggedIn();
        if ($user) {
            $query = mysql_query("SELECT `email`, `name` FROM `users` WHERE `id` ='".(int) $user."'");
            return mysql_fetch_assoc($query);
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>N - The API Marketplace</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div class="NContainer">
            <div class="NLeftLine"></div>
            <div class="NDiagonal"></div>
            <div class="NRightLine"></div>
            <div class="NInfLeft"></div>
            <div class="NInfRight"></div>
        </div>
        <div class="header">
            <span style="position: absolute; right: 5px; bottom: 5px;">
                <form id="logoutForm" method="post" action="">
                    <?php
                        if (isLoggedIn()) {
                            if (isset($_POST['logoutButton'])) {
                                $user = isLoggedIn();
                                mysql_query("DELETE FROM `active_users` WHERE `users` = ".(int) $user);
                                header("Location: ./index.php");
                                exit;
                            }
                            $expires = time() + (60 * 60); //Session expires with an hour of inactivity
                            mysql_query("UPDATE `active_users` SET `expires` = '".$expires."' WHERE `user` = '".(int) isLoggedIn()."'");
                            print("<button type=\"submit\" name=\"logoutButton\" id=\"logoutButton\">Logout</button>");
                        }
                        else {
                            if (isset($_POST['loginButton'])) {
                                if ($_POST['username'] == "") {
                                    print("Error: The username field was not set.");
                                }
                                elseif ($_POST['password'] == "") {
                                    print("Error: The password field was not set.");
                                }
                                else {
                                    $query = mysql_query("SELECT `id` FROM `users` WHERE `username` = '".mysql_real_escape_string($_POST['username'])."' AND `password` = '".sha1(mysql_real_escape_string($_POST['password']))."'");
                                    if (mysql_num_rows($query)) {
                                        $sessID = mysql_real_escape_string(session_id());
                                        $hash = mysql_real_escape_string(sha1($sessID.$_SERVER['HTTP_USER_AGENT']));
                                        $userData = mysql_fetch_assoc($query);
                                        $expires = time() + (60 * 60);
                                        mysql_query("INSERT INTO `active_users` (`users`, `session_id`, `hash`, `expires`) VALUES ('".$userData['id']."', '".$sessID."', '".$hash."', '".$expires."')");
                                        header("Location: ".$_SERVER['REQUEST_URI']);
                                    }
                                    else {
                                        print("Error: Email and/or Password were incorrect.");
                                    }
                                }
                            }
                            print("Username: ");
                            print("<input type=\"text\" name=\"username\" id=\"username\"></input>");
                            print("Password: ");
                            print("<input type=\"password\" name=\"password\" id=\"password\"></input>");
                            print("<button type=\"submit\" name=\"loginButton\" id=\"loginButton\">Login</button>");
                            print("<a href=\"createUser.php\">Create a new account</a>");
                        }
                    ?>
                </form>
            </span>
        </div>
        <?php
        // put your code here
        ?>
        <div class="content">
