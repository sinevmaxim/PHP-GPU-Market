<?php

$db = mysqli_connect("localhost","","");


if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

mysqli_select_db($db, "catalog");


mysqli_set_charset($db, "utf8");

$table = $_REQUEST["value"];

$result = mysqli_query($db, "SELECT * FROM " . $table);


if($table  == "products"){

    echo"<ul class=\"admin-update-list\">";
    while ($item = mysqli_fetch_assoc($result)){
        printf("<li class=\"admin-update-option\"><a href=update.php?id=%s&table=%s> %s %s </a></li>",$item["id"],$table,$item["name"],$item["company"]);
    }
    echo"</ul>";
}

if($table  == "orders"){

    echo"<ul class=\"admin-update-list\">";
    while ($item = mysqli_fetch_assoc($result)){
        printf("<li class=\"admin-update-option\"><a href=update.php?id=%s&table=%s> %s %s </a></li>",$item["id"],$table,$item["lname"],$item["fname"]);
    }
    echo"</ul>";
}