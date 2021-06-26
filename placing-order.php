<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Placing Order</title>
    <link rel="stylesheet" href="./styles/style.css">
</head>
<body>
    
    <header class="nav-bar-header">
        <nav class="nav-bar nav-bar-hidden">
            <ul class="nav-bar-list">
                <li class="nav-item"><a href="/index.html" class="nav-item-link">Home</a></li>
                <li class="nav-item"><a href="/catalog.php" class="nav-item-link">Catalog</a></li>
                <li class="nav-item"><a href="/cart.php" class="nav-item-link cart-nav-item">Cart</a></li>
            </ul>
        </nav>
    </header>

<?php
session_start();

$db = mysqli_connect("localhost","","");



if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

mysqli_select_db($db, "catalog");


mysqli_set_charset($db, "utf8");

$fname = $_REQUEST["fname"];
$lname = $_REQUEST["lname"];
$cn = $_REQUEST["cn"];
$country = $_REQUEST["country"];
$houseadd = $_REQUEST["houseadd"];
$apartment = $_REQUEST["apartment"];
$city = $_REQUEST["city"];
$state = $_REQUEST["state"];
$postcode = $_REQUEST["postcode"];
$phone = $_REQUEST["phone"];
$email = $_REQUEST["email"];
$items_ordered = serialize($_SESSION["cart"]);


$sql = "INSERT INTO `orders` (`id`, `fname`, `lname`, `cn`, `country`, `houseadd`, `apartment`, `city`, `state`, `postcode`, `phone`,`email`,`items_ordered`) VALUES (NULL,  '$fname', '$lname', '$cn', '$country', '$houseadd', '$apartment', '$city', '$state', '$postcode', '$phone','$email','$items_ordered')";

$query = mysqli_query($db, $sql);


if($query)
{
    echo "<div class=\"empty-cart\">
    <h1 class=\"empty-cart-message\">Your order has been accepted</h1></div>";
    unset($_SESSION["cart"]);
}
else
{
    echo "Message:" . $db->error;
}
?>

</body>
</html>
