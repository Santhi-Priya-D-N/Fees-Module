<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fee Receipt</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            color: crimson;
            margin-bottom: 20px;
        }

        p {
            margin: 10px 0;
        }

        button {
            background-color: #4caf50; /* Green */
            color: white;
            padding: 10px 15px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-top: 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        session_start();

        $servername = "localhost";
        $username = "root";
        $password = "1910"; // Replace with your MySQL password
        $dbname = "college";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm_payment'])) {
            // Get the student ID from the form
            $studentId = $_POST['student_id'];

            // Fetch student details for the receipt
            $sql = "SELECT * FROM students WHERE student_id = $studentId";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $name = $row['name'];

                // Display receipt information
                echo "<h2>Fee Receipt</h2>";
                echo "<p>Name: $name</p>";
                echo "<p>Payment Status: Successful</p>";
                // Add more receipt details as needed

                // Button to go back to the login page
                echo "<form action='login.html' method='get'>";
                echo "<button type='submit'>Back to Login Page</button>";
                echo "</form>";
            } else {
                echo "<p>Student not found.</p>";
            }
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
