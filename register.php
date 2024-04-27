<?php
require_once "db.php";

$conn = db();

// Подготовка данных
$fio = $_POST['fio'];
$email = $_POST['email'];
$password = password_hash($_POST['password'],PASSWORD_BCRYPT);
$address= $_POST['address'];
$phone_number= $_POST['phone_number'];
$male=$_POST['male'];
// Подготовка запроса
$sql="INSERT INTO clients (email, password, fio, phone_number, male, adress) VALUES ('$email', '$password', '$fio', '$phone_number', '$male', '$address')";
$result = mysqli_query($conn, $sql);
// Выполнение запроса
if ($result==True) {
    echo "Регистрация прошла успешно!";
    header('Location: /');
} else {
    echo "Ошибка регистрации: " . $conn->error;
}

// Закрытие соединения
$stmt->close();
$conn->close();
?>