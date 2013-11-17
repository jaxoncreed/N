<?php

//To be done later: 

require("header.inc.php");
    if (!isLoggedIn()) {
        $_SESSION['unauthReturn'] = "newproject.php";
        header("Location: login.php");
        exit;
    }
    else if (isset($_POST['createButton'])) {
        $name = mysql_escape_string($_POST['name']);
        if ($name == "") {
            print("Error: Name field was left blank.");
        }
        else {
            mysql_query("INSERT INTO `projects` (`name`, `user`) VALUES ('".$name."', '".isLoggedIn()."')");
            $id = mysql_insert_id();
            $query = mysql_query("SELECT `projects` FROM `users` WHERE `id` = '".isLoggedIn()."'");
            $memberData = mysql_fetch_array($query);
            if (json_decode($memberData['projects']) != '') {
                $projects = json_decode($memberData['projects']);
            }
            else {
                $projects = array();
            }
            array_push($projects, $id);
            mysql_query("UPDATE `users` SET `projects` = '".json_encode($projects)."' WHERE `id` = '".isLoggedIn()."'");
            header("Location: ./control.php");
            exit;
        }
    }
?>

<div class="createThing">
    <h1>Create a New API</h1>
    <form id="createApiForm" method="post" action="">
        <h2>Project Name</h2>
        <input type="text" name="name" id="name" />
        <br /><br />
        <button type="submit" name="createButton" id="createButton">Create a New Project</button>
    </form>
</div> 

<?php
require("footer.inc.php");
?>
