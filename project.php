<?php
require("header.inc.php");

if (array_key_exists('id', $_GET)) {
    $query = mysql_query("SELECT * FROM `projects` WHERE `id` = '".$_GET['id']."'");
    $data = mysql_fetch_array($query);
    
    print("<h1>".$data['name']."</h1>");
        
    $apis = json_decode($data['apis']);
    print("<h2>Your current APIs</h2>");
    foreach ($apis as $curr) {
        $query2 = mysql_query("SELECT `name` FROM `apis` WHERE `id` = '".$curr."'");
        $name = mysql_fetch_array($query2);
        print($name['name']."<br />");
    }
}
else {
    print("Invalid Information.");
}

require("footer.inc.php");
?>