<?php
require("header.inc.php");

if (array_key_exists('id', $_GET)) {
    $query = mysql_query("SELECT * FROM `apis` WHERE `id` = '".$_GET['id']."'");
    $data = mysql_fetch_array($query);
    
    print("<h1>".$data['name']."</h1>");
        
    $calls = json_decode($data['project_calls']);
    print("<h2>How many times your functions have been called</h2>");
    if ($data['project_calls'] != "") {
        foreach ($calls as $function=>$number) {
            print($function.": ".$number."<br />");
        }
    }
    else {
        print ("None of your functions have been called.");
    }
}
else {
    print("Invalid Information.");
}

require("footer.inc.php");
?>