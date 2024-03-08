<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit App confirmation</title>

</head>
<body>
<?php
require '/home/gnocchig/attdb.php';
if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    $appID = trim($_POST['application_id']);
    $appName = trim($_POST['application_name']);
    $appURL = trim($_POST['appication_url']);
    $appDate = trim($_POST['application_date']);
    $appStatus = trim($_POST['application_status']);
    $appUpdates = trim($_POST['application_updates']);
    $appFollowUp = trim($_POST['application_followUp']);

    // Prepare the SQL UPDATE query
    $update_sql = "UPDATE applications 
                    SET application_name = '$appName', 
                        application_url = '$appURL', 
                        application_date = '$apDate', 
                        application_status = '$appStatus', 
                        application_updates = '$appUpdates',
                        application_followUp = '$appFollowUp
                    WHERE application_id = '$appID'";

    // Execute the update
    mysqli_query($cnxn, $update_sql);

    // handling Null inputs
    if (!empty($appName) && !empty($appURL) && !empty($appDate) && !empty($appStatus) && !empty($appUpdates) && !empty($appFollowUp)) {

        echo "
                    <div>
                        
                            
                         <h2>
                        Edit Application Reciept</h2>
                        <hr>
            
                            <h2>Name of Role: </h2>
                            <h2 class='result'>" . htmlspecialchars($appName) . "</h2>
                            
                            <h2>Job Description URL: </h2>
                            <h3 class='result text-truncate'>" . htmlspecialchars($appURL) . "</h3>
        
                            <h2 class='key'>Date of Application: </h2>
                            <h2 class='result'>" . htmlspecialchars($AppDate) . "</h2>
                    
                            <h2 class='key'>Status: </h2>
                            <h2 class='result'>" . htmlspecialchars($appStatus) . "</h2>
                            
                            
                            <h2>Updates: </h2>
                            <h3 class='result'>" . htmlspecialchars($appUpdates) . "</h3>
                            
                            
                            <h2 class='key'>Follow-up Date :</h2>
                            <h2 class='result'>" . htmlspecialchars($appFollowUp) . "</h2>
                    </div>";


        // Email delivery
        // tschrock@greenriver.edu
        $to = "rahmaniabdul@icloud.com";
        $subject = "Application Updates: ".$appName."!";
        $message = "
                    <html>
                        <head>
                            <title>Changes and Updatestitle>
                        </head>
                        <body>
                            <p>Hope this email finds you well!</p>
                            <table>
                                <tr>
                                    <th>Name of the Role</th>
                                    <th>Job Description URL</th>
                                    <th>Date of Application</th>
                                    <th>Status</th>
                                    <th>Updates</th>
                                    <th>Follow up Date</th>
                                </tr>
                                <tr>
                                    <td>$appName</td>
                                    <td>$appURL</td>
                                    <td>$appDate</td>
                                    <td>$appStatus</td>
                                    <td>$appUpdates</td>
                                    <td>$appFollowUp</td>
                                </tr>
                            </table>
                        </body>
                    </html>
                ";

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: <anymail@web.com>' . "\r\n";
        $headers .= 'Cc: myself@yourself.com' . "\r\n";

        mail($to,$subject,$message,$headers);
    }
    else
    {
        echo "<h2>Erro! make sure you fill out the form properly. Thank you!</h2> ";
    }
} else
{
    echo "<h2>Erro! make sure you fill out the form properly. Thank you!</h2>";
}
?>
</body>
</html>