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
        <h2>Rental Logs</h2>

        <input type="submit" value="Return To Your Profile" onclick="window.location.href='viewprojects.php?car_id=<?php echo $row['car_id']; ?>">

        <table>
            <tr>
                <th>Log ID</th>
                <th>Action Done</th>
                <th>Rental ID</th>
                <th>Done By</th>
                <th>Date Logged</th>
            </tr>

            <?php $RentalLogs = getRentalLogs($pdo); ?>
            <?php foreach ($RentalLogs as $row)  ?>
            <tr>
                <td><?php echo $row['logs_id']?></td>
                <td><?php echo $row['logsDescription']?></td>
                <td><?php echo $row['rental_id']?></td>
                <td><?php echo $row['doneBy']?></td>
                <td><?php echo $row['dateLogged']?></td>
            </tr>
        </table>    
    </body>
</html>