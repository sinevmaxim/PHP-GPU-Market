<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="styles/style.css">
    <script src='./scripts/jquery-3.6.0.min.js'></script>
    <script src="../scripts/cartHandler.js"></script>
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


$db = mysqli_connect("localhost","","");



if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}


mysqli_select_db($db, "catalog");


mysqli_set_charset($db, "utf8");




session_start();

if (count($_SESSION["cart"]) == 0) {
    echo "<div class=\"empty-cart\">
    <h1 class=\"empty-cart-message\">The cart is empty right now</h1></div>";
}else{
    echo "<div class=\"cart-page\">
    <table class=\"cart-table\">
    <tr>
    <th>Product name</th>
    <th>Quantity</th>
    <th>Total</th>
    <th></th>
    </tr>";
    $overall_price = 0;
    foreach($_SESSION["cart"] as $item_id => $item_ammount){ 
        $query = "SELECT * FROM products WHERE id=" . $item_id;
        $result = mysqli_query($db, $query);
        while ($item = $result->fetch_array(MYSQLI_ASSOC))
        {
            $total_price = $item_ammount * $item["price"];
            $overall_price += $total_price;

            echo 
            "<tr class=\"cart-item-row\">
                <td>
                    <div class=\"cart-item\">
                        <img src=\"images/" . $item['name'] . ".png\">
                        <div class=\"cart-item-info\">
                            <p>" . $item['company'] . "<p>
                            <p>" . $item['name'] . "<p>
                            <p class=\"cart-item-price-" .$item_id . "\" >" . $item['price'] . "$<p>
                        </div>
                    </div>
                </td>
                <td>
                    <div class=\"input-group input-number-group\">
                        <div class=\"input-group-button\">
                            <span id=" . $item_id . " class=\"input-number-decrement\">-</span>
                        </div>
                        <input class=\"input-number input-number-class-" . $item_id . "\" type=\"number\" value=" . $item_ammount . " min=\"0\" max=\"1000\">
                        <div class=\"input-group-button\">
                            <span id=" . $item_id . " class=\"input-number-increment\">+</span>
                        </div>
                    </div>
                </td>
                <td> <p class=\"total-price-class total-price-class-" . $item_id . "\">" . $total_price . "$</p></td>
                <td class=\"cart-btn-field\"><button id=cart-remove-" . $item_id . "-item class=\"cart-remove-btn\" type=\"button\">Remove</button></td>
            </tr>";
        }
    }








    echo "<tr>
    <td>
    </td><td></td><td class=\"total-price\">". $overall_price . "$</td>
    <td class=\"cart-btn-field\"><form action=\"order.php\" method=\"POST\"><button id=\"buy-btn\" class=\"cart-buy-btn\" type=\"submit\">Buy</button></td>
    </tr>

    </table></div>

    </div>
    </body>
    <script src=\"../scripts/quantityChangeHandler.js\"></script>
    <script src=\"../scripts/cartItemRemoveHandler.js\"></script>";
}
?>
</html>