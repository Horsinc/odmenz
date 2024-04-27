<?php
require_once "db.php";

$conn = db();

// Подготовка данных
$fio = $_POST['fio'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

// Подготовка запроса
$stmt = $conn->prepare("INSERT INTO clients (fio, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $fio, $email, $password);

// Выполнение запроса
if ($stmt->execute()) {
    echo "Регистрация прошла успешно!";
    header('Location: /');
} else {
    echo "Ошибка регистрации: " . $conn->error;
}

// Закрытие соединения
$stmt->close();
$conn->close();
?>