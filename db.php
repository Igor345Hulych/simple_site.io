<?php
$conn = new mysqli("localhost", "root", "", "sports_site");
if ($conn->connect_error) {
    die("Помилка з'єднання: " . $conn->connect_error);
}
session_start();
?>