<?php
// Establishing database connection
$username = 'gnocchig';
$password = '0I(gjj4L!6a1PK';
$hostname = 'localhost';
$database = 'gnocchig_test';

$conn = @mysqli_connect($hostname, $username, $password, $database) or die("Error Connecting to DB: " . mysqli_connect_error());

// Delete application for admin
if(isset($_POST['delete_application_admin'])) {
    $application_id = $_POST['application_id'];

    // update statement to set is_deleted to 1
    $sql = "UPDATE applications SET is_deleted = 1 WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "i", $application_id);

    // Execute the statement
    if (mysqli_stmt_execute($stmt) === TRUE) {
        // Redirect or show a message after soft deletion
        header("Location: admin_dashboard.php");
        exit();
    } else {
        echo "Error soft deleting record: " . mysqli_error($conn);
    }

    // Close statement
    mysqli_stmt_close($stmt);
}
?>