<?php

    function insertCars($pdo, $brand, $model, $gen, $license_plate, $rental_status){
        $sql = "INSERT INTO cars (brand, model, gen, license_plate, rental_status) VALUES(?, ?, ?, ?, ?)";

        $stmt = $pdo->prepare($sql);
        $executeQuery = $stmt->execute([$brand, $model, $gen, $license_plate, $rental_status]);

        if ($executeQuery){
					$carID = getNewestCarID($pdo)['car_id'];
        	$carData = getCarsByID($pdo, $carID);
        	logCarAction($pdo, "ADDED", $carID, $_SESSION['username']);
        		return true;
    }
}

function getNewestCarID($pdo) {
	$query = "SELECT car_id
			FROM cars
			ORDER BY car_id DESC
    		LIMIT 1;";
		$statement = $pdo -> prepare($query);
		$executeQuery = $statement -> execute();
		
		if ($executeQuery) {
			return $statement -> fetch();
		}
}

function getNewestRentalID($pdo) {
	$query = "SELECT rental_id
			FROM rentals
			ORDER BY rental_id DESC
    		LIMIT 1;";
		$statement = $pdo -> prepare($query);
		$executeQuery = $statement -> execute();
		
		if ($executeQuery) {
			return $statement -> fetch();
		}
}

    function getAllCars($pdo) {
	    $sql = "SELECT * FROM cars";
	    $stmt = $pdo->prepare($sql);
	    $executeQuery = $stmt->execute();

	    if ($executeQuery) {
		    return $stmt->fetchAll();
	}
}

    function getCarsByID($pdo, $car_id) {
	    $sql = "SELECT * FROM cars WHERE car_id = ?";
	    $stmt = $pdo->prepare($sql);
	    $executeQuery = $stmt->execute([$car_id]);

	    if ($executeQuery) {
		    return $stmt->fetch();
	}
}

	function updateCars($pdo, $brand, $model, 
		$gen, $license_plate, $rental_status, $car_id) {

		$sql = "UPDATE cars
								SET brand = ?,
										model = ?,
										gen = ?, 
										license_plate = ?,
										rental_status = ?
								WHERE car_id = ?
			";
		$stmt = $pdo->prepare($sql);
		$executeQuery = $stmt->execute([$brand, $model, 
						$gen, $license_plate, $rental_status, $car_id]);
	
		if ($executeQuery) {
			$carID = getNewestCarID($pdo)['car_id'];
      $carData = getCarsByID($pdo, $carID);
			logCarAction($pdo, "UPDATED", $carID, $_SESSION['username']);
			return true;
		}
}

function deleteCars($pdo, $car_id) {
	$deleteCars= "DELETE FROM cars WHERE car_id = ?";
	$deleteStmt = $pdo->prepare($deleteCars);
	$executeDeleteQuery = $deleteStmt->execute([$car_id]);

		if ($executeDeleteQuery) {
			$carID = getNewestCarID($pdo)['car_id'];
      $carData = getCarsByID($pdo, $carID);
			logCarAction($pdo, "DELETED", $car_id, $_SESSION['username']);
			return true;
		}

	}

function getRentalsByCarID($pdo, $car_id) {
	
	$sql = "SELECT 
				rentals.rental_id AS rental_id,
				rentals.car_id AS car_id,
				cars.brand AS brand,	
				cars.model AS model,
				rentals.customer_name AS customer_name,
				rentals.customer_licenseNo AS customer_licenseNo,
				rentals.rental_date AS rental_date,
				rentals.return_date AS return_date,
				rentals.total_price AS total_price,
				rentals.date_added AS date_added
			FROM rentals
			JOIN cars ON rentals.car_id = cars.car_id
			WHERE rentals.car_id = ? 
			ORDER BY rentals.rental_id DESC;
			";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$car_id]);
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function insertRentals($pdo, $customer_name, $customer_licenseNo, $car_id, $rental_date, $return_date, $total_price) {
	$sql = "INSERT INTO rentals (customer_name, customer_licenseNo, car_id, rental_date, return_date, total_price) VALUES (?,?,?,?,?,?)";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$customer_name, $customer_licenseNo, $car_id, $rental_date, $return_date, $total_price]);
		if ($executeQuery){
			$rentalID = getNewestRentalID($pdo)['rental_id'];
			$rentalData = getRentalsByID($pdo, $rentalID);
			logRentalAction($pdo, "ADDED", $rentalID, $_SESSION['username']);
			return true;
	}

}

function getAllRentals($pdo) {
	$sql = "SELECT * FROM rentals";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();

	if ($executeQuery) {
		return $stmt->fetchAll();
}
}

function getRentalsByID($pdo, $rental_id) {
	$sql = "SELECT 
				rentals.rental_id AS rental_id,
				rentals.customer_name AS customer_name,
				rentals.customer_licenseNo AS customer_licenseNo,
				rentals.rental_date AS rental_date,
				rentals.return_date AS return_date,
				rentals.total_price AS total_price,
				rentals.date_added AS date_added
			FROM rentals
			JOIN cars ON rentals.car_id = cars.car_id
			WHERE rentals.rental_id  = ?";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$rental_id]);
	if ($executeQuery) {
		return $stmt->fetch();
	}
}

function updateRentals($pdo, $customer_name, $customer_licenseNo, $return_date, $rental_date, $total_price, $rental_id) {
	$sql = "UPDATE rentals
			SET customer_name = ?,
					customer_licenseNo = ?,
					rental_date = ?,
					return_date = ?,
					total_price = ?
			WHERE rental_id = ?
			";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$customer_name, $customer_licenseNo, $return_date, $rental_date, $total_price, $rental_id]);

	if ($executeQuery){
		$rentalID = getNewestRentalID($pdo)['rental_id'];
		$rentalData = getRentalsByID($pdo, $rentalID);
		logRentalAction($pdo, "UPDATED", $rentalID, $_SESSION['username']);
		return true;
	}
}

function deleteRental($pdo, $rental_id) {
	$sql = "DELETE FROM rentals WHERE rental_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$rental_id]);

	if ($executeQuery){
		$rentalID = getNewestRentalID($pdo)['rental_id'];
		$rentalData = getRentalsByID($pdo, $rentalID);
		logRentalAction($pdo, "DELETED", $rental_id, $_SESSION['username']);
		return true;
	}
}

// login and registration

function loginUser($pdo, $username, $password) {
	$sql = "SELECT * FROM user_passwords WHERE username=?";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$username]); 

	if ($stmt->rowCount() == 1) {
		$userInfoRow = $stmt->fetch();
		$usernameFromDB = $userInfoRow['username']; 
		$passwordFromDB = $userInfoRow['password'];

		if (password_verify($password, $passwordFromDB)) {
			$_SESSION['username'] = $usernameFromDB;
			$_SESSION['message'] = "Login successful!";
			return true;
		}

		else {
			$_SESSION['message'] = "Password is invalid, but user exists";
		}
	}

	
	if ($stmt->rowCount() == 0) {
		$_SESSION['message'] = "Username doesn't exist from the database. You may consider registration first";
	}

}

function getUserByID($pdo, $user_id) {
	$sql = "SELECT users.first_name, users.last_name, users.age, user_passwords.username, user_passwords.date_added 
					FROM users 
					JOIN user_passwords ON users.user_id = user_passwords.user_id 
					WHERE users.user_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$user_id]);
	
	if ($executeQuery) {
			return $stmt->fetch();
	}
	return null; 
}

function addUser($pdo, $username, $hashed_password, $first_name, $last_name, $age, $birthdate, $password) {
	if (checkUsernameExistence($pdo, $username)) {
			return "UsernameAlreadyExists";
	}
	
	if (checkUserExistence($pdo, $first_name, $last_name, $age, $birthdate)) {
			return "UserAlreadyExists";
	}
	

	if (!validatePassword($password)) { 
			return "InvalidPassword";
	}

	$query1 = "INSERT INTO user_passwords (username, password) VALUES (?, ?)";
	$statement1 = $pdo->prepare($query1);
	$executeQuery1 = $statement1->execute([$username, $hashed_password]);

	$query2 = "INSERT INTO users (first_name, last_name, age, birthdate) VALUES (?, ?, ?, ?)";
	$statement2 = $pdo->prepare($query2);
	$executeQuery2 = $statement2->execute([$first_name, $last_name, $age, $birthdate]);

	if ($executeQuery1 && $executeQuery2) {
			return "registrationSuccess";
	}
	
	return null; 
}

function getAllUsers($pdo) {
	$sql = "SELECT users.user_id, user_passwords.username 
					FROM users 
					JOIN user_passwords ON users.user_id = user_passwords.user_id";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();

	if ($executeQuery) {
			return $stmt->fetchAll();
	}
	return [];
}

function checkUsernameExistence($pdo, $username) {
	$query = "SELECT * FROM user_passwords WHERE username = ?";
	$statement = $pdo -> prepare($query);
	$executeQuery = $statement -> execute([$username]);

	if($statement -> rowCount() > 0) {
		return true;
	}
}

function checkUserExistence($pdo, $first_name, $last_name, $age, $birthdate) {
	$query = "SELECT * FROM users 
				WHERE first_name = ? AND 
				last_name = ? AND
				age = ? AND
				birthdate = ?";
	$statement = $pdo -> prepare($query);
	$executeQuery = $statement -> execute([$first_name, $last_name, $age, $birthdate]);

	if($statement -> rowCount() > 0) {
		return true;
	}
}

function validatePassword($password) {
	
	if (strlen($password) < 8) {
			return false; 
	}

	$hasLower = $hasUpper = $hasNumber = false;

	
	foreach (str_split($password) as $char) {
			if (ctype_lower($char)) {
					$hasLower = true;
			} elseif (ctype_upper($char)) {
					$hasUpper = true;
			} elseif (ctype_digit($char)) {
					$hasNumber = true;
			}

			
			if ($hasLower && $hasUpper && $hasNumber) {
					return true;
			}
	}

	return false; 
}

//Car and Rental LOGS
function getCarLogs ($pdo) {
	$query = "SELECT * FROM car_logs ORDER BY dateLogged DESC";
	$statement = $pdo -> prepare($query);
	$executeQuery = $statement -> execute();

	if($executeQuery) {
			return $statement -> fetchAll();
	}
}

function logCarAction($pdo, $logsDescription, $car_id, $doneBy){
	$query = "INSERT INTO car_logs (logsDescription, car_id, doneBy) VALUES (?,?,?)";
	$statement = $pdo -> prepare($query);
	$executeQuery = $statement -> execute([$logsDescription, $car_id, $doneBy]);

	if($executeQuery){
			return true;
	}
}
function getRentalLogs ($pdo) {
	$query = "SELECT * FROM rental_logs ORDER BY dateLogged DESC";
	$statement = $pdo -> prepare($query);
	$executeQuery = $statement -> execute();

	if($executeQuery) {
			return $statement -> fetchAll();
	}
}

function logRentalAction($pdo, $logsDescription, $rental_id, $doneBy){
	$query = "INSERT INTO rental_logs (logsDescription, rental_id, doneBy) VALUES (?,?,?)";
	$statement = $pdo -> prepare($query);
	$executeQuery = $statement -> execute([$logsDescription, $rental_id, $doneBy]);

	if($executeQuery){
			return true;
	}
}
?>