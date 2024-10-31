<?php
require_once 'core/dbConfig.php';
require_once 'core/models.php';

if(!isset($_SESSION['username'])) {
    header("Location: login.php");
}
?>

<html>
    <head>
        <title>Car Rental Management System</title>
        <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
    </head>
    <body>
        <h2>Car Logs</h2>

        <input type="submit" value="Return To Your Profile" onclick="window.location.href='index.php'">

        <table>
            <tr>
                <th>Log ID</th>
                <th>Action Done</th>
                <th>Car ID</th>
                <th>Done By</th>
                <th>Date Logged</th>
            </tr>

            <?php $CarLogs = getCarLogs($pdo); ?>
            <?php foreach ($CarLogs as $row) { ?>
            <tr>
                <td><?php echo $row['logs_id']?></td>
                <td><?php echo $row['logsDescription']?></td>
                <td><?php echo $row['car_id']?></td>
                <td><?php echo $row['doneBy']?></td>
                <td><?php echo $row['dateLogged']?></td>
            </tr>
            <?php } ?>
        </table>    
    </body>
</html>