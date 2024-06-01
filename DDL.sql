-- CREATE DATABASE rentalSystem;

CREATE TABLE office (
    office_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    city VARCHAR(255),
    country VARCHAR(255)
);

CREATE TABLE car (
    num_plate INT NOT NULL,
    letter_plate VARCHAR(255) NOT NULL,
    model VARCHAR(255) NOT NULL,
    `year` INT NOT NULL,
    `status` VARCHAR(255) NOT NULL,
    image_path VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2),
    office_id INT,
    color VARCHAR(255),
    PRIMARY KEY (num_plate, letter_plate),
    FOREIGN KEY (office_id) REFERENCES office(office_id) ON DELETE SET NULL
);

CREATE TABLE customer (
    user_id VARCHAR(255) NOT NULL PRIMARY KEY,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    phone_number VARCHAR(16) UNIQUE NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    isAdmin BOOLEAN DEFAULT FALSE,
    gender VARCHAR(1),
    Bdate DATE
);

CREATE TABLE reservation (
    num_plate INT NOT NULL,
    letter_plate VARCHAR(255) NOT NULL,
    user_id VARCHAR(255) NOT NULL,
    pickup_date DATE NOT NULL,
    dropoff_date DATE NOT NULL,
    office_id INT NOT NULL,
    PRIMARY KEY(num_plate,letter_plate,user_id,pickup_date),
    FOREIGN KEY (user_id) REFERENCES customer(user_id) ON DELETE CASCADE,
    FOREIGN KEY (num_plate,letter_plate) REFERENCES car(num_plate,letter_plate) ON DELETE CASCADE,
    FOREIGN KEY (office_id) REFERENCES office(office_id)
);