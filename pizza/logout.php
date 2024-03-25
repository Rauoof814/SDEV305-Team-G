<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}
else {
    $form = '
        <form>
            <p>Successfully signed out</p>
            <a href="pizza.html"><button type="button">Return</a>
        </form>
    ';

    session_unset();
    session_destroy();
}
?>
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
    <!-- Form title -->
    <div class="form-title">
        <h1>Login</h1>
        <hr>
    </div>
    <?php echo $form; ?>
</div>
<br>
<br>
<br>
<br>