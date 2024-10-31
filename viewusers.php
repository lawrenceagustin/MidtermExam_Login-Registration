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
	<link rel="stylesheet" href="login&registration.css">
	<title>View User</title>
	
</head>
<body>
	<div class="container">
	<?php $getUserByID = getUserByID($pdo, $_GET['user_id']); ?>
	<h1>Username: <?php echo $getUserByID['username']; ?></h1>
	<h1>Date Joined: <?php echo $getUserByID['date_added']; ?></h1>
	<h1>First Name: <?php echo $getUserByID['first_name']; ?></h1>
	<h1>Last Name: <?php echo $getUserByID['last_name']; ?></h1>
	<h1>Age: <?php echo $getUserByID['age']; ?></h1>
	
	<form action="index.php" method="post">
    <input type="submit" class="returnBtn" value="Return">
	</form>
	
	</div>
</body>
</html>
