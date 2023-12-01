<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Confirmation</title>
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

        button {
            background-color: #4caf50; /* Green */
            color: white;
            padding: 10px 15px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049;
        }

        .deny-button {
            background-color: #f44336; /* Red */
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

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Get the student ID from the form
            $studentId = $_POST['student_id'];

            // Perform necessary actions related to payment processing
            // For demonstration purposes, we'll simulate a successful payment
            $paymentSuccessful = true;

            // Display buttons for payment confirmation
            echo "<h2>Payment Confirmation</h2>";
            echo "<form action='feeReceipt.php' method='post'>";
            echo "<input type='hidden' name='student_id' value='$studentId'>";

            if ($paymentSuccessful) {
                echo "<button type='submit' name='confirm_payment'>Yes</button>";
                echo "<button class='deny-button' type='button' onclick='denyTransaction()'>No</button>";
            } else {
                echo "<button class='deny-button' type='button' onclick='denyTransaction()'>No</button>";
            }

            echo "</form>";
        }

        $conn->close();
        ?>

        <script>
            function denyTransaction() {
                alert('Transaction denied');
                window.location.href = 'studentDetails.php'; // Redirect to the studentDetails.php page or any other desired page
            }
        </script>
    </div>
</body>
</html>
