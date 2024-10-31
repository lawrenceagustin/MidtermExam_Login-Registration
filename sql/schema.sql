CREATE TABLE cars (
    car_id INT AUTO_INCREMENT PRIMARY KEY,
    brand VARCHAR(20) NOT NULL,
    model VARCHAR(20) NOT NULL,
    gen VARCHAR(20) NOT NULL,
    license_plate VARCHAR(20) NOT NULL,
    rental_status VARCHAR(20) NOT NULL DEFAULT 'Available',
    date_added DATE DEFAULT CURDATE()
);

CREATE TABLE rentals (
    rental_id INT AUTO_INCREMENT PRIMARY KEY,
    car_id INT NOT NULL,
    customer_name VARCHAR(50) NOT NULL,
    customer_licenseNo VARCHAR(20) NOT NULL,
    rental_date DATE NOT NULL DEFAULT CURDATE(),
    return_date DATE NOT NULL DEFAULT CURDATE(), 
    total_price DECIMAL(10, 2) NOT NULL,
    date_added DATE NOT NULL DEFAULT CURDATE() 
);

CREATE TABLE user_passwords (
	user_id INT AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(50),
	password VARCHAR(50),
	date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(32),
    last_name VARCHAR(32),
    age INT,
    birthdate DATE,
    home_address VARCHAR(512),
    date_registered TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE car_logs (
    logs_id INT AUTO_INCREMENT PRIMARY KEY,
    logsDescription VARCHAR (255),
    car_id INT,
    doneBy INT,
    dateLogged TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE rental_logs (
    logs_id INT AUTO_INCREMENT PRIMARY KEY,
    logsDescription VARCHAR (255),
    car_id INT,
    doneBy INT,
    dateLogged TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);