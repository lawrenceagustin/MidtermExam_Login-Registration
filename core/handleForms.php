<?php 

require_once 'dbConfig.php'; 
require_once 'models.php';

if (isset($_POST['insertCarsBtn'])) {

	$query = insertCars($pdo, $_POST['brand'], $_POST['model'], 
		$_POST['gen'], $_POST['license_plate'], $_POST['rental_status']);

	if ($query) {
		header("Location: ../index.php");
	}
	else {
		echo "Insertion failed";
	}

}

if (isset($_POST['editCarsBtn'])) {
	$query = updateCars($pdo, $_POST['brand'], $_POST['model'], 
		$_POST['gen'], $_POST['license_plate'], $_POST['rental_status'], $_GET['car_id']);

	if ($query) {
		header("Location: ../index.php");
	}

	else {
		echo "Edit failed";;
	}

}

if (isset($_POST['deleteCarBtn'])) {
	$query = deleteCars($pdo, $_GET['car_id']);

	if ($query) {
		header("Location: ../index.php");
	}

	else {
		echo "Deletion failed";
	}
}

if (isset($_POST['editRentalsBtn'])) {
	$query = updateRentals($pdo, $_POST['customerName'], $_POST['customerLicenseNo'], $_POST['rental_date'], $_POST['return_date'], $_POST['totalPrice'], $_GET['rental_id']);

	if ($query) {
		header("Location: ../viewprojects.php?car_id=" .$_GET['car_id']);
	}
	else {
		echo "Update failed";
	}

}

if (isset($_POST['insertNewRentalBtn'])) {
	$query = insertRentals($pdo, $_POST['customer_name'], $_POST['licenseNo'], $_GET['car_id'], $_POST['rental_date'], $_POST['return_date'], $_POST['total_price']);

	if ($query) {
		header("Location: ../viewprojects.php?car_id=" .$_GET['car_id']);
	}
	else {
		echo "Insertion failed";
	}
}

if (isset($_POST['deleteRentalBtn'])) {
	$query = deleteRental($pdo, $_GET['rental_id']);

	if ($query) {
		header("Location: ../viewprojects.php?car_id=" .$_GET['car_id']);
	}
	else {
		echo "Deletion failed";
	}
}

// login and registration

function sanitizeInput($input) {
	$input = trim($input);
	$input = stripslashes($input);
	$input = htmlspecialchars($input);
	return $input;
}


if (isset($_POST['registerUserBtn'])) {
	$username = sanitizeInput($_POST['username']);
	$password = $_POST['password']; // Raw password input
	$hashed_password = password_hash($password, PASSWORD_DEFAULT);
	$first_name = sanitizeInput($_POST['first_name']);
	$last_name = sanitizeInput($_POST['last_name']);
	$age = $_POST['age'];
	$birthdate = $_POST['birthdate'];

	// Pass the raw password to addUser for validation
	$function = addUser($pdo, $username, $hashed_password, $first_name, $last_name, $age, $birthdate, $password);
	
	// Handling registration response
	switch ($function) {
			case "registrationSuccess":
					header("Location: ../login.php");
					exit;
			case "UsernameAlreadyExists":
					$_SESSION['message'] = "The username is already taken! Please select a different one!";
					header("Location: ../register.php");
					exit;
			case "UserAlreadyExists":
					$_SESSION['message'] = "The user already exists! Please update your existing account instead!";
					header("Location: ../register.php");
					exit;
			case "InvalidPassword":
					$_SESSION['message'] = "Password is not strong enough! Make sure it is 8 characters long, has uppercase and lowercase characters, and includes numbers.";
					header("Location: ../register.php");
					exit;
			default:
					echo "<h2>User addition failed.</h2>";
					echo '<a href="../register.php">';
					echo '<input type="submit" id="returnHomeButton" value="Return to register page" style="padding: 6px 8px; margin: 8px 2px;">';
					echo '</a>';
					break;
	} 
}

if (isset($_POST['loginUserBtn'])) {

	$username = $_POST['username'];
	$password = $_POST['password'];

	if (!empty($username) && !empty($password)) {

		$loginQuery = loginUser($pdo, $username, $password);
	
		if ($loginQuery) {
			header("Location: ../index.php");
		}
		else {
			header("Location: ../login.php");
		}

	}

	else {
		$_SESSION['message'] = "Please make sure the input fields 
		are not empty for the login!";
		header("Location: ../login.php");
	}
 
}

if (isset($_GET['logoutAUser'])) {
	unset($_SESSION['username']);
	header('Location: ../login.php');
}
?>