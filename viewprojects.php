<?php require_once 'core/dbConfig.php';?>
<?php require_once 'core/models.php';
 
$car = getCarsByID($pdo, $_GET['car_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Rentals</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <a href="index.php">Return to home</a>
    <h1>Rentals for <?php echo $car['brand'] . ' ' . $car['model']; ?></h1>
    <h2>Add New Rental</h2>
    
    <input type="submit" value="Rental Logs" onclick="window.location.href='rental_logs.php?car_id=<?php echo $car['car_id']; ?>'">

    <form action="core/handleForms.php?car_id=<?php echo $_GET['car_id']; ?>" method="POST">
    
        <p>
            <label for="customer_name">Customer Name</label> 
            <input type="text" name="customer_name" required>
        </p>
        <p>
            <label for="licenseNo">License No.</label> 
            <input type="text" name="licenseNo" required>
        </p>
        <p>
            <label for="rental_date">Rental Date</label>
            <input type="date" name="rental_date" required>
        </p>
        <p>
            <label for="return_date">Return Date</label>
            <input type="date" name="return_date" required>
        </p>
        <p>
            <label for="total_price">Total Price</label>
            <input type="number" name="total_price" step="0.01" required>
        </p>
        <p>
            <input type="submit" name="insertNewRentalBtn" value="Add Rental">
        </p>
    </form>
    <table style="width:100%; margin-top: 50px;">
        <tr>
            <th>Rental ID</th>
            <th>Customer Name</th>
            <th>Car Rented</th>
            <th>Rental Date</th>
            <th>Return Date</th>
            <th>Total Price</th>
            <th>Date Added</th>
            <th>Action</th>
        </tr>
        <?php $getRentalsByCarID = getRentalsByCarID($pdo, $_GET['car_id']); ?>
        <?php foreach ($getRentalsByCarID as $row) { ?>
        <tr>
            <td><?php echo $row['rental_id']; ?></td>    
            <td><?php echo $row['customer_name']; ?></td>    
            <td><?php echo $row['brand'] . ' ' . $row['model']; ?></td>  
            <td><?php echo $row['rental_date']; ?></td>    
            <td><?php echo $row['return_date']; ?></td>    
            <td><?php echo $row['total_price']; ?></td>    
            <td><?php echo $row['date_added']; ?></td>
            <td>
                <a href="editrentals.php?rental_id=<?php echo $row['rental_id']; ?>&car_id=<?php echo $_GET['car_id']; ?>">Edit</a>
                <a href="deleterentals.php?rental_id=<?php echo $row['rental_id']; ?>&car_id=<?php echo $_GET['car_id']; ?>">Delete</a>
            </td>    
        </tr>
        <?php } ?>
    </table>
</body>