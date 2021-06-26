<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adding data</title>
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

$name = $_POST['name'];
$lname = $_POST['lname'];
$fname = $_POST['fname'];
$company = $_POST['company'];
$cn = $_POST['cn'];
$country = $_POST['country'];
$houseadd = $_POST['houseadd'];
$apartment = $_POST['apartment'];
$city = $_POST['city'];
$state = $_POST['state'];
$postcode = $_POST['postcode'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$description = $_POST['description'];
$quantity = $_POST['quantity'];
$price = $_POST['price'];
$category = $_POST['category'];
$table = $_POST["table"];


if($table == "products")
{
    $sql = "INSERT INTO `products` (`id`, `name`, `company`, `quantity`, `price`, `category`, `description`) VALUES 
    (NULL, '$name', '$company', '$quantity', '$price', '$category','$description')";
}

if($table == "orders")
{
    $sql = "INSERT INTO `orders` (`fname`, `lname`, `cn`, `country`, `houseadd`, `apartment`, `city`, `state`, `postcode`, `phone`, `email`, `id`, `items_ordered`) VALUES 
    ('$fname', '$lname', '$cn', '$country', '$houseadd', '$apartment', '$city', '$state', '$postcode', '$phone' ,'$email', NULL, '')";
}

$query = mysqli_query($db, $sql);

if($query)
{
    echo "<div class=\"empty-cart\">
    <h1 class=\"empty-cart-message\">Your order has been accepted</h1></div>";

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