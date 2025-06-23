<?php include 'db.php'; ?>
<?php if (!isset($_SESSION['admin'])) { header("Location: login.php"); exit(); } ?>
<?php
$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM news WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$news = $stmt->get_result()->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $stmt = $conn->prepare("UPDATE news SET title=?, content=? WHERE id=?");
    $stmt->bind_param("ssi", $title, $content, $id);
    $stmt->execute();
    header("Location: admin.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Редагувати новину</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
<h2>Редагувати новину</h2>
<form method="POST">
    <input type="text" name="title" value="<?= $news['title'] ?>" required><br>
    <textarea name="content" required><?= $news['content'] ?></textarea><br>
    <button type="submit">Оновити</button>
</form>
</div>
</body>
</html>