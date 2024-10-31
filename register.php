<?php  
require_once 'core/models.php'; 
require_once 'core/handleForms.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Register Account</title>
</head>
<body>
	<div class="container">
	<h1>Register here!</h1>
	<?php if (isset($_SESSION['message'])) { ?>
		<h1 style="color: red;"><?php echo $_SESSION['message']; ?></h1>
	<?php } unset($_SESSION['message']); ?>
	<form action="core/handleForms.php" method="POST">
		<p>
			<label for="username">Username</label>
			<input type="text" name="username">
		</p>
		<p>
			<label for="username">Password</label>
			<input type="password" name="password">
		</p>
			<label for="first_name">First name</label>
      <input type="text" name="first_name" id="first_name" required>

      <label for="last_name">Last name</label>
      <input type="text" name="last_name" id="last_name" required> <br>

			<label for="age">Age</label>
      <input type="number" name="age" id="age" min="0" required>

			<label for="birthdate">Birthdate</label>
      <input type="date" name="birthdate" id="birthdate" min="1970-01-01" max="2024-12-31" required> <br>
			<input type="submit" name="registerUserBtn"> <br>
			<input type="submit" value="Back" onclick="window.location.href='login.php'">
		</p>
		<div>
	</form>
</body>
</html>