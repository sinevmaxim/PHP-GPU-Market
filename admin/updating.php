<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Updating</title>
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
</head>
<body>
	
<?php
    $db = mysqli_connect("localhost","","");



    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    mysqli_select_db($db, "catalog");


    mysqli_set_charset($db, "utf8");
        
    $name = $_POST['name'];
    $company = $_POST['company'];
    $description = $_POST['description'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $id=$_REQUEST['id'];

	$query = mysqli_query($db, "SELECT * FROM products WHERE name='$name' AND company='$company' AND description='$description' AND quantity='$quantity' AND price='$price' AND category='$category'");
		
	if(!(mysqli_fetch_array($query)))
	{
		$update_query=mysqli_query($db,"UPDATE products SET name='$name',company='$company',description='$description',quantity='$quantity',price='$price',category='$category' WHERE id='$id'");
		
		if($update_query)
		{
            echo"<div class=\"form-info info-successful\">
            Data updated
            <a href=update.php>Back</a>
            </div>";
		}
		else
		{   
                echo"<div class=\"form-info info-error\">
            Message:" . $db->error . "
            Error <a href=update.php>Back</a>
            </div>";
		}
	}
	else
	{
		echo "<div class=\"form-info info-error\"> <a href=update.php?id=$id>This data doesn't exist</a> </div>";
	}

?>


</body>
</html>

