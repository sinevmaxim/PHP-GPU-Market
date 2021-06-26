<?php
session_start();

$id = $_REQUEST['id'];

$_SESSION["cart"][$id] = $_SESSION["cart"][$id] + 1;

$ammount = 0;

foreach ($_SESSION["cart"] as $item_id => $item_ammount) {
    (int)$ammount = (int)$ammount + (int)$item_ammount;
}
echo $ammount;

?>


