<?php require_once 'core/models.php'; ?>
<?php require_once 'core/dbConfig.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Delete Cars</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<h1>Are you sure you want to delete this car?</h1>
	<?php $getCarsByID = getCarsByID($pdo, $_GET['car_id']); ?>
	<div class="container" style="border-style: solid; height: 400px;">
		<h2>Brand: <?php echo $getCarsByID['brand']; ?></h2>
		<h2>Model: <?php echo $getCarsByID['model']; ?></h2>
		<h2>Model Year: <?php echo $getCarsByID['gen']; ?></h2>
		<h2>License Plate: <?php echo $getCarsByID['license_plate']; ?></h2>
		<h2>Rental Status: <?php echo $getCarsByID['rental_status']; ?></h2>
		<h2>Date Added: <?php echo $getCarsByID['date_added']; ?></h2>

		<div class="deleteBtn" style="float: right; margin-right: 10px;">
			<form action="core/handleForms.php?car_id=<?php echo $_GET['car_id']; ?>" method="POST">
				<input type="submit" name="deleteCarBtn" value="Delete">
			</form>			
		</div>	

	</div>
</body>
</html>