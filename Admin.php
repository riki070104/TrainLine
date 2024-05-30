<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/admin.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <input type="checkbox" id="checkbox">
    <div class="body">
        <nav class="side-bar">
            <div class="user-p">
                <img src="image/TrainLine.png">
            </div>
            <ul>
                <li>
                    <a href="Admin.php">
                        <i class="Dasboard" aria-hidden="true"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="Booking.php">
                        <i class="Booking" aria-hidden="true"></i>
                        <span>Booking</span>
                    </a>
                </li>
                <li>
                    <a href="kategori.php">
                        <i class="Kategori" aria-hidden="true"></i>
                        <span>Categoris</span>
                    </a>
                </li>
                <li>
                    <a href="trasaction.php">
                        <i class="Trasaction" aria-hidden="true"></i>
                        <span>Transaction</span>
                    </a>
                </li>
                <li>
                    <a href="Logout.php">
                        <i class="Logout" aria-hidden="true"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </nav>
        <section class="section-1">
            <h1>WELCOME</h1>
            <p>Admin</p>
        </section>
    </div>

</body>

</html>