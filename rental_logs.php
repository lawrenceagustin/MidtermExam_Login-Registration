<?php
require_once 'core/dbConfig.php';
require_once 'core/models.php';

if(!isset($_SESSION['username'])) {
    header("Location: login.php");
}

$car_id = $_GET['car_id'] ?? null;
?>



<html>
    <head>
        <title>Car Rental Management System</title>
        <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
    </head>
    <body>
        <h2>Rental Logs</h2>

        <input type="submit" value="Return" onclick="window.location.href='viewprojects.php?car_id=<?php echo htmlspecialchars($car_id); ?>'">

        <table>
            <tr>
                <th>Log ID</th>
                <th>Action Done</th>
                <th>Rental ID</th>
                <th>Done By</th>
                <th>Date Logged</th>
            </tr>

            <?php 
            $RentalLogs = getRentalLogs($pdo); 
            if (!empty($RentalLogs)) {
                foreach ($RentalLogs as $row) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['logs_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['logsDescription']); ?></td>
                        <td><?php echo htmlspecialchars($row['rental_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['doneBy']); ?></td>
                        <td><?php echo htmlspecialchars($row['dateLogged']); ?></td>
                    </tr>
                <?php } 
            } else { ?>
                <tr><td colspan="5">No rental logs found.</td></tr>
            <?php } ?>
        </table>    
    </body>
</html>