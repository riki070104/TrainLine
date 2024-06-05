<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Tiket Kereta Api</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: url('5.jpg') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .overlay {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 90%;
        }
        h1 {
            font-size: 2em;
            margin-bottom: 20px;
            color: #333;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }
        input {
            padding: 10px;
            margin-bottom: 10px;
            width: 100%;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-right: 10px;
        }
        button:hover {
            background-color: #0056b3;
        }
        .back {
            margin-top: 20px;
            display: inline-block;
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
            margin-right: 10px;
        }
        .login {
            margin-top: 20px;
            display: inline-block;
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="overlay">
        <h1>Register</h1>
        <form action="register.php" method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Register</button>
        </form>
        <a href="login.php" class="back">Back</a>
        <a href="login.php" class="login">Login</a>
    </div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validasi kolom yang tidak boleh kosong
    if (!empty($username) && !empty($password) && !empty($email)) {
        // Hash password sebelum menyimpannya ke database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Lakukan koneksi ke database
        $servername = "localhost";
        $db_username = "root";
        $db_password = ""; 
        $dbname = "db_trainline";

        $conn = new mysqli($servername, $db_username, $db_password, $dbname);

        // Periksa koneksi database
        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        // Persiapkan statement SQL
        $stmt = $conn->prepare("INSERT INTO user (username, password, email) VALUES (?, ?, ?)");

        // Periksa apakah statement berhasil dipersiapkan
        if ($stmt === false) {
            die("Error prepare: " . $conn->error);
        }

        // Binding parameter ke statement SQL
        $bind = $stmt->bind_param("sss", $username, $hashed_password, $email);

        // Periksa apakah binding berhasil
        if ($bind === false) {
            die("Error bind_param: " . $stmt->error);
        }

        // Eksekusi statement SQL
        $exec = $stmt->execute();

        // Periksa apakah eksekusi berhasil
        if ($exec) {
            echo "<script>alert('Welcome to W-Bank, we are happy to be able to help you, your happiness is our responsibility, enjoy our features and if you have any criticism or suggestions please contact us, thank you');</script>";
        } else {
            die("Error execute: " . $stmt->error);
        }

        // Tutup statement dan koneksi database
        $stmt->close();
        $conn->close();
    } else {
        echo "<p style='color: red;'>Semua kolom harus diisi!</p>";
    }
}
?>
</body>
</html>
