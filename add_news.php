<?php include 'db.php'; ?>
<?php if (!isset($_SESSION['admin'])) { header("Location: login.php"); exit(); } ?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $stmt = $conn->prepare("INSERT INTO news (title, content) VALUES (?, ?)");
    $stmt->bind_param("ss", $title, $content);
    $stmt->execute();
    header("Location: admin.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Додати новину</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
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
<h2>Додати новину</h2>
<form method="POST">
    <input type="text" name="title" placeholder="Заголовок" required><br>
    <textarea name="content" placeholder="Текст новини" required></textarea><br>
    <button type="submit">Додати</button>
</form>
</div>
</body>
</html>