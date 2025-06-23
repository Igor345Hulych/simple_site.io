<?php include 'db.php'; ?>
<?php if (!isset($_SESSION['admin'])) { header("Location: login.php"); exit(); } ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Адмін - Новини</title>
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
            max-width: 900px;
            margin: 20px auto;
            padding: 0 15px;
            font-family: Arial, sans-serif;
        }
        /* Стилі для новин */
        .news-item h3 {
            color: #004080;
        }
        .news-item p {
            line-height: 1.5;
        }
        .actions a {
            color: #004080;
            text-decoration: none;
            font-weight: bold;
            margin-right: 10px;
        }
        .actions a:hover {
            text-decoration: underline;
        }
        a.logout-link {
            color: #d00;
            font-weight: bold;
            margin-right: 15px;
            text-decoration: none;
        }
        a.logout-link:hover {
            text-decoration: underline;
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
        <h2>Новини</h2>
        <a class="logout-link" href="logout.php">Вийти</a> | <a href="add_news.php">Додати новину</a>
        <hr>
        <?php
        $result = $conn->query("SELECT * FROM news ORDER BY created_at DESC");
        while ($row = $result->fetch_assoc()) {
            echo "<div class='news-item'>";
            echo "<h3>{$row['title']}</h3>";
            echo "<p>{$row['content']}</p>";
            echo "<div class='actions'>";
            echo "<a href='edit_news.php?id={$row['id']}'>Редагувати</a> | ";
            echo "<a href='delete_news.php?id={$row['id']}'>Видалити</a>";
            echo "</div></div><hr>";
        }
        ?>
    </div>
</body>
</html>