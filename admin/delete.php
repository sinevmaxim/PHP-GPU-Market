<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete data</title>
    <link rel="stylesheet" href="../styles/style.css">
    <script src="../scripts/jquery-3.6.0.min.js"></script>
</head>
<body>

<header class="nav-bar-header">
        <nav class="nav-bar nav-bar-hidden">
            <ul class="nav-bar-list">
                <li class="nav-item"><a href="add.php" class="nav-item-link">Add Values</a></li>
                <li class="nav-item"><a href="update.php" class="nav-item-link">Update Values</a></li>
                <li class="nav-item"><a href="delete.php" class="nav-item-link cart-nav-item">Delete Values</a></li>
            </ul>
        </nav>
    </header>


<?php

    session_start();
    if($_SESSION["admin"]["login"] == "" && $_SESSION["admin"]["password"] == "")
    {
        $_SESSION["admin"]["login"] = $_REQUEST["login"];
        $_SESSION["admin"]["password"] = $_REQUEST["password"];
    }

    if ($_SESSION["admin"]["login"] == admin && $_SESSION["admin"]["password"] == admin) {

        
        echo "<div class=\"table-container\">
            <p class=\"table-p\">Select table</p>
            <select name=\"table\" id=\"table-selection\">
                <option value=\"products\">Products</option>
                <option value=\"orders\">Orders</option>
            </select>
        </div>";

    }
    else{
        echo "<form method=\"post\"><div class=\"admin-container\">
        <p class=\"admin-login\">Login</p>
        <input class=\"admin-auth admin-login\" type=\"text\" name=\"login\" id=\"\">
        <p class=\"admin-password\">Password</p>
        <input class=\"admin-auth admin-password\" type=\"password\" name=\"password\" id=\"\">
        <p><input type=\"submit\" value=\"Login\"></p>
        </div></form>";
        
    }
    ?>

    <div class="database-tables"></div>
</body>

<script src="../scripts/selectTableDeleteHandler.js"></script>

</html>