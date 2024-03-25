<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}
?>
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
            <span><a class="nav-link" href="logout.php">Log Out</a></span>
        </div>
    </div>
</header>
<br>
<div class="container">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Order ID</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Phone</th>
            <th scope="col">Address</th>
            <th scope="col">Pizza Size</th>
            <th scope="col">Toppings</th>
            <th scope="col">Notes</th>
        </tr>
        </thead>
        <tbody>
        <?php
        require '/home/gnocchig/pizzadb.php';
        $sql = "SELECT * FROM orders";
        $result = @mysqli_query($cnxn, $sql);
        while ($row = mysqli_fetch_assoc($result))
        {
            $orderID = $row['order_id'];
            $name = $row['order_name'];
            $email = $row['order_email'];
            $phone = $row['order_phone'];
            $street = $row['order_street'];
            $city = $row['order_city'];
            $state = $row['order_state'];
            $zip = $row['order_zip'];
            $size = $row['order_size'];
            $topping1 = $row['order_topping1'];
            $topping2 = $row['order_topping2'];
            $topping3 = $row['order_topping3'];
            $notes = $row['order_notes'];

            $row = '
                <tr>
                    <th scope="row"> ' . $orderID . '</th>
                    <td> ' . $name . '</td>
                    <td> ' . $email . '</td>
                    <td> ' . $phone . '</td>
                    <td> ' . $street . ', ' . $city . ' ' . $state . ' ' . $zip . '</td>
                    <td> ' . $size . '</td>
                    <td> ' . $topping1 . ', ' . $topping2 . ', ' . $topping3 . '</td>
                    <td> ' . $notes . '</td>
                </tr>
            ';

            echo $row;
        }

        ?>
        </tbody>
    </table>
</div>
<!-- Required JavaScript -->
<!-- Popper.js, then Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>
