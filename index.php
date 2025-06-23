<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Спортивні новини</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Скидання стилів для списку */
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
        /* Контейнер контенту */
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
        .news-item small {
            color: #666;
        }
    </style>
</head>
<body>
    <!-- Верхня шапка -->
    <header>
        <ul class="navbar">
            <li><a href="index.php">Головна</a></li>
            <li><a href="login.php">Вхід</a></li>
        </ul>
    </header>

    <div class="container">
        <h2>Останні новини</h2>

        <form method="GET">
            <input type="text" name="search" placeholder="Пошук..." value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
            <button type="submit">Шукати</button>
        </form>
        <hr>

        <?php
        $search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
        $query = "SELECT * FROM news";
        if (!empty($search)) {
            $query .= " WHERE title LIKE '%$search%' OR content LIKE '%$search%'";
        }
        $query .= " ORDER BY created_at DESC";

        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='news-item'>";
                echo "<h3>{$row['title']}</h3>";
                echo "<p>{$row['content']}</p>";
                echo "<small>Дата: {$row['created_at']}</small>";
                echo "</div><hr>";
            }
        } else {
            echo "<p>Нічого не знайдено.</p>";
        }
        ?>
    </div>
</body>
</html>