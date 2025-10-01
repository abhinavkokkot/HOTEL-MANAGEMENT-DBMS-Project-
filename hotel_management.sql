-- Create Database
CREATE DATABASE IF NOT EXISTS hotel_management;
USE hotel_management;

-- Users table (for login/signup)
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20) DEFAULT 'customer'
);

-- Rooms table (different room types)
CREATE TABLE rooms (
    room_id INT AUTO_INCREMENT PRIMARY KEY,
    room_type VARCHAR(50) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    status VARCHAR(20) DEFAULT 'Available'
);

-- Bookings table (when a user books a room)
CREATE TABLE bookings (
    booking_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    room_id INT,
    check_in DATE,
    check_out DATE,
    status VARCHAR(20) DEFAULT 'Booked',
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (room_id) REFERENCES rooms(room_id)
);

-- Insert sample users
INSERT INTO users (username, email, password, role) VALUES
('admin', 'admin@hotel.com', 'admin123', 'admin'),
('vikram', 'vikram@example.com', '12345', 'customer');

-- Insert sample rooms
INSERT INTO rooms (room_type, price, status) VALUES
('Single Room', 1500, 'Available'),
('Double Room', 2500, 'Available'),
('Luxury Room', 5000, 'Available');

-- Insert sample bookings
INSERT INTO bookings (user_id, room_id, check_in, check_out, status) VALUES
(2, 1, '2025-10-01', '2025-10-05', 'Booked');
