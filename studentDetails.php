<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        button {
            background-color: crimson;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: darkred;
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

        $studentId = $_SESSION['student_id'];

        $sql = "SELECT * FROM students WHERE student_id = $studentId";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $name = $row['name'];

            // Display student details
            echo "<h2>Student Details</h2>";
            echo "<p>Name: $name</p>";

            // Fetch and display fees structure
            $feesSql = "SELECT * FROM fees WHERE student_id = $studentId";
            $feesResult = $conn->query($feesSql);

            if ($feesResult->num_rows > 0) {
                echo "<h2>Fees Structure</h2>";
                echo "<table border='1'>";
                echo "<tr><th>Semester</th><th>Amount</th></tr>";

                while ($feesRow = $feesResult->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$feesRow['semester']}</td>";
                    echo "<td>{$feesRow['amount']}</td>";
                    echo "</tr>";
                }

                echo "</table>";

                // Pay button linking to paymentGateway.php
                echo "<form action='paymentGateway.php' method='post'>";
                echo "<input type='hidden' name='student_id' value='$studentId'>";
                echo "<button type='submit'>Pay Fees</button>";
                echo "</form>";
            } else {
                echo "<p>No fees information found.</p>";
            }
        } else {
            echo "<p>Student not found.</p>";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
