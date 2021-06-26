<?php
session_start();

if($_REQUEST["id"] != "" && $_REQUEST["value"] != ""){

    $result = [];
    if($_REQUEST["value"] == "-")
    {
        $_SESSION["cart"][$_REQUEST["id"]] = max(1, $_SESSION["cart"][$_REQUEST["id"]]- 1);
        $result = [
            "response" => $_SESSION["cart"][$_REQUEST["id"]]
        ];
        echo json_encode($result);
    }
    if($_REQUEST["value"] == "+")
    {
        $_SESSION["cart"][$_REQUEST["id"]] += 1;
        $result = [
            "response" => $_SESSION["cart"][$_REQUEST["id"]]
        ];
        echo json_encode($result);
    }
}