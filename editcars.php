<?php require_once 'core/handleForms.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit Cars</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<?php $getCarsByID = getCarsByID($pdo, $_GET['car_id']); ?>
	<h1>Edit cars</h1>
	<form action="core/handleForms.php?car_id=<?php echo $_GET['car_id']; ?>" method="POST">
		<p>
			<label for="brand">Brand</label> 
			<input type="text" name="brand" value="<?php echo $getCarsByID['brand']; ?>">
		</p>
		<p>
			<label for="model">Model</label> 
			<input type="text" name="model" value="<?php echo $getCarsByID['model']; ?>">
		</p>
		<p>
			<label for="gen">Model Year</label> 
			<input type="text" name="gen" value="<?php echo $getCarsByID['gen']; ?>">
		</p>
    <p>
			<label for="license_plate">License Plate</label> 
			<input type="text" name="license_plate" value="<?php echo $getCarsByID['license_plate']; ?>">
		</p>
		<p>
			<label for="rentalStatus">Rental Status</label> 
			<select name="rental_status">
        <option value="available" <?php echo ($getCarsByID['rental_status'] === 'available') ? 'selected':''; ?>>Available</option>
        <option value="rented" <?php echo ($getCarsByID['rental_status'] === 'rented') ? 'selected':''; ?>>Rented</option>
        <option value="rented" <?php echo ($getCarsByID['rental_status'] === 'notAvailable') ? 'selected':''; ?>>Not Available</option>
			<input type="submit" name="editCarsBtn">
		</p>
	</form>
</body>
</html>