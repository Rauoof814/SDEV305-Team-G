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
    <div class="container pb-5 mb-5">
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
                            <a class="nav-link active dropdown-toggle" id="admin-dropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Admin
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item fs-5" href="adminDashboard.php">Admin Dashboard</a></li>
                                <li><a class="dropdown-item active fs-5" href="adminAnnouncement.html">Admin Announcement</a></li>
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
        if (!empty($_POST) && !empty($_POST["announcementID"]) && !empty($_POST["title"]) && !empty($_POST["employmentType"]) && !empty($_POST["location"]) && !empty($_POST["employer"])  && !empty($_POST["moreInfo"])  && !empty($_POST["url"])) {
            $announcementID = $_POST["announcementID"];
            $announcementDate = $_POST['announcementDate'];
            $announcementTitle = $_POST['title'];
            $announcementJobType = $_POST['employmentType'];
            $announcementLocation = $_POST['location'];
            $announcementEmployer= $_POST['employer'];
            $announcementAdditionalInfo= $_POST['moreInfo'];
            $announcementURL = $_POST['url'];

            require '/home/gnocchig/attdb.php';
            /* create a prepared statement */
            $stmt = $cnxn->prepare("UPDATE `announcements` SET `announcement_date`=?, `announcement_title`=?, `announcement_job_type`=?, `announcement_location`=?, `announcement_employer`=?, `announcement_additional_info`=?, `announcement_url`=?  WHERE `announcement_id`=?");

            /* bind parameters for markers */
            $stmt->bind_param("ssssssss", $announcementDate, $announcementTitle, $announcementJobType, $announcementLocation, $announcementEmployer, $announcementAdditionalInfo, $announcementURL, $announcementID);

            // Execute the statement
            if ($stmt->execute()) {
                echo '<script>console.log("Record updated successfully")</script>';
            } else {
                echo "Error updating record: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();

            // Display a confirmation message
            echo '<p class="fs-3 form-title">Announcement Confirmed</p>';
            echo '<p>A preview of this announcement is below:</p>';
            echo '<p>Title: ' . $announcementTitle . '</p>';
            echo '<p>Employment Type: ' . $announcementJobType . '</p>';
            echo '<p>Location: ' . $announcementLocation . '</p>';
            echo '<p>Employer: ' . $announcementEmployer . '</p>';
            echo '<p>Additional Information: ' . $announcementAdditionalInfo . '</p>';
            echo '<p>URL: ' . $announcementURL . '</p>';
            echo '<a href="adminDashboard.php"><button type=button class="btn btn-bd-primary">Admin Dashboard</button></a>';

            $form = true;
        }
        else if (!empty($_POST) && !empty($_POST["announcementID"])) {
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

            $checkedJob = ($announcementJobType === "Job") ? "checked" : "";
            $checkedInternship = ($announcementJobType === "Internship") ? "checked" : "";

            $editForm = '
                <form name="adminAnnouncementForm" id="adminAnnouncementForm" action="adminAnnouncement.php" onsubmit="return validateAdminAnnounce()" method="post">
                    <p class="fs-3 form-title">Edit Announcement</p>

                    <label for="title">Announcement Title*<span id="titleWarning" style="color: red"></span></label>
                    <input type="text" id="title" name="title" value="' . $announcementTitle . '">

                    <label>Employment type*<span id="radioWarning" style="color: red"></span></label>
                    <div>
                        <label><input type="radio" name="employmentType" value="Job" ' . $checkedJob . '> Job</label>
                        <label><input type="radio" name="employmentType" value="Internship" ' . $checkedInternship . '> Internship</label>
                    </div>

                    <label for="location">Location*<span id="locationWarning" style="color: red"></span></label>
                    <input type="text" id="location" name="location" value="' .  $announcementLocation . '">
            
                    <label for="employer">Employer*<span id="employerWarning" style="color: red"></span></label>
                    <input type="text" id="employer" name="employer" value="' .  $announcementEmployer . '">
            
                    <label for="moreInfo">Additional Information*<span id="moreInfoWarning" style="color: red"></span></label>
                    <textarea id="moreInfo" name="moreInfo">' . $announcementAdditionalInfo . '</textarea>

                    <label for="url">Enter the job listings URL*<span id="urlWarning" style="color: red"></span></label>
                    <input type="url" id="url" name="url" placeholder="https://example.com" pattern="https://.*" size="30" value="' . $announcementURL . '">
                    
                    <input type="hidden" name="announcementID" value=' . $announcementID . '>
                    <input type="hidden" name="announcementDate" value=' . $announcementDate . '>
                    <input class="btn btn-bd-primary" type="submit" value="Save Changes">
                </form>
            ';

            echo $editForm;
        }
        //        TODO: add further validation to not accept any variation of "  " or single characters.
        else if (!empty($_POST) && !empty($_POST["title"]) && !empty($_POST["employmentType"]) && !empty($_POST["location"]) && !empty($_POST["employer"])  && !empty($_POST["moreInfo"])  && !empty($_POST["url"])){
            $announcementTitle = $_POST["title"];
            $announcementJobType = $_POST["employmentType"];
            $announcementLocation = $_POST["location"];
            $announcementEmployer = $_POST["employer"];
            $announcementAdditionalInfo = $_POST["moreInfo"];
            $announcementURL = $_POST["url"];
            $form = true; // send an email
            // Display a confirmation message
            echo '<p class="fs-3 form-title">Announcement Confirmed</p>';
            echo '<p>A preview of this announcement is below:</p>';
            echo '<p>Title: ' . $announcementTitle . '</p>';
            echo '<p>Employment Type: ' . $announcementJobType . '</p>';
            echo '<p>Location: ' . $announcementLocation . '</p>';
            echo '<p>Employer: ' . $announcementEmployer . '</p>';
            echo '<p>Additional Information: ' . $announcementAdditionalInfo . '</p>';
            echo '<p>URL: ' . $announcementURL . '</p>';
            echo '<a href="adminDashboard.php"><button type=button class="btn btn-bd-primary">Admin Dashboard</button></a>';

            // Insert row into DB
            require '/home/gnocchig/attdb.php';
            // set date
            date_default_timezone_set('America/Los_Angeles');
            $announcementDate = date('Y-m-d');
            // open a statement
            $stmt = $cnxn->prepare("INSERT INTO `announcements` (`announcement_date`, `announcement_title`, `announcement_job_type`, `announcement_location`, `announcement_employer`, `announcement_additional_info`, `announcement_url`) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssss", $announcementDate, $announcementTitle, $announcementJobType, $announcementLocation, $announcementEmployer, $announcementAdditionalInfo, $announcementURL);
            // Execute the statement
            if ($stmt->execute()) {
                echo '<script>console.log("Record updated successfully")</script>';
            } else {
                echo "Error updating record: " . $stmt->error;
            }
            // Close the statement
            $stmt->close();
        }
        else {
            $form = false; // dont send an email
            // Display error message
            echo '<p class="fs-3 form-title">ERROR</p>';
            echo '<p>One or more fields in the announcement form are empty.</p>';
            echo '<p>Please make sure to fill out all required fields.</p>';
            echo '<a href="adminAnnouncement.html"><button type=button class="btn btn-bd-primary">Try again</button></a>';
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
    require '/home/gnocchig/attdb.php';
    $sql = "SELECT `user_email`FROM `users`;";
    $result = @mysqli_query($cnxn, $sql);
    while ($row = mysqli_fetch_assoc($result))
    {
        $to = $row['user_email'];
        $emailSubject = "New announcement: " . $announcementTitle;
        $body = '
            <html>
            <head>
            <title>HTML email</title>
            </head>
            <body>
            <p>Title: ' . $announcementTitle . '</p>
            <p>Employment Type: ' . $announcementJobType . '</p>
            <p>Location: ' . $announcementLocation . '</p>
            <p>Employer: ' . $announcementEmployer . '</p>
            <p>Additional Information: ' . $announcementAdditionalInfo . '</p>
            <p>URL: ' . $announcementURL . '</p>
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
}
?>