-- Create the 'college' database
CREATE DATABASE IF NOT EXISTS college;

-- Use the 'college' database
USE college;

-- Table for student information
CREATE TABLE IF NOT EXISTS students (
    student_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    mobile_number VARCHAR(15),
    date_of_birth DATE
);

-- Table for fees structure
CREATE TABLE IF NOT EXISTS fees (
    fee_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT,
    semester INT,
    amount DECIMAL(10, 2),
    FOREIGN KEY (student_id) REFERENCES students(student_id)
);

-- Insert sample data
INSERT INTO students (name, mobile_number, date_of_birth) VALUES
    ('John Doe', '1234567890', '1995-05-15'),
    ('Jane Smith', '9876543210', '1998-08-25');

INSERT INTO fees (student_id, semester, amount) VALUES
    (1, 1, 1000.00),
    (1, 2, 1200.00),
    (2, 1, 900.00);
