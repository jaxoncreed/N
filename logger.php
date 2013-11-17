<?php
    if (array_key_exists('log', $_POST)) {
        $data = json_decode($_POST['log']);
        $query = mysql_query("SELECT `project_calls` FROM `apis` WHERE `id` = '".$$data['id']."'");
        $functions = mysql_fetch_array($query);
        $containsFunction = false;
        foreach ($functions as $function=>$gettingCalled) {
            if ($function == $data['func']) {
                $containsFunction = true;
                $functions[$function] = $gettingCalled++;
            }
        }
        if (!containsFunction) {
            array_push($functions, 1);
        }
        mysql_jquery("UPDATE `apis` SET `project_calls` = '".json_encode($functions)."'");
    }
    
?>
<html>
    <body>
        <image src="logger.jpg" />
    </body>
</html>