<?php include 'db.php'; ?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM admin WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $res = $stmt->get_result();
    $admin = $res->fetch_assoc();

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin'] = true;
        header("Location: admin.php");
        exit();
    } 
    else {
        $error = "Невірний логін або пароль.";
    }
}
?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Вхід</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Меню, таке саме як в index.php */
        ul.navbar {
            list-style: none;
            margin: 0;
            padding: 0;
            background-color: #004080;
            display: flex;
            justify-content: flex-start;
            align-items: center;
            height: 50px;
        }
        ul.navbar li {
            margin: 0;
        }
        ul.navbar li a {
            display: block;
            padding: 14px 20px;
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            font-family: Arial, sans-serif;
            transition: background-color 0.3s ease;
        }
        ul.navbar li a:hover {
            background-color: #0066cc;
            color: #fff;
        }
        /* Контейнер */
        .container {
            max-width: 400px;
            margin: 40px auto;
            padding: 0 15px;
            font-family: Arial, sans-serif;
        }
        form input[type="text"], form input[type="password"] {
            width: 100%;
            padding: 8px;
            margin: 8px 0 16px 0;
            box-sizing: border-box;
            font-size: 16px;
        }
        form button {
            background-color: #004080;
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }
        form button:hover {
            background-color: #0066cc;
        }
        .error {
            color: red;
            margin-top: 10px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <header>
        <ul class="navbar">
            <li><a href="index.php">Головна</a></li>
            <li><a href="login.php">Вхід</a></li>
        </ul>
    </header>

    <div class="container">
        <h2>Вхід для адміністратора</h2>
        <form method="POST" action="">
            <input type="text" name="username" placeholder="Логін" required>
            <input type="password" name="password" placeholder="Пароль" required>
            <button type="submit">Увійти</button>
        </form>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
    </div>
</body>
</html>