<?php
session_start();
if (!empty($_POST) && !empty($_POST['email']) && !empty($_POST['password'])) {
    // db connection
    require '/home/gnocchig/attdb.php';

    // assign variables
    $username = $_POST['email'];
    $secret = $_POST['password'];

    // create a prepared statement
    $stmt = $cnxn->prepare("SELECT `user_password_hash`, `user_id` FROM `users` WHERE `user_email`=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($hash, $userID);
    $stmt->fetch();
    $stmt->close();

    // check if result is null
    if (!is_null($hash) && !is_null($userID)) {
        // verify result
        if (password_verify($secret, $hash)) {
            // set session variables
            $_SESSION['user_id'] = $userID;
            // unset login status
            if(isset($_SESSION['login_status'])) {
                unset($_SESSION['login_status']);
            }
            // redirect to dashboard
            //header("Location: https://gnocchi.greenriverdev.com/sprint5/dashboard.php");
            echo '<meta http-equiv="refresh" content="0;url=adminDashboard.php">';
        }
        else {
            $_SESSION['login_status'] = 0; // incorrect email or password
            // redirect to login
            //header("Location: https://gnocchi.greenriverdev.com/sprint5/login.php");
            echo '<meta http-equiv="refresh" content="0;url=admin.php">';
        }
    }
    else {
        $_SESSION['login_status'] = 1; // email not found
        // redirect to login
        //header("Location: https://gnocchi.greenriverdev.com/sprint5/login.php");
        echo '<meta http-equiv="refresh" content="0;url=admin.php">';
    }
}
else if (isset($_SESSION['user_id'])) {
    header("Location: adminDashboard.php");
}
else {
    // declare warning message
    $warning = "";
    // determine warning message
    if (isset($_SESSION['login_status'])) {
        switch ($_SESSION['login_status']) {
            case 0:
                $warning = "*Email or password is incorrect";
                break;
            case 1:
                $warning = "*Email not associated with an account";
                break;
            case 2:
                $warning = "*Account requires elevation";
                break;
            default:
        }
    }
    // login form
    $form = '
        <!doctype html>
        <html lang="en">
        <head>
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
        
            <!-- Bootstrap CSS -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        
            <!-- Global CSS -->
            <link rel="stylesheet" href="global.css">
            <link rel="stylesheet" href="./styles/login.css">
            <title>Form Template</title>
        </head>
        <body>
        <!-- Form -->
        <div class="container-fluid" id="login-container">
            <form action="admin.php" method="post">
                <p class="fs-3 form-title">Admin Login</p>
        
                <label for="email"><span style="color: red">' . $warning . '</span></label>
                <input type="text" id="email" name="email" placeholder="Email" value="" required>
        
                <label for="password"></label>
                <input type="password" id="password" name="password" placeholder="Password" value="" required>
        
                <input class="container-fluid btn btn-bd-primary" id="sign-in" type="submit" value="Sign in">
            </form>
        </div>       
        

        <!-- Required JavaScript -->
        <!-- Popper.js, then Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
        </body>
        </html>
    ';
    echo $form;
}
?>

