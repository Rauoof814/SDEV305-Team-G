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
<body class="pt-5">
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
<div class="form-container mt-5">
    <h2>New Application Info</h2>
    <?php
        require '/home/gnocchig/attdb.php';
        if ($_SERVER['REQUEST_METHOD'] == "POST")
        {
            $appID = trim($_POST['application_id']);
            $appName = trim($_POST['application_name']);
            $appURL = trim($_POST['application_url']);
            $appDate = trim($_POST['application_date']);
            $appStatus = trim($_POST['application_status']);
            $appUpdates = trim($_POST['application_updates']);
            $appFollowUp = trim($_POST['application_followUp']);

            // Prepare the SQL UPDATE query
            $update_sql = "UPDATE applications 
                            SET `application_name` = '$appName', 
                                `application_url` = '$appURL', 
                                `application_date` = '$appDate', 
                                `application_status` = '$appStatus', 
                                `application_updates` = '$appUpdates',
                                `application_followUp` = '$appFollowUp'
                            WHERE `application_id` = '$appID'";

            // Execute the update
            mysqli_query($cnxn, $update_sql);

            // handling Null inputs
            if (!empty($appName) && !empty($appURL) && !empty($appDate) && !empty($appStatus) && !empty($appFollowUp)) {

                // Display a confirmation message
                echo '<p>Job Title: ' . $appName . '</p>';
                echo '<p>Job Url: ' . $appURL . '</p>';
                echo '<p>Date: ' . $appDate . '</p>';
                echo '<p>Status: ' . $appStatus . '</p>';
                echo '<p>Updates: ' . $appUpdates . '</p>';
                echo '<p>Follow up on: ' . $appFollowUp . '</p>';
                echo '<a href="dashboard.php" class="btn btn-success">Back to Dashboard</a>';

//                echo "
//                            <div>
//
//
//                                 <h2>
//                                Edit Application Reciept</h2>
//                                <hr>
//
//                                    <h2>Name of Role: </h2>
//                                    <h2 class='result'>" . htmlspecialchars($appName) . "</h2>
//
//                                    <h2>Job Description URL: </h2>
//                                    <h3 class='result text-truncate'>" . htmlspecialchars($appURL) . "</h3>
//
//                                    <h2 class='key'>Date of Application: </h2>
//                                    <h2 class='result'>" . htmlspecialchars($appDate) . "</h2>
//
//                                    <h2 class='key'>Status: </h2>
//                                    <h2 class='result'>" . htmlspecialchars($appStatus) . "</h2>
//
//
//                                    <h2>Updates: </h2>
//                                    <h3 class='result'>" . htmlspecialchars($appUpdates) . "</h3>
//
//
//                                    <h2 class='key'>Follow-up Date :</h2>
//                                    <h2 class='result'>" . htmlspecialchars($appFollowUp) . "</h2>
//                            </div>";
//

                // Email delivery
                // tschrock@greenriver.edu
        //        $to = "rahmaniabdul@icloud.com";
        //        $subject = "Application Updates: ".$appName."!";
        //        $message = "
        //                    <html>
        //                        <head>
        //                            <title>Changes and Updatestitle>
        //                        </head>
        //                        <body>
        //                            <p>Hope this email finds you well!</p>
        //                            <table>
        //                                <tr>
        //                                    <th>Name of the Role</th>
        //                                    <th>Job Description URL</th>
        //                                    <th>Date of Application</th>
        //                                    <th>Status</th>
        //                                    <th>Updates</th>
        //                                    <th>Follow up Date</th>
        //                                </tr>
        //                                <tr>
        //                                    <td>$appName</td>
        //                                    <td>$appURL</td>
        //                                    <td>$appDate</td>
        //                                    <td>$appStatus</td>
        //                                    <td>$appUpdates</td>
        //                                    <td>$appFollowUp</td>
        //                                </tr>
        //                            </table>
        //                        </body>
        //                    </html>
        //                ";
        //
        //        // Always set content-type when sending HTML email
        //        $headers = "MIME-Version: 1.0" . "\r\n";
        //        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        //
        //        // More headers
        //        $headers .= 'From: <anymail@web.com>' . "\r\n";
        //        $headers .= 'Cc: myself@yourself.com' . "\r\n";
        //
        //        mail($to,$subject,$message,$headers);
            }
            else
            {
                echo "<h2>Error! make sure you fill out the form properly. Thank you!</h2> ";
            }
        } else
        {
            echo "<h2>Error Processing Request</h2>";
        }
    ?>
</body>
<!-- JavaScript for Dark Mode toggle -->
<script src="./scripts/script.js"></script>
<!-- Required JavaScript -->
<!-- Popper.js, then Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>    </body>
</html>