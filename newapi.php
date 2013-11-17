<?php

//To be done later: 

require("header.inc.php");
    if (!isLoggedIn()) {
        $_SESSION['unauthReturn'] = "newapi.php";
        header("Location: login.php");
        exit;
    }
    else if (isset($_POST['createButton'])) {
        $name = mysql_escape_string($_POST['name']);
        $git = mysql_escape_string($_POST['git']);
        $json = mysql_escape_string($_POST['json']);
        $description = mysql_escape_string($_POST['description']);
        $tagsTemp = explode(",", mysql_escape_string($_POST['tags']));
        $tags = json_encode($tagsTemp);
        //Implement something that will say if a git repository doesn't exist.
        if ($name == "") {
            print("Error: Name field was left blank.");
        }
        elseif ($git == "") {
            print("Error: Git HTTPS URL field was left blank.");
        }
        elseif ($description == "") {
            print("Error: Description field was left blank.");
        }
        elseif ($tags == "") {
            print("Error: Tag field was left blank.");
        }
        else {
            mysql_query("INSERT INTO `apis` (`name`, `git`, `json`, `description`, `tags`, `user`, `project_calls`) VALUES ('".$name."', '".$git."', '".$json."', '".$description."', '".$tags."', '". isLoggedIn()."', '')");
            $id = mysql_insert_id();
            $query = mysql_query("SELECT `apis` FROM `users` WHERE `id` = '".isLoggedIn()."'");
            $memberData = mysql_fetch_array($query);
            if (json_decode($memberData['apis']) != '') {
                $apis = json_decode($memberData['apis']);
            }
            else {
                $apis = array();
            }
            array_push($apis, $id);
            mysql_query("UPDATE `users` SET `apis` = '".json_encode($apis)."' WHERE `id` = '".  isLoggedIn()."'");
            exec('home/ubuntu/AWS.sh '.$git.' '.$name);
            mkdir("../../../home/ubuntu/".$name);
            $jFile = "../../../home/ubuntu/".$name."/config.js";
            $text = "var scripts = ".$json."exports.scripts = scripts";
            $handle = fopen($jFile, 'wb');
            fwrite($handle, $text);
            header("Location: ./control.php");
            exit;
        }
    }
?>

<div class="createThing">
    <h1>Create a New API</h1>
    <form id="createApiForm" method="post" action="">
        <h2>API Name</h2>
        <input type="text" name="name" id="name" />
        <h2>Git HTTPS Clone URL</h2>
        <input type="text" name="git" id="git" />
        <h2>Pass in your JSON info</h2>
        <textarea name="json" id="json"></textarea>
        <h2>Description</h2>
        <textarea name="description" id="description"></textarea>
        <h2>Tags (Separated by a coma)</h2>
        <input type="text" name="tags" id="tags" />
        <br /><br />
        <button type="submit" name="createButton" id="createButton">Create a New API</button>
    </form>
</div> 

<?php
require("footer.inc.php");
?>
