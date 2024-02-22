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
                <nav class="navbar navbar-expand-lg bg-body-tertiary">
                    <div class="container-fluid">
                        <a class="navbar-brand fs-3" href="dashboard.html">GRC ATT</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText">
                            <span class="navbar-dark navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse fs-3" id="navbarText">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link active" href="dashboard.html">Dashboard</a>
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
                                        <li><a class="dropdown-item fs-5" href="adminAnnouncement.php">Admin Announcement</a></li>
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
                        <div class="overflow-y-scroll overflow-x-auto applications-list" style="height: 230px">
                            <table class="table">
                                <thead>
                                <tr>
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
                                        <td> ' . $appDate . '</td>
                                        <td> ' . $appName . '</td>
                                        <td> ' . $appStatus . '</td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <button type="button" class="btn btn-bd-primary btn-width">Update</button>
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
                        <a class="container-fluid btn btn-link" href="#" role="button">Show more Applications</a>
                    </div>
                    <!-- Reminders panel -->
                    <!-- TODO: Fix view button spacing -->
                    <div class="col-md-4 reminders">
                        <p class="fs-2 heading">Reminders</p>
                        <div class="container-fluid rounded reminder-content">
                            <p>
                                <text class="reminder-message">Follow Up with XYZ</text>
                                <button type="button" class="btn btn-bd-primary btn-sm float-end">View</button>
                            </p>
                        </div>
                        <div class="container-fluid rounded reminder-content">
                            <p>
                                <text class="reminder-message">3 Incomplete Apps</text>
                                <button type="button" class="btn btn-bd-primary btn-sm float-end">View</button>
                            </p>
                        </div>
                        <div class="container-fluid rounded reminder-content" style="min-height: 51px">
                            <a class="container-fluid btn btn-link more-opportunities" href="#" role="button">Find More Opportunities</a>
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
                    <div class="col-4">
                        <div class="gap-2 col-12 mx-auto">
                            <a class="container-fluid btn btn-link" href="#" role="button">Account Settings</a>
                        </div> 
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
                <!-- About & resources -->
                <div class="row mb-3 g-3">
                    <!-- Resources -->
                    <div class="col-md-4 resources">
                        <p class="fs-2 heading">Resources</p>
                        <p>Utilize these resources to help your job search!</p>
                        <ul class="resource-links">
                            <li class="list-group-item mb-2">
                                <a href="https://linkedin.com" target="_blank">
                                    <img src="./img/LI-Logo.png" style="height: 25px;">
                                </a>
                            </li>
                            <li class="list-group-item mb-2">
                                <a href="https://indeed.com" target="_blank">
                                    <img src="./img/Indeed_Logo_RGB.png" style="height: 25px;">
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
                                <img src="img/Auburn-Center-building-exterior.jpg" class="img-fluid rounded mx-auto d-block auburnCenter">
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