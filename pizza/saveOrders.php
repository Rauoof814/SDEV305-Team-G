<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="pizza.css">
    <title>Pizza ordering form</title>

</head>
<body>
<!-- Site nav -->
<header class="site-navigation">
    <div class="container">
        <div class="navbar">
            <a class="navbar-brand" href="pizza.html">PizzaTime</a>
            <span><a class="nav-link" href="ViewOrders.php">View All Orders</a></span>
        </div>
    </div>
</header>
<br>
<div class="container">
    <?php
    require '/home/gnocchig/pizzadb.php';
    // Create Order ID
    $sql = "SELECT MAX(order_id) AS ID FROM `orders`";
    $result = @mysqli_query($cnxn, $sql);
    $row = mysqli_fetch_assoc($result);
    // check if there are any order IDs
    if ($row['ID'] == NULL || $row['ID'] == 0 || $row['ID'] == "") {
        $orderID = 1; // start at 1
    }
    else {
        $orderID = $row['ID'] + 1; // create new order ID
    }

    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $street = $_POST["street"];
    $city = $_POST["city"];
    $state = $_POST["state"];
    $zip = $_POST["zip"];
    $size = $_POST["size"];
    $topping1 = $_POST["topping"][0];
    $topping2 = $_POST["topping"][1];
    $topping3 = $_POST["topping"][2];
    $notes = $_POST["notes"];

    $sql = "INSERT INTO `orders`(`order_id`, `order_name`, `order_email`, `order_phone`, `order_street`, `order_city`, `order_state`, `order_zip`, `order_size`, `order_topping1`, `order_topping2`, `order_topping3`, `order_notes`) VALUES ('$orderID', '$name','$email','$phone','$street','$city','$state','$zip','$size','$topping1','$topping2','$topping3','$notes')";
    mysqli_query($cnxn, $sql);

    echo '<p class="fs-3">Thank you, ' . $name . '!</p>';
    echo '<p>We have received your order!</p>';
    echo '<p>Here are your order details:</p>';
    echo '<p>' . $name .' </p>';
    echo '<p>' . $email .' </p>';
    echo '<p>' . $phone .' </p>';
    echo '<p>' . $street .' </p>';
    echo '<p>' . $city .' </p>';
    echo '<p>' . $state .' </p>';
    echo '<p>' . $zip .' </p>';
    echo '<p>' . $size .' </p>';
    echo '<p>' . $topping1 .' </p>';
    echo '<p>' . $topping2 .' </p>';
    echo '<p>' . $topping3 .' </p>';
    echo '<p>' . $notes .' </p>';
    echo '<a href="ViewOrders.php"><button type=button class="btn btn-primary">View Orders</button></a>';

    ?>
</div>

<!-- Required JavaScript -->
<!-- Popper.js, then Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>