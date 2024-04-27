<?php
session_start();

require_once "db.php";

$conn = db();

// Подготовка запроса
$stmt = $conn->prepare("SELECT * FROM clients WHERE email = ?");
$stmt->bind_param("s", $email);

// Получение данных из формы
$email = $_POST['email'];
$password = $_POST['password'];

// Выполнение запроса
$stmt->execute();
$result = $stmt->get_result();

// Проверка успешного выполнения запроса
if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    $id_client = $row["id_client"];
    // Проверка пароля
    if (password_verify($password, $row["password"])) {
        $_SESSION['id'] = $id_client;
        if($email == "admin@tyrishki.ru"){
          $_SESSION['admin_id'] = $id_client;
        }
        header('Location: /');
    } else {
        echo "Неверный пароль";
    }
} else {
    echo "Такой пользователь не найден";
}

// Закрытие соединения
$stmt->close();
$conn->close();
?>