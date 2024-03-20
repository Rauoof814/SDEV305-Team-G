<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    echo '<meta http-equiv="refresh" content="0;url=login.php">';
}
else {
    // db connection
    require '/home/gnocchig/attdb.php';

    // assign variables
    $userID = $_SESSION['user_id'];

    // create a prepared statement
    $stmt = $cnxn->prepare("SELECT `is_admin` FROM `users` WHERE `user_id`=?");
    $stmt->bind_param("s", $userID);
    $stmt->execute();
    $stmt->bind_result($isAdmin);
    $stmt->fetch();

    // verify admin status
    if ($isAdmin) {
        $_SESSION['is_admin'] = true;
    }
    else {
        $_SESSION['is_admin'] = false;
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <!-- TODO -->
    <!-- Fix table - not working on mobile -->

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Global CSS -->
    <link rel="stylesheet" href="./global.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="./styles/dashboard.css">
    <title>Dashboard</title>
</head>
<body>
<!-- Navbar -->
<header class="site-navigation">
    <div class="container">
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
                                    <a href="logout.php"><button type="button" class="btn btn-bd-primary signUp">Sign out</button></a>
                                    <button type="button" class="btn btn-bd-primary signUp dark-mode-btn" onclick="toggleDarkMode()">Toggle Dark Mode</button>
                                </li>
                            </ul>
                </div>
            </div>
        </nav>
    </div>
</header>

<!-- Main content -->
<main class="site-content">
    <div class="container pt-5 mt-5">
        <br>
        <!-- Applications & Reminders -->
        <div class="row mb-3 g-3">
            <!-- Applications panel -->
            <div class="col-md-8 applications border-end border-dark">
            <p class="fs-2 heading border-bottom">Recent Applications</p>
            
            <!-- Sorting dropdown -->
            <form method="GET" action="dashboard.php">
                <div class="input-group mb-3">
                    <select class="form-select" name="sort">
                        <option value="date">Sort by Date</option>
                        <option value="name">Sort by Name</option>
                    </select>
                    <button class="btn btn-outline-secondary" type="submit">Sort</button>
                </div>
            </form>

            <div class="overflow-y-scroll overflow-x-auto applications-list" style="height: 230px">
                <table class="table">
                    <thead class="sticky-top">
                        <tr class="border-bottom border-dark">
                            <th scope="col">Date</th>
                            <th scope="col">Title</th>
                            <th scope="col">Status</th>
                            <th scope="col">Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Display sorted applications -->
                        <?php
                        //session_start();

                     require '/home/gnocchig/attdb.php';

                        // Initialize $sort variable
                        $sort = "";

                        // Check if sorting criterion is provided
                        if(isset($_GET['sort'])) {
                            $sort = $_GET['sort'];
                        }

                        // Prepare the SQL query based on sorting criterion
                        switch($sort) {
                            case "date":
                                $sql = "SELECT * FROM `applications` WHERE `is_deleted` = 0 ORDER BY `application_date` DESC";
                                break;
                            case "name":
                                $sql = "SELECT * FROM applications WHERE `is_deleted` = 0 ORDER BY `application_name` ASC";
                                break;
                            default:
                                $sql = "SELECT * FROM applications WHERE `is_deleted` = 0 ORDER BY `application_date` DESC";
                        }

                        $result = mysqli_query($cnxn, $sql);

                        // Check if result is not empty
                        if(mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                // Output the application data
                                $appID = $row['application_id'];
                                $appName = $row['application_name'];
                                $appURL = $row['application_url'];
                                $appDate = $row['application_date'];
                                $appStatus = $row['application_status'];
                                $appUpdates = $row['application_updates'];
                                $appFollowUp = $row['application_followUp'];
                                $row = '
                                    <tr>
                                        <td> ' . $appDate . '</td>
                                        <td> ' . $appName . '</td>
                                        <td> ' . $appStatus . '</td>
                                        <td>
                                            <div class="btn-group" role="group">       
                                                <form action="edit_app.php" method="post">
                                                    <a href="edit_app.php? id=' . $appID . '" class="btn btn-primary">Update</a>
                                                </form>
                                                <form method="post" action="deleteApplication.php">
                                                    <input type="hidden" name="delete_application" value="' . $appID . '">
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm(\'Are you sure you want to delete this application?\');">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                ';
                                echo $row;
                            }
                        } else {
                            // Output a message if no applications found
                            echo "<tr><td colspan='4'>No applications found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
                <a class="container-fluid btn btn-link" href="allApplications.php" role="button">Show more Applications</a>
            </div>
            <!-- Reminders panel -->
            <!-- TODO: Fix view button spacing -->
            <div class="col-md-4 reminders">
                <p class="fs-2 heading border-bottom">Reminders</p>
                <div class="overflow-y-scroll announcements-list border-left" style="height: 300px">
                    <!-- Display announcements from DB onto dashboard -->
                    <!-- TODO: Make scrollbar less ugly -->
                    <h5 class="text-decoration-underline">Recent Announcements</h5>
                    <?php
                 require '/home/gnocchig/attdb.php';
                    $sql = "SELECT * FROM announcements WHERE `announcement_date` BETWEEN DATE(NOW() - INTERVAL 5 DAY) AND NOW() ORDER BY `announcement_date` DESC";
                    $result = @mysqli_query($cnxn, $sql);
                    while ($row = mysqli_fetch_assoc($result))
                    {
                        $announcementID = $row['announcement_id'];
                        $announcementDate = $row['announcement_date'];
                        $announcementTitle = $row['announcement_title'];
                        $announcementJobType = $row['announcement_job_type'];
                        $announcementLocation = $row['announcement_location'];
                        $announcementEmployer= $row['announcement_employer'];
                        $announcementAdditionalInfo= $row['announcement_additional_info'];
                        $announcementURL = $row['announcement_url'];

                        $row = '
                                    <div class="container-fluid rounded announcement-content" style="padding-bottom: 9px">
                                        <p style="margin-bottom: 10px">                                   
                                            <form action="announcement.php" method="post">
                                                <text class="d-inline-block text-truncate announcement-message"> ' . $announcementTitle . '</text>
                                                <input type="hidden" name="announcementID" value=' . $announcementID . '>
                                                <button type="submit" class="btn btn-bd-primary btn-sm float-end">View</button>
                                            </form>
                                        </p>
                                    </div>
                                    ';
                        echo $row;
                    }
                    echo '<h5 class="text-decoration-underline">Follow-Up</h5>';


                    // display follow up reminders
                    $sql = "SELECT * FROM `applications` WHERE `application_followUp` BETWEEN DATE(NOW() - INTERVAL 5 DAY) AND DATE(NOW() + INTERVAL 5 DAY)";
                    $result = @mysqli_query($cnxn, $sql);
                    while ($row = mysqli_fetch_assoc($result))
                    {
                        $applicationID = $row['application_id'];
                        $applicationName = $row['application_name'];

                        $row = '
                                <div class="container-fluid rounded announcement-content">
                                    <p style="margin-bottom: 10px">
                                        <text class="d-inline-block text-truncate announcement-message" id="truncated-text"> Follow up with ' . $applicationName . '</text>
                                        <button type="button" class="btn btn-bd-primary btn-sm float-end">View</button>
                                    </p>
                                </div>
                                ';
                        echo $row;
                    }
                    ?>
                </div>
                <div class="container-fluid see-all-announcements" style="min-height: 51px">
                    <a class="container-fluid btn btn-link all-announcements" href="allAnnouncements.php" role="button">See All Announcements</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Application and account buttons -->
    <div class="row">
        <div class="col-4"></div>
        <div class="col-4">
            <div class="d-grid gap-2 col-12 mx-auto">
                <a href="newApplicationForm.html"><button class="btn btn-bd-accent-blue" type="button">Add a New Application</button></a>
            </div>
        </div>
    </div>
    <br>
    <!-- Site info -->
    <hr>
    <div class="footer text-light px-2" style="background-color: #333333">
        <p class=" fs-5 text-center rounded site-information">
            Welcome to the Green River College Software Development Application Tracking Tool (ATT).
            The purpose of this tool is to provide a centralized place to track your job/internship
            applications that can be helpful in your application journey!
        </p>
        <br>
        <!-- About & resources -->
        <div class="row mb-3 g-3">
            <!-- Resources -->
            <div class="col-md-4 resources">
                <p class="fs-2 heading">Resources</p>
                <p>Utilize these resources to help your job search!</p>
                <ul class="resource-links">
                    <li class="list-group-item mb-2">
                        <a href="https://linkedin.com" target="_blank">
                            <img src="img/LI-Logo.png" style="height: 25px;" alt="Linkedin">
                        </a>
                    </li>
                    <li class="list-group-item mb-2">
                        <a href="https://indeed.com" target="_blank">
                            <img src="img/Indeed_Logo_RGB.png" style="height: 25px;" alt="Indeed">
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="https://devs.greenrivertech.net/" target="_blank">Green River Devs</a>
                    </li>
                </ul>
            </div>
            <!-- About -->
            <div class="col-md-8 about">
                <div class="row">
                    <div class="col-7">
                        <p class="fs-2 heading">About Us</p>
                        <p>
                            The GRC Software Development program is an excellent way to prepare for a career in tech.
                            Through its affordable tuition, caring instructors, and thoughtfully curated curriculum,
                            you will be able to achieve whatever you set out to become.
                        </p>
                    </div>
                    <div class="col-4 gx-4 gy-4">
                        <img src="img/Auburn-Center-building-exterior.jpg" class="img-fluid rounded mx-auto d-block auburnCenter" alt="Auburn Center">
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- JavaScript for Dark Mode toggle -->
<script src="./scripts/script.js"></script>
<!-- Required JavaScript -->
<!-- Popper.js, then Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>    </body>
</html>