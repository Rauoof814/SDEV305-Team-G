<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="./global.css">
    <link rel="stylesheet" href="./styles/dashboard.css">
    <link rel="stylesheet" href="./styles/AdminDashboard.css">
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
                            <a class="nav-link" href="newApplicationForm.html">New Application</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contactForm.html">Contact</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link active dropdown-toggle" id="admin-dropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Admin
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item active fs-5" href="adminDashboard.php">Admin Dashboard</a></li>
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

<!-- Main content -->
<main class="site-content">
    <div class="container">
        <br>
        <!-- Applications & Reminders -->
        <div class="row mb-3 g-3">
            <!-- Applications panel -->
            <div class="col-md-8 applications">
                <p class="fs-2 heading">Recent Applications</p>
                <div class="overflow-y-scroll overflow-x-auto applications-list" style="height: 300px">
                    <table class="table">
                        <thead>
                            <tr>
                                <td scope="col">ID</td>
                                <td scope="col">Date</td>
                                <td scope="col">Title</td>
                                <td scope="col">Status</td>
                                <td scope="col">Manage</td>
                            </tr>
                        </thead>
                        <tbody>
                        <!-- Display applications from DB onto dashboard table -->
                        <!-- TODO: Make scrollbar less ugly -->
                        <?php
                       require '/home/gnocchig/attdb.php';
                        $sql = "SELECT * FROM applications ORDER BY `application_date` DESC";
                        $result = @mysqli_query($cnxn, $sql);
                        while ($row = mysqli_fetch_assoc($result))
                        {
                            $appID = $row['application_id'];
                            $appName = $row['application_name'];
                            $appURL = $row['application_url'];
                            $appDate = $row['application_date'];
                            $appStatus = $row['application_status'];
                            $appUpdates = $row['application_updates'];
                            $appFollowUp= $row['application_followUp'];

                            $row = '
                            <tr>
                                <td> ' . $appID . '</td>
                                <td> ' . $appDate . '</td>
                                <td> ' . $appName . '</td>
                                <td> ' . $appStatus . '</td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">           
                                    <a href="edit_app.php?id=' . $appID . '" class="btn btn-bd-primary btn-width">Update</a>
                                    <a class="btn btn-danger btn-width" style="padding-top: 2px; padding-bottom: 0px;">
                                    <form method="post" action="delete_application.php">
                                        <input type="hidden" name="application_id" value="' . $appID . '">
                                        <button type="submit" id="delete_application" name="delete_application">Delete</button>
                                    </form>
                                    </a>
                                </div>
                                </td>
                            </tr>
                            ';
                            echo $row;
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
                <a class="container-fluid btn btn-link" href="#" role="button">See all Applications</a>
            </div>
            <!-- Reminders panel -->
            <!-- TODO: Fix view button spacing -->
            <div class="col-md-4 reminders">
                <p class="fs-2 heading">Recent Announcements</p>
                <div class="overflow-y-scroll announcements-list" style="height: 300px">
                    <!-- Display announcements from DB onto dashboard -->
                    <!-- TODO: Make scrollbar less ugly -->
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
                                    <form action="adminAnnouncement.php" method="post">
                                        <text class="d-inline-block text-truncate announcement-message"> ' . $announcementTitle . '</text>
                                        <input type="hidden" name="announcementID" value=' . $announcementID . '>
                                        <button type="submit" class="btn btn-bd-primary btn-sm float-end">View</button>
                                    </form>
                                </p>
                            </div>
                            ';
                        echo $row;
                    }

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
                    <a class="container-fluid btn btn-link all-announcements" href="#" role="button">See All Announcements</a>
                </div>
            </div>
        </div>
        <!-- User Section -->
        <div class="mt-3">
            <p class="fs-2 heading">Users</p>
            <div class="overflow-y-scroll overflow-x-auto applications-list" style="height: 350px">
                <table class="table users-table">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Name</td>
                            <td>Email</td>
                            <td>Cohort</td>
                            <td>Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                    <!-- Display users from DB onto dashboard table -->
                    <!-- TODO: Display a max of 6 users or add scrollbar -->
                    <?php
                   require '/home/gnocchig/attdb.php';
                    $sql = "SELECT * FROM users";
                    $result = @mysqli_query($cnxn, $sql);
                    while ($row = mysqli_fetch_assoc($result))
                    {
                        $userID = $row['user_id'];
                        $fname = $row['user_first'];
                        $lname = $row['user_last'];
                        $email = $row['user_email'];
                        $cohort = $row['user_cohort'];
                        $jobStatus = $row['user_job_status'];

                        $row = '
                            <tr>
                                <td> ' . $userID . '</td>
                                <td> ' . $fname . ' ' . $lname . '</td>
                                <td> ' . $email . '</td>
                                <td> ' . $cohort . '</td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <button type="button" class="btn btn-bd-primary btn-width">View</button>
                                        <button type="button" class="btn btn-danger btn-width">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        ';

                        echo $row;
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
        <br>
        <!-- Site info -->
        <hr>
        <p class=" fs-5 text-center rounded site-information">
            Welcome to the Green River College Software Development Application Tracking Tool (ATT). 
            The purpose of this tool is to provide a centralized place to track your job/internship 
            applications that can be helpful in your application journey!
        </p>
        <br>
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
                    <img src="img/Auburn-Center-building-exterior.jpg" class="img-fluid rounded mx-auto d-block auburnCenter">
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>