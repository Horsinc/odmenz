<?php
  session_start();

  require_once "db.php";
  
  $conn = db();
// Обработка формы
// Получение информации о пользователе
$id = $_SESSION['id'];
if (isset($_POST['quantity'])) {
    $quantity = intval($_POST['quantity']);
    $price = $quantity * 100;

    // Проверка минимальной суммы
    if ($price < 100) {
        header('Location: oplata.php?error= Минимальная сумма покупки - 100');
        exit;
    }

    // Получение ID пользователя
    $userId = $id; // Замените на реальный ID пользователя
    echo $userId;
    // Получение текущего количества голосов
    $sql = "SELECT votes FROM clients WHERE id_client = $userId";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $currentGol = $row['votes'];
    } else {
        $currentGol = 0;
    }

    // Обновление количества голосов
    $newGol = $currentGol + $quantity;
    $sql = "UPDATE clients SET votes = $newGol WHERE id_client = $userId";
    if ($conn->query($sql) === TRUE) {
        // Обновление суммы
        $sql = "UPDATE clients SET sum = sum + $price WHERE id_client = $userId";
        $conn->query($sql);

        // Сообщение об успешной покупке
        echo "<p>Спасибо за покупку! Вы приобрели $quantity голосов.</p>";
    } else {
        echo "<p>Ошибка обновления базы данных: " . $conn->error . "</p>";
    }
}
$conn->close();
?>