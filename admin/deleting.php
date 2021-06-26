<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete data</title>
    <style>
        @keyframes slideInFromLeft {
        0% {
            transform: translateY(-100%);
            opacity: 0;
        }
        100% {
            transform: translateY(0);
            opacity: 100;
        }
    }
        .form-info{
            text-align:center;
            width:100%;
            border-radius: 15px 50px;
            opacity:0.8;
            animation: 1.5s ease-out 0s 1 slideInFromLeft;         
        }
        .info-successful{
            background-color:green;
            font-size:20px;
            font-family: sans-serif;
            padding: 50px 0px 50px 0px;
        }
        .info-error{
            background-color:red;
            font-size:20px;
            font-family: sans-serif;
            padding: 50px 0px 50px 0px;
        }
    </style>
    <link rel="stylesheet" href="../styles/style.css">
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

$db = mysqli_connect("localhost","","");


if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

mysqli_select_db($db, "catalog");

mysqli_set_charset($db, "utf8");

$data = explode(" ", $_POST['delete-option']);
$id = $data[0];
$table = $data[1];

$sql = "DELETE FROM " . $table . " WHERE id = " . $id;


$query = mysqli_query($db, $sql);

if($query)
{
    echo"<div class=\"form-info info-successful\">
    Data deleted
    </div>";
}
else
{
    echo "Message:" . $db->error;
    echo"<div class=\"form-info info-error\">
    Error
    </div>";
}
?>
</body>
</html>