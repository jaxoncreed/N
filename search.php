<?php
require("header.inc.php");
?>

<form id="createApiForm" method="post" action="">
    <table><tr>
        <td><input type="text" name="searchText" id="serachText" /></td>
        <td><button type="submit" name="searchButton" id="searchButton">Search</button></td>
    </tr></table>
    
</form>

<?php
if (isset($_POST['searchButton'])) {
    $query = mysql_query("SELECT * FROM `apis` WHERE `name` LIKE '%".$_POST['searchText']."%'");
    $arr = array();
    $index = 0;
    while ($row = mysql_fetch_assoc($query)) {
        $arr[$index] = $row;
        $index++;
    }
    foreach ($arr as $curr) {
        print("<strong><a href=\"api.php?id=".$curr['id']."\">".$curr['name']."</a></strong><br />");
        print($curr['description']);
        print("<br /><br />");
    }
    
    $query2 = mysql_query("SELECT * FROM `apis` WHERE `tags` LIKE '%".$_POST['searchText']."%'");
    $arr2 = array();
    $index2 = 0;
    while ($row = mysql_fetch_assoc($query2)) {
        $duplicate = false;
        foreach ($arr as $curr) {    
            if ($curr['id'] == $row['id']) {
                $duplicate = true;
            }
        }
        if (!$duplicate) {
            $arr2[$index2] = $row;
            $index2++;
        }
    }
    foreach ($arr2 as $curr) {
        print("<strong><a href=\"api.php?id=".$curr['id']."\">".$curr['name']."</a></strong><br />");
        print($curr['description']);
        print("<br /><br />");
    }
}
require("footer.inc.php");
?>
