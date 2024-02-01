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
    <link rel="stylesheet" href="./styles/signUpForm.css">
    <title>Sign Up Form</title>
</head>

<body>
<!-- Navbar -->
<header class="site-navigation">
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand fs-3" href="dashboard.html">GRC ATT</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText">
                    <span class="navbar-toggler-icon"></span>
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
                            <a class="nav-link" href="contactForm.html">Contact</a>
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

<!--form handling for sign up form-->
<?php
    if(isset($_POST["fName"]) && isset($_POST["lName"]) && isset($_POST["email"]) && isset($_POST["cohort-number"]) && isset($_POST["jobStage"])
        && $_POST["fName"] != "" && $_POST["lName"] != "" & $_POST["email"] != "" && $_POST["cohort-number"] && $_POST["jobStage"] != ""){

        //string together results message
        $results = compileUserInput();

        //send email of results. Replace with tschrock@greenriver.edu when ready
        sendConfirmationEmail($results, $_POST["email"]);

        //display results on page
        echo $results;
    }
    else{
        echo "<p class='text-danger'>*Please fill out form completely and submit again</p>";
    }

    function compileUserInput(){
        $results = "<div class='form-container pt-0'>
            <h1 class='pt-5 header-text'>Welcome!</h1>
            <h4>Your account information:</h4><br/>
            <p>First name: " . $_POST["fName"] . "</p>
            <p>Last name: " . $_POST["lName"] . "</p>
            <p>Email: " . $_POST["email"] . ".</p>
            <p>Cohort number: " . $_POST["cohort-number"] . "</p>
            <p>What are you seeking?: " . $_POST["jobStage"] . " </p>";

        if(isset($_POST["notes"]) && $_POST["notes"] != "") {
            $results .= "<p> Any additional roles: " . $_POST["notes"] . "</p ></div>";
        }
        else{
            $results .= "<p> Any additional roles: *No additional information added</p ></div>";
        }
        return $results;
    }

    function sendConfirmationEmail($results,$to){
        $subject = "Thanks for signing up!";

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: <" . $_POST["email"] . ">" . "\r\n";

        mail($to, $subject, $results, $headers);
    }
?>

<!-- JavaScript for Dark Mode toggle -->
<script src="scripts/script.js"></script>

<!-- Required JavaScript -->
<!-- Popper.js, then Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>
