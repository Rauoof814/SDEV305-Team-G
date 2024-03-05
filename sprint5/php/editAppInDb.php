<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Global CSS -->
    <link rel="stylesheet" href="../styles/global.css">

    <!-- Custom CSS | TODO: make custom css file-->
    <link rel="stylesheet" href="../styles/contactForm.css">
    <title>New Application</title>
</head>
<body>
<!-- Navbar -->
<header class="site-navigation">
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand fs-3" href="dashboard.php">GRC ATT</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText">
                    <span class="navbar-dark navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse fs-3" id="navbarText">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard.php">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../html/newApplicationForm.html">New Application</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../html/contactForm.html">Contact</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link active dropdown-toggle" id="admin-dropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Admin
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item fs-5" href="adminDashboard.php">Admin Dashboard</a></li>
                                <li><a class="dropdown-item active fs-5" href="../html/adminAnnouncement.html">Admin Announcement</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="../html/signUpForm.html"><button type="button" class="btn btn-bd-primary signUp">Sign Up</button></a>
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
        $title = $_POST["application_name"];
        $jobUrl = $_POST["job_description_url"];
        $date = $_POST["application_date"];
        $updates = $_POST["application_updates"];
        $status = $_POST["application_status"];
        $followUpDate = $_POST["application_followUp"];
        $id = $_POST['application_id'];

        // Display a confirmation message
        displayConfirmation($title, $jobUrl, $date, $updates, $status, $followUpDate);

        //add new application info to database
        addToDatabase($title, $jobUrl, $date, $updates, $status, $followUpDate, $id);

        // Display error message
        echo '<p class="fs-3 form-title">ERROR</p>';
        echo '<p>One or more fields in the new application form are empty.</p>';
        echo '<p>Please make sure to fill out all required fields.</p>';
        echo '<a href="../html/newApplicationForm.html"><button type=button class="btn btn-bd-primary">Try again</button></a>';

    function displayConfirmation($title, $jobUrl, $date, $updates, $status, $followUpDate){
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
        echo '<a href="adminDashboard.html"><button type=button class="btn btn-bd-primary">Admin Dashboard</button></a>';
    }

    function addToDatabase($title, $jobUrl, $date, $updates, $status, $followUpDate, $id){
        require '/home/gnocchig/attdb.php';

        $sql = "UPDATE `applications` 
                SET application_name= $title, application_url = $jobUrl, application_date = $date, application_status = $status, application_updates = $updates, application_followUp = $followUpDate
                WHERE application_id = $id;";
        require '/home/gnocchig/attdb.php';

        mysqli_query($cnxn, $sql);
    }
    ?>
</div>

<!-- JavaScript for Dark Mode toggle -->
<script src="../scripts/script.js"></script>

<!-- Required JavaScript -->
<!-- Popper.js, then Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>
