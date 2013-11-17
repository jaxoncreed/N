<?php
require("header.inc.php");

$query = mysql_query("SELECT `apis`, `projects` FROM `users` WHERE `id` = '".isLoggedIn()."'");
$memberData = mysql_fetch_array($query);
if (json_decode($memberData['apis']) != '') {
    $apis = json_decode($memberData['apis']);
}
else {
    $apis = array();
}
if (json_decode($memberData['projects']) != '') {
    $projects = json_decode($memberData['projects']);
}
else {
    $projects = array();
}

print("<form action=\"newproject.php\"><input type=\"submit\" value=\"Create a New Project\"></form>");
print("<form action=\"newapi.php\"><input type=\"submit\" value=\"Create a New API\"></form>");
print("<h1>Your Projects</h1>");
print("<table class=\"list\">");
foreach ($projects as $curr) {
    $query = mysql_query("SELECT * FROM `projects` WHERE `id` = '".$curr."'");
    $projArr = mysql_fetch_array($query);
    print("<tr><td>");
    print("<h3><a href=\"project.php?id=".$projArr['id']."\">".$projArr['name']."</a></h3>");
    print("</tr></td>");
}
print("</table>");

print("<h1>Your APIs</h1>");
print("<table class=\"list\">");
foreach ($apis as $curr) {
    $query = mysql_query("SELECT * FROM `apis` WHERE `id` = '".$curr."'");
    $apiArr = mysql_fetch_array($query);
    print("<tr><td>");
    print("<h3><a href=\"manageapi.php?id=".$apiArr['id']."\">".$apiArr['name']."</a></h3>");
    print("</td><td>");
    print("<form action=\"editapi.php?id=".$apiArr['id']."\" style=\"float:right;\"><input type=\"submit\" value=\"Edit this API\"></form>");
    print("</td></tr>");
}
print("</table>");
?>



<?php
require("footer.inc.php");
?>
