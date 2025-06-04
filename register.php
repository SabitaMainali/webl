<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "webtech_db";

// Connect to MySQL
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// If form is submitted
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encrypt password

    $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $email, $password);

    if ($stmt->execute()) {
        echo "<p style='color:green; text-align:center;'>✅ Registration successful!</p>";
    } else {
        echo "<p style='color:red; text-align:center;'>❌ Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Registration</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background:rgb(247, 147, 209);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 130vh;
        }

        form {
            background: #fff;
            padding: 60px;
            border-radius: 15px;
            box-shadow: 0 5px 34px rgba(221, 131, 202, 0.1);
            width: 350px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            font-weight: bold;
            display: block;
            margin: 15px 7 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            outline: none;
            transition: 0.3s ease;
        }

        input:focus {
            border-color:rgb(174, 199, 225);
            box-shadow: 3 0.5 5px rgba(119, 134, 151, 0.5);
        }

        button {
            padding: 13px 16px;
            margin: 11px 7px 0 0;
            border: none;
            border-radius: 8px;
            background-color:rgb(13, 167, 144);
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background-color:rgb(162, 185, 209);
        }

        button[type="reset"] {
            background-color: #6c757d;
        }

        p {
            text-align: center;
            margin-top: 15px;
        }

        a {
            color:rgb(20, 22, 23);
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <form action="" method="post">
        <h2>REGISTER</h2>

        <label for="name">Name</label>
        <input type="text" id="name" name="name" required />

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required />

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required />

        <div style="display: flex; justify-content: space-between;">
            <button type="reset">Reset</button>
            <button type="submit" name="submit">Register</button>
        </div>

        <p>Already have an account? <a href="login.php">Login here</a></p>
    </form>
</body>
</html>