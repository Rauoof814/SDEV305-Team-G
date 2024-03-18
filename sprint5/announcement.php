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
    <title>Admin Announcement</title>
</head>
<body>
<!-- Navbar -->
<header class="site-navigation">
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
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
                            <a class="nav-link" href="newApplicationForm.html">New Application</a>
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
<main>
    <div class="form-container">
        <?php
        if (!empty($_POST) && !empty($_POST["announcementID"])) {
            $announcementID = $_POST["announcementID"];
           require '/home/gnocchig/attdb.php';
            $sql = "SELECT * FROM `announcements` WHERE `announcement_id` = $announcementID;";
            $result = @mysqli_query($cnxn, $sql);
            while ($row = mysqli_fetch_assoc($result))
            {
                $announcementDate = $row['announcement_date'];
                $announcementTitle = $row['announcement_title'];
                $announcementJobType = $row['announcement_job_type'];
                $announcementLocation = $row['announcement_location'];
                $announcementEmployer = $row['announcement_employer'];
                $announcementAdditionalInfo = $row['announcement_additional_info'];
                $announcementURL = $row['announcement_url'];
            }
            // Display announcement
            echo '<p class="fs-3 form-title">View Announcement</p>';
            echo '<p>Date: ' . $announcementDate . '</p>';
            echo '<p>Title: ' . $announcementTitle . '</p>';
            echo '<p>Employment Type: ' . $announcementJobType . '</p>';
            echo '<p>Location: ' . $announcementLocation . '</p>';
            echo '<p>Employer: ' . $announcementEmployer . '</p>';
            echo '<p>Additional Information: ' . $announcementAdditionalInfo . '</p>';
            echo '<p>URL: ' . $announcementURL . '</p>';
            echo '<a href="dashboard.php"><button type=button class="btn btn-bd-primary">Dashboard</button></a>';
        }
        else {
            // Display error message
            echo '<p class="fs-3 form-title">ERROR</p>';
            echo '<p>Announcement was unable to be retrieved.</p>';
            echo '<p>Please try again from the dashboard.</p>';
            echo '<p>If this issue persists, please contact us.</p>';
            echo '<a href="dashboard.php"><button type=button class="btn btn-bd-primary">Dashboard</button></a>';
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