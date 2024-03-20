<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}
else {
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
            <p class="fs-3 form-title">Logout</p>
            <p>You have successfully signed out</p>
            <a href="login.php"><button type="button" class="container-fluid btn btn-bd-primary">Return to Sign in</button></a>
        </div>       
        

        <!-- Required JavaScript -->
        <!-- Popper.js, then Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
        </body>
        </html>
    ';

    session_unset();
    session_destroy();

    echo $form;
}
?>
