<?php
// Подключение к базе данных
    require_once "../db.php";

    $conn = db();

// Обработка ошибок подключения
if (!$conn) {
    die('Ошибка подключения: ' . mysqli_connect_error());
}

// Получение данных из формы
$id_pictures = $_POST['id_pictures'];

// Обработка загруженных файлов
$files = $_FILES['pictures'];

// Массив для хранения путей к загруженным файлам
$uploaded_paths = [];

// Проверка на ошибки загрузки
if ($files['error'][0] === 0) {

    // Перебираем все загруженные файлы
    for ($i = 0; $i < count($files['name']); $i++) {

        // Получаем имя файла
        $filename = $files['name'][$i];

        // Генерируем уникальное имя файла
        $new_filename = uniqid() . '_' . $filename;

        // Путь к папке для загрузки
        $upload_dir = '../product_img/';

        // Путь к файлу на сервере
        $uploaded_path = $upload_dir . $new_filename;

        // Перемещаем файл в папку на сервере
        move_uploaded_file($files['tmp_name'][$i], $uploaded_path);

        // Добавляем путь к файлу в массив
        $uploaded_paths[] = $uploaded_path;
    }

} else {

    // Ошибка при загрузке файлов
    echo "Ошибка при загрузке файлов!";
    exit;
}
  $sql = "INSERT INTO pic_products (id_pictures, picture) VALUES";
  foreach($uploaded_paths as $uploaded_path) {
    $sql .= '($id_pictures, $$uploaded_path),';
}
  $sql = rtrim($sql, ',');

// Выполнение запроса
if (mysqli_query($conn, $sql)) {

    // Картинки успешно добавлены
    header("Location: Products.php");

} else {
  // Ошибка при добавлении товара
  echo "Ошибка: " . mysqli_error($conn);
}

// Закрытие соединения с БД
mysqli_close($conn);