<?php
session_start();

$login_error = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Koneksi ke database
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "db_trainline";

    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Persiapkan pernyataan SQL untuk mencari pengguna dengan username yang diberikan
    $stmt = $conn->prepare("SELECT username, password FROM user WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Periksa apakah pengguna ditemukan dan password cocok
    if ($user && password_verify($password, $user['password'])) {
        // Set session jika login berhasil
        $_SESSION['user_id'] = $user['username'];
        $_SESSION['logged_in'] = true;
        header('Location: Admin.php');
        exit;
    } else {
        $login_error = true;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Tiket Kereta Api</title>
    <style>
        /* Styles */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: url('image/2.jpg') no-repeat center center fixed;
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

        input,
        button {
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

        .back,
        .register {
            margin-top: 20px;
            display: inline-block;
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }

        .register {
            margin-left: 10px;
        }
    </style>
</head>

<body>
    <div class="overlay">
        <h1>Login</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <?php if ($login_error) : ?>
        <p style="color: red;">Username atau Password salah. Silakan coba lagi.</p>
        <?php endif; ?>
        <a href="index.php" class="back">Kembali</a>
        <a href="register.php" class="register">Daftar</a>
    </div>
</body>

</html>
