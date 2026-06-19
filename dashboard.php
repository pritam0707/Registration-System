<?php

session_start();

if(!isset($_SESSION["id"])){

    header("Location: login.html");

    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

    <h1>
        Welcome
        <?php
        echo $_SESSION["name"];
        ?>
    </h1>

    <p>
        Login Successful
    </p>

    <a href="logout.php">
        Logout
    </a>

</div>

</body>
</html>