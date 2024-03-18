<?php
    require '/home/gnocchig/attdb.php';

    // Delete application for regular users
    if (isset($_POST['delete_application']) && isset($_POST['delete_application'])) {
        $application_id = $_POST['delete_application']; // Assuming you have application ID sent via form
        echo $application_id;

        // Update statement to set is_deleted to 1 only if the application belongs to the current user
        $sql = "UPDATE `applications` SET `is_deleted` = 1 WHERE `application_id` = ?";
        $stmt = mysqli_prepare($cnxn, $sql);

        mysqli_stmt_bind_param($stmt, "i", $application_id);

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Error soft deleting record: " . mysqli_error($cnxn);
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }
?>