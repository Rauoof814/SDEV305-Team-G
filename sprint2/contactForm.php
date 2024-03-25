<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Global CSS -->
    <link rel="stylesheet" href="global.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="./styles/contactForm.css">
    <title>Contact</title>
</head>
<body>
<!-- Navbar -->
<header class="site-navigation">
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand fs-3" href="dashboard.html">GRC ATT</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText">
                    <span class="navbar-dark navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse fs-3" id="navbarText">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard.html">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="newApplicationForm.html">New Application</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="contactForm.html">Contact</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="admin-dropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Admin
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item fs-5" href="adminDashboard.html">Admin Dashboard</a></li>
                                <li><a class="dropdown-item fs-5" href="adminAnnouncement.html">Admin Announcement</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="signUpForm.html"><button type="button" class="btn btn-bd-primary signUp">Sign Up</button></a>
                            <button type="button" class="btn btn-bd-primary signUp dark-mode-btn" onclick="toggleDarkMode()">Toggle Dark Mode</button>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>
<main>
    <div class="form-container">
        <?php
//        TODO: add further validation to not accept any variation of "  " or single characters.
        if (!empty($_POST) && !empty($_POST["name"]) && !empty($_POST["email"]) && !empty($_POST["subject"]) && !empty($_POST["message"])){
            $name = $_POST["name"];
            $email = $_POST["email"];
            $subject = $_POST["subject"];
            $message = $_POST["message"];
            $form = true; // send an email
            // Display a confirmation message
            echo '<p class="fs-3 form-title">Thank you, ' . $name . '!</p>';
            echo '<p>We have received your message and will get back to you within 24 hours.</p>';
            echo '<p>A copy of your message has been sent to: ' . $email . '</p>';
            echo '<p class="fst-italic">"Subject: ' . $subject . '<p class="fst-italic">Message: ' . $message . '"</p></p>';
            echo '<a href="dashboard.php"><button type=button class="btn btn-bd-primary">Dashboard</button></a>';
        }
        else {
            $form = false; // dont send an email
            // Display error message
            echo '<p class="fs-3 form-title">ERROR</p>';
            echo '<p>One or more fields in the contact form are empty.</p>';
            echo '<p>Please make sure to fill out all required fields.</p>';
            echo '<a href="contactForm.html"><button type=button class="btn btn-bd-primary">Try again</button></a>';
        }
        ?>
    </div>
</main>

<!-- JavaScript for Dark Mode toggle -->
<script src="scripts/script.js"></script>
<!-- Required JavaScript -->
<!-- Popper.js, then Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>

<!--  email php  -->
<!--  TODO: define email styling  -->
<?php
if ($form) {
    $to = $email;
    $emailSubject = "RE: " . $subject;
    $body = '
        <html>
        <head>
        <title>HTML email</title>
        </head>
        <body>
        <p>Hello  ' . $name . ', </p>
        <p>Thank you for reaching out to us! We appreciate your input.</p>
        <p>One of our agents will get back to you within 24 hours.</p>
        <br>
        <p>A copy of your message can be seen below.</p>
        <hr>
        <p>Subject: ' . $subject  . '</p>
        <p>Message: ' . $message . '</p>
        </body>
        </html>
    ';

// Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers | sender email
    $headers .= 'From: <gnocchig@gnocchi.greenriverdev.com>' . "\r\n";

    mail($to,$emailSubject,$body,$headers);
}

?>
