<?php
require("header.inc.php");

if (isset($_POST['addToProject'])) {
    $query = mysql_query("SELECT `apis` FROM `projects` WHERE `id` = '".$_POST['project']."'");
    $apiData = mysql_fetch_array($query);
    if (json_decode($apiData['apis']) != '') {
        $apis = json_decode($apiData['apis']);
    }
    else {
        $apis = array();
    }
    array_push($apis, $_GET['id']);
    mysql_query("UPDATE `projects` SET `apis` = '".json_encode($apis)."' WHERE `id` = '".$_POST['project']."'");
}

if (array_key_exists('id', $_GET) ) {
    $query = mysql_query("SELECT * FROM `apis` WHERE `id` = '".$_GET['id']."'");
    $data = mysql_fetch_array($query);
    
    print("<h1>".$data['name']."</h1>");

    if (isLoggedIn()) {
        print("<h2>Add this API to your project.</h2>");
        print("<form method='post' action''>");
            print("<select name='project'>");
            $query2 = mysql_query("SELECT `projects` FROM `users` WHERE `id` = '".isLoggedIn()."'");
            $projectsTemp = mysql_fetch_array($query2);
            $projects = json_decode($projectsTemp['projects']);
            foreach ($projects as $curr) {
                $query3 = mysql_query("SELECT `name` FROM `projects` WHERE `id` = '".$curr."'");
                $name = mysql_fetch_array($query3);
                print("<option value=\"".$curr."\">".$name['name']."</option>");
            }
            print("</select>");
            print("<button type=\"submit\" name=\"addToProject\" id=\"addToProject\">Add to Project</button>");
        print("</form>");
    }
    
    print("<p>".$data['description']."</p>");
}
else {
    print("Invalid Information.");
}

require("footer.inc.php");
?>