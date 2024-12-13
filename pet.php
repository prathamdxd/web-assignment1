<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Registration</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #00ffbb;
            margin: 0;
            padding: 0;
        }

        #address {
            width: 100%;
            height: 70px;
        }

        .form-container {
            max-width: 580px;
            margin: 50px auto;
            background:#f8efef;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input,
        select,
        button {
            width: 100%;
            padding: 10px;
            margin-top: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color:rgb(188, 230, 51);
            color: white;
            width: 50%;
            font-weight: bold;
            cursor: pointer;
            border: none;
            display:block;
            margin:auto;
            margin-top: 15px;
        }

        button:hover {
            background-color:rgb(209, 184, 58);
        }

        #success-message {
            text-align: center;
            color: #28a745;
        }
        .rad{
            display: flex;
        }
        .rad input{
            margin-top: 16px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "pet_registration";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $ownerName = $_POST['ownerName'];
        $petName = $_POST['petName'];
        $petType = $_POST['petType'];
        $age = $_POST['age'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $ownedBefore = $_POST['ownedBefore'];
        $petColor = $_POST['petColor'];
        $petDOB = $_POST['petDOB'];
        $sql = "INSERT INTO pets (ownerName, petName, petType, age, email, phone, address, ownedBefore, petColor, petDOB)
                VALUES ('$ownerName', '$petName', '$petType', $age, '$email', '$phone', '$address', '$ownedBefore', '$petColor', '$petDOB')";

        if ($conn->query($sql) === TRUE) {
            echo "<div id='success-message'><h2>Registration Successful!</h2></div>";
        } else {
            echo "<div id='error-message'><h2>Error: " . $sql . "<br>" . $conn->error . "</h2></div>";
        }

        $conn->close();
    }
    ?>
    <div class="form-container">
        <h1 style="text-align:center;color:rgb(255, 127, 72) ">Prathiksha's </h1>
        <h2 style="text-align:center;color:rgb(243, 144, 102) ">Pet Registration Form</h2>
        <form id="pet-registration-form" method="POST" action="submit.php">
            <label for="ownerName">Owner's Name:</label>
            <input type="text" id="ownerName" name="ownerName" required>

            <label for="petName">Pet's Name:</label>
            <input type="text" id="petName" name="petName" required>

            <label for="petType">Pet Type:</label>
            <select id="petType" name="petType" required>
                <option value="Dog">Dog</option>
                <option value="Cat">Cat</option>
                <option value="Bird">Bird</option>
                <option value="Other">Other</option>
            </select>

            <label for="age">Pet's Age:</label>
            <input type="number" id="age" name="age" min="0" required>

            <label for="email">Email Address:</label>
            <input type="email" id="email" name="email" required>

            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone" pattern="[0-9]{10}" placeholder="1234567890" required>

            <label for="address">Address:</label>
            <textarea id="address" name="address" rows="3" required></textarea>

            <label>Have you owned a pet before?</label>
            <div class="rad">
                <label for="ownedYes">Yes</label>
                <input type="radio" id="ownedYes" name="ownedBefore" value="Yes" required>
            </div>
            <div class="rad"><label for="ownedNo">No</label>
                <input type="radio" id="ownedNo" name="ownedBefore" value="No" required>
            </div>



            <label for="petColor">Pet's Color:</label>
            <input type="color" id="petColor" name="petColor">

            <label for="petDOB">Pet's Date of Birth:</label>
            <input type="date" id="petDOB" name="petDOB">

            <button type="submit">Register</button>
        </form>
        <div id="success-message" style="display:none;">
            <h2>Registration Successful!</h2>
        </div>
    </div>

    <script><script>
        $(document).ready(function () {
            $('#pet-registration-form').on('submit', function (e) {
                e.preventDefault(); // Prevent default form submission

                $.ajax({
                    url: '', // Submitting to the same page
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function (response) {
                        // Reload the page to display success or error message
                        $('body').html(response);
                    },
                    error: function () {
                        alert('An error occurred while submitting the form. Please try again.');
                    }
                });
            });
        });
    </script>
    </script>
</body>

</html>