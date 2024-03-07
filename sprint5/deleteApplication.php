<?php
include 'attdb.php';

// Delete application for regular users
if(isset($_POST['delete_application'])) {
    $application_id = $_POST['application_id']; // Assuming you have application ID sent via form

    // Update statement to set is_deleted to 1 only if the application belongs to the current user
    $sql = "UPDATE applications SET is_deleted = 1 WHERE id = ? AND user_id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "ii", $application_id, $current_user_id); 

    if (mysqli_stmt_execute($stmt) === TRUE) {
        // Redirect or show a message after soft deletion
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error soft deleting record: " . mysqli_error($conn);
    }

    // Close statement
    mysqli_stmt_close($stmt);
}
?>