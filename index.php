<?php
    require("header.inc.php");
    if (isLoggedIn()) {
        print("<p>Hello World!</p>");
    }
    else {
        print("<p>Goodbye World!</p>");
    }
    include("footer.inc.php");
?>