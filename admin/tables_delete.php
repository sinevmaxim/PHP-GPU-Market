<?php

$db = mysqli_connect("localhost","","");



if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

mysqli_select_db($db, "catalog");


mysqli_set_charset($db, "utf8");

$table = $_REQUEST["value"];

$result = mysqli_query($db, "SELECT * FROM " . $table);


if($table == "orders"){

    
    echo"<form class=\"admin-delete-form\"action=\"deleting.php\" method=\"post\">";
    while ($item = mysqli_fetch_assoc($result)){
        printf("<input class=\"admin-delete-option\" type=\"checkbox\" name=\"delete-option\" value=\"%s %s\"> %s %s</p>",$item["id"], $table, $item["fname"],$item["lname"]);
    }

    echo"<input class=\"remove-btn\" type=\"submit\" value=\"Delete\"></form>";
}

if($table  == "products"){

    
    echo"<form class=\"admin-delete-form\" action=\"deleting.php\" method=\"post\">";
    while ($item = mysqli_fetch_assoc($result)){
        printf("<input class=\"admin-delete-option\" type=\"checkbox\" name=\"delete-option\" value=\"%s %s\"> %s %s</p>",$item["id"],$table, $item["name"],$item["company"]);
    }

    echo"<input class=\"remove-btn\" type=\"submit\" value=\"Delete\"></form>";
}
?>