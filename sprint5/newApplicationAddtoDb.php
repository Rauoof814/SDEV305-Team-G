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

    <!-- Custom CSS | TODO: make custom css file-->
    <link rel="stylesheet" href="./styles/contactForm.css">
    <title>New Application</title>
</head>
<body>
<!-- Navbar -->
<header class="site-navigation">
    <div class="container pb-5 mb-5">
        <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand fs-3" href="https://www.greenriver.edu/">
                    <img src="img/GRC-logo.png" class="img-responsive" alt="GRC LOGO" height="50">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText">
                    <span class="navbar-dark navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse fs-3" id="navbarText">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" href="dashboard.php">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="newApplicationForm.html">New Application</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contactForm.html">Contact</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="admin-dropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Admin
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item fs-5" href="adminDashboard.php">Admin Dashboard</a></li>
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
<div class="form-container">
    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    require '/home/gnocchig/attdb.php';

    if(isset($_POST["role"]) && $_POST["role"] != "" && isset($_POST["jobDescription"]) && $_POST["jobDescription"] != "" &&
        isset($_POST["date"]) && $_POST["date"] != "" && isset($_POST["status"]) && $_POST["status"] && isset($_POST["followUpDate"]) && $_POST["followUpDate"] != "")
    {
        $title = $_POST["role"];
        $jobUrl = $_POST["jobDescription"];
        $date = $_POST["date"];
        $updates = $_POST["updates"];
        $status = $_POST["status"];
        $followUpDate = $_POST["followUpDate"];

        // Display a confirmation message
        echo '<p class="fs-3 form-title">New Application Added</p>';
        echo '<p>Job Title: ' . $title . '</p>';
        echo '<p>Job Url: ' . $jobUrl . '</p>';
        echo '<p>Date: ' . $date . '</p>';

        if(!is_null($updates) && $updates != ""){
            echo '<p>Updates: ' . $updates . '</p>';
        }
        else{
            $updates = "No updates at this time.";
            echo "<p>Updates: $updates</p>";
        }
        echo '<p>Status: ' . $status . '</p>';
        echo '<p>Follow up on: ' . $followUpDate . '</p>';
        echo '<a href="adminDashboard.php"><button type=button class="btn btn-bd-primary">Admin Dashboard</button></a>';

        //add to database
        $sql = "INSERT INTO `applications` (`application_name`, `application_url`, `application_date`, `application_status`, `application_updates`, `application_followUp`) 
            VALUES ('$title', '$jobUrl', '$date', '$status', '$updates', '$followUpDate')";

        mysqli_query($cnxn, $sql);
    }
    else {
        // Display error message
        echo '<p class="fs-3 form-title">ERROR</p>';
        echo '<p>One or more fields in the new application form are empty.</p>';
        echo '<p>Please make sure to fill out all required fields.</p>';
        echo '<a href="newApplicationForm.html"><button type=button class="btn btn-bd-primary">Try again</button></a>';
    }
    ?>
</div>

<!-- JavaScript for Dark Mode toggle -->
<script src="scripts/script.js"></script>

<!-- Required JavaScript -->
<!-- Popper.js, then Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>
