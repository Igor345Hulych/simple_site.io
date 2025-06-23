<?php include 'db.php'; ?>
<?php if (!isset($_SESSION['admin'])) { header("Location: login.php"); exit(); } ?>
<?php
$id = $_GET['id'];
$stmt = $conn->prepare("DELETE FROM news WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
header("Location: admin.php");
exit();
?>