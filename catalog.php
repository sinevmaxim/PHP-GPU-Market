<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalog</title>
    <link rel="stylesheet" href="styles/style.css">
    <script src='./scripts/jquery-3.6.0.min.js'></script>
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
    // $db = mysqli_connect("localhost","maxim","maxim123");
    $db = mysqli_connect("mysql-171133.srv.hoster.ru","srv171133_admin","169356.ad");


        if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }
        
        // mysqli_select_db($db, "catalog");
mysqli_select_db($db, "srv171133_gpu_market");

        mysqli_set_charset($db, "utf8");
        
        session_start();

        if (!isset($_SESSION)) {
            $_SESSION = [];
        }

        ?>

    <form class="sort-type" method="get">
        <div class="bg-image"></div>
        <div class="form-fields">
            <div class="form-input form--select-type">
                <select name="category" id="category">
                    <option disabled>Product type</option>
                    <option value="all">All</option>
                    <?php
                        $categories_query = mysqli_query($db, "SELECT DISTINCT category FROM products");
                        while ($category = $categories_query->fetch_array(MYSQLI_ASSOC)){
                            echo "<option>" . $category["category"] . "</option>";
                        }
                    ?>
                </select>
            </div>
        

        <div class="form-input form--select-sort">
            <select name="sort" id="sort">
                <option disabled>Sort by</option>
                <option value="1">Price ascending</option>
                <option value="2">Price descending</option>
                <option value="3">A-Z</option>
                <option value="4">Z-A</option>
            </select>
        </div>
        <div class="form-input form--price">
            <label for="min">From</label>
            <input type="number" name="min" id="min">
            <label for="max">To</label>
            <input type="number" name="max" id="max">
        </div>
        <div class="form-input form--submit">
        <input type="submit" value="Sort">
        </div>

        </div>
    </form>

    <?php
        $query = "SELECT * FROM products WHERE ";

        $value = @$_GET['sort'];
        $min = @$_GET["min"];
        $max = @$_GET["max"];
        $category = @$_GET["category"];


        if ($category != "" && $category != 'all') {
            $query = $query . 'products.category = \''. $category . '\' AND ';
        }
        if ($min != "") {
            $query = $query . 'products.price BETWEEN ' . $min . ' AND ';
        } else {
            $query = $query . 'products.price BETWEEN 0 AND ';
        }
        if ($max != "") {
            $query = $query . $max . " ";
        } else {
            $query = $query . '100000000 ';
        }
        if ($value != "") {
            switch ($value) {
                case '1':
                    $query = $query . 'ORDER BY products.price ASC;';
                    break;
                case '2':
                    $query = $query . 'ORDER BY products.price DESC;';
                    break;
                case '3':
                    $query = $query . 'ORDER BY products.name ASC;';
                    break;
                case '4':
                    $query = $query . 'ORDER BY products.name DESC;';
                    break;
                default:
                    break;
            }
        }

        $query = $query . ';';

        $result = mysqli_query($db, $query);
        echo "<div class=\"catalog\">";
        while ($item = $result->fetch_array(MYSQLI_ASSOC)){
            echo "<div class=\"container\">
            <div class=\"card\">
                <div class=\"image\">
                    <div class=\"circle\"></div>
                    <img src=\"/images/". $item['name'] . ".png\">
                </div>
                <div class=\"info\">
                    <h1 class=\"title\">" . $item['company'] . " " . $item['name'] . "</h1>
                    <h3>" . $item['description'] . "</h3>
                    <h3 class=\"price\">{$item['price']} $</h3>
                </div>
                <div class=\"purchase\">
                    <button onclick='cartAddHandler(". $item['id'] . ")'>Add to cart</button>
                </div>
            </div>
        </div>";
        }
        echo "</div>";
    ?>
    
</body>

<script src="../scripts/cartHandler.js"></script>
