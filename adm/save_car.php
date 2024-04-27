<?php
  $host = 'localhost';
  $username = 'root';
  $password = '';
  $database = 'lab2';
  $conn = mysqli_connect($host, $username, $password, $database);

  // Проверка соединения
  if (!$conn) {
    die('Ошибка подключения: ' . mysqli_connect_error());
  }

  // Получение данных из формы
  $id_engine = $_POST['id_engine'];
  $model = $_POST['model'];
  $price = $_POST['price'];
  $color = $_POST['color'];
  $engine_power = $_POST['engine_power'];
  $max_speed = $_POST['max_speed'];
  $run_km = $_POST['run_km'];
  $data = $_POST['data'];
  $used = isset($_POST['used']) ? 1 : 0;
  $kod_firma = $_POST['kod_firma'];

  // Подготовка SQL-запроса для добавления данных в таблицу
  $sql = "INSERT INTO car (id_engine, model, price, color, engine_power, max_speed, run_km, data, used, kod_firma) VALUES ('$id_engine', '$model', '$price', '$color', '$engine_power', '$max_speed', '$run_km', '$data', '$used', '$kod_firma')";

  // Проверка успешного выполнения запроса
  if (mysqli_query($conn, $sql)) {
    echo 'Данные успешно добавлены.';
  } else {
    echo 'Ошибка: ' . mysqli_error($conn);
  }

  // Закрытие соединения
  mysqli_close($conn);
?>