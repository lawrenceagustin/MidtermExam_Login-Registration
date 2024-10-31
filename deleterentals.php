<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Delete Rental</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<?php $getRentalsByID = getRentalsByID($pdo, $_GET['rental_id']); ?>
	<h1>Are you sure you want to delete this customer rental detail?</h1>
	<div class="container" style="border-style: solid; height: 400px;">
		<h2>Customer Name: <?php echo $getRentalsByID['customer_name'] ?></h2>
		<h2>License Number Used: <?php echo $getRentalsByID['customer_licenseNo'] ?></h2>
		<h2>Rental Date: <?php echo $getRentalsByID['rental_date'] ?></h2>
    <h2>Return Date: <?php echo $getRentalsByID['return_date'] ?></h2>
    <h2>Total Price: <?php echo $getRentalsByID['total_price'] ?></h2>
		<h2>Date Added: <?php echo $getRentalsByID['date_added'] ?></h2>

		<div class="deleteBtn" style="float: right; margin-right: 10px;">

			<form action="core/handleForms.php?rental_id=<?php echo $_GET['rental_id']; ?>&car_id=<?php echo $_GET['car_id']; ?>" method="POST">
				<input type="submit" name="deleteRentalBtn" value="Delete">
			</form>			
			
		</div>	

	</div>
</body>
</html>