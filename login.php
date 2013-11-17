<?php
    require("header.inc.php");
    
    if (isLoggedIn()) {
        if ($_SESSION['unauthReturn']) {
            $redirect = $_SESSION['unauthReturn'];
            $_SESSION['unauthReturn'] = null;
            header("Location: ".$redirect);
            exit;
        }
        else {
            header("Location: control.php");
            exit;
        }
    }
?>

<div id="Login">
    <h1>Login</h1>
    <form class="loginForm" method="post" action="">
        <h2>Email:</h2>
        <input type="text" name="username" id="username" />
        <h2>Password:</h2>
        <input type="password" name="password" id="password" />
        <br /><br />
        <button type="submit" name="loginButton" id="loginButton">Login</button>
        <a href="createUser.php">Create a new account</a>
    </form>
</div> 

<?php
    require("footer.inc.php");
?>