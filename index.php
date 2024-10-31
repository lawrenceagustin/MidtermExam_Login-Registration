<?php 
require_once 'core/models.php'; 
require_once 'core/handleForms.php'; 

if (!isset($_SESSION['username'])) {
	header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Car Rental</title>
  <link rel="stylesheet" href="login&registration.css">
</head>
<body>
<?php if (isset($_SESSION['message'])) { ?>
		<h1 style="color: red;"><?php echo $_SESSION['message']; ?></h1>
	<?php } unset($_SESSION['message']); ?>

	<h1>Welcome To Car Rental Management System. Add new Cars to the fleet!</h1>

	<?php if (isset($_SESSION['username'])) { ?>
		<h1>Hello there!! <?php echo $_SESSION['username']; ?></h1>
		<input type="submit" value="Logout" onclick="window.location.href='core/handleForms.php?logoutAUser=1'"> <br><br>
	<?php } else { echo "<h1>No user logged in</h1>";}?>
	
	<input type="submit" value="Car Logs" onclick="window.location.href='carlogs.php'">

	  <form action="core/handleForms.php" method="POST">
		  <p>
			  <label for="brand">Brand</label> 
			  <input type="text" name="brand">
		  </p>
		  <p>
			  <label for="model">Model</label> 
			  <input type="text" name="model">
		  </p>
		  <p>
			  <label for="gen">Year</label> 
			  <input type="text" name="gen">
		  </p>
		  <p>
			  <label for="licensePlate">License Plate</label> 
			  <input type="text" name="license_plate">
		  </p>
		  <p>
			  <label for="rentalStatus">Rental Status</label> 
			  <select name="rental_status" id="rental_status">
          <option value="available">Available</option>
          <option value="rented">Rented</option>
					<option value="notAvailable">Not Available</option>
      </select>
			<br>
			  <input type="submit" name="insertCarsBtn">
		  </p>
	  </form>

		<h3>Users List</h3>
	<ul>
		<?php $getAllUsers = getAllUsers($pdo); ?>
		<?php foreach ($getAllUsers as $row) { ?>
			<li>
				<a href="viewusers.php?user_id=<?php echo $row['user_id']; ?>"><?php echo $row['username']; ?></a>
			</li>
		<?php } ?>
	</ul>

		<?php $getAllCars = getAllCars($pdo); ?>
	<?php foreach ($getAllCars as $row) { ?>
	<div class="container" style="border-style: solid; width: 50%; height: 300px; margin-top: 20px;">
		<h3>Brand: <?php echo $row['brand']; ?></h3>
		<h3>Model: <?php echo $row['model']; ?></h3>
		<h3>Year: <?php echo $row['gen']; ?></h3>
		<h3>License Plate: <?php echo $row['license_plate']; ?></h3>
		<h3>Rental Status: <?php echo $row['rental_status']; ?></h3>
		<h3>Date Added: <?php echo $row['date_added']; ?></h3>


		<div class="editAndDelete" style="float: right; margin-right: 20px;">
			<a href="viewprojects.php?car_id=<?php echo $row['car_id']; ?>">View Projects</a>
			<a href="editcars.php?car_id=<?php echo $row['car_id']; ?>">Edit</a>
			<a href="deletecars.php?car_id=<?php echo $row['car_id']; ?>">Delete</a>
		</div>


	</div> 
	<?php } ?>
</body>
</html>