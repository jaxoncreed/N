<?php

//To be done later: 

require("header.inc.php");
    if (!isLoggedIn()) {
        $_SESSION['unauthReturn'] = "editapi.php";
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
            mysql_query("UPDATE `apis` SET `name` = '".$name."', `git` = '".$git."', `description` = '".$description."', `tags` = '".$tags."', `json` = '".$json."' WHERE `id` = '".$_GET['id']."'");
            header("Location: ./control.php");
            exit;
        }
    }
    else if (array_key_exists('id', $_GET)) {
        $query = mysql_query("SELECT * FROM `apis` WHERE `id` = '".$_GET['id']."'");
        if (mysql_num_rows($query)) {
            $apiArr = mysql_fetch_array($query);
            $oldTags = "";
            foreach (json_decode($apiArr['tags']) as $curr) {
                $oldTags = $oldTags.$curr.",";
            }
            rtrim($oldTags, ",");
        }
        else {
            print("<p>This page is invalid. Please go back to the <a href=\"control.php\">control panel</a>.</p>");
            exit;
        }
    }
    else {
        print("<p>This page is invalid. Please go back to the <a href=\"control.php\">control panel</a>.</p>");
        exit;
    }
?>

<div class="createThing">
    <h1>Create a New API</h1>
    <form id="createApiForm" method="post" action="">
        <h2>API Name</h2>
        <input type="text" name="name" id="name" value="<?php print($apiArr['name']); ?>" />
        <h2>Git HTTPS Clone URL</h2>
        <input type="text" name="git" id="git" value="<?php print($apiArr['git']); ?>" />
        <h2>Pass in your JSON info</h2>
        <textarea name="json" id="json"><?php print($apiArr['json']); ?></textarea>
        <h2>Description</h2>
        <textarea name="description" id="description"><?php print($apiArr['description']); ?></textarea>
        <h2>Tags (Separated by a coma)</h2>
        <input type="text" name="tags" id="tags" value="<?php print($oldTags); ?>" />
        <br /><br />
        <button type="submit" name="createButton" id="createButton">Update API</button>
    </form>
</div> 

<?php
require("footer.inc.php");
?>
