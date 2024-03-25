<?php
session_start();
if (!empty($_POST) && !empty($_POST['user_id']) && !empty($_POST['user_password'])) {
    if ($_POST['user_password'] === "admin") {
        $_SESSION['user_id'] = $_POST['user_id'];
        header("Location: ViewOrders.php");
    }
    else {
        $_SESSION['login_success'] = false;
        header("Location: login.php");
    }

}
else if (isset($_SESSION['user_id'])) {
    header("Location: ViewOrders.php");
}
else {
    if (isset($_SESSION['login_success']) && !($_SESSION['login_success'])){
        $warning = "User ID or Password is incorrect";
        unset($_SESSION['login_success']);
    }
    else {
        $warning = "";
        unset($_SESSION['login_success']);
    }

    $form = '
        <form action="login.php" method="post">
            <span style="color: red">' . $warning . '</span><br>
            <label for="user_id">User ID</label><br>
            <input id="user_id" type="text" name="user_id"><br>
            <label for="user_password">Password</label><br>
            <input id="user_password" type="password" name="user_password"><br><br>
            <input type="submit" value="Login">
        </form>
    ';
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
