<?php
session_start();
require "koneksiMVC.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $NIM = $_POST['NIM'];
    $password = $_POST['password'];

    $query = $mysqli->query("SELECT * FROM pengguna WHERE NIM = '$NIM' AND password = '$password'");
    $user = $query->fetch_assoc();

    if ($user) {
        $_SESSION['NIM'] = $user['NIM'];
        $_SESSION['nama'] = $user['nama'];
        $_SESSION['role'] = $user['role'];
        header("Location: admin.php"); // Arahkan ke halaman administrasi
        exit;
    } else {
        $error = "NIM atau password salah!";
    }
}
?>

<html>
<head>
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            height: 100vh;
            margin: 0;
        }
        h2 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }
        form {
            width: 100%;
            max-width: 320px;
            padding: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
            width: 100%;
            font-weight: bold;
            text-transform: uppercase;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .error {
            color: red;
            font-size: 14px;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <form method="post" action="">
        <h2>Login</h2>
        <label>NIM:</label>
        <input type="text" name="NIM" required>
        <label>Password:</label>
        <input type="password" name="password" required>
        <input type="submit" value="Login">
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
    </form>
</body>
</html>