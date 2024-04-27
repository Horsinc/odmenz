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
$name = $_POST['name'];
$description = $_POST['description'];
$model = $_POST['model'];
$price = $_POST['price'];
$option = $_POST['option'];
$id_manufacturer = $_POST['id_manufacturer'];

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
// Добавление товара
$sql = "INSERT INTO product (name, description, id_pictures, model, price, options, id_manufacturer) VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql); // Prepare statement

if ($stmt) {
  $bind_ok = mysqli_stmt_bind_param($stmt, "sssssss", $name, $description, $id_pictures, $model, $price, $option, $id_manufacturer);

  if ($bind_ok) {
    if (mysqli_stmt_execute($stmt)) {

    } else {
      echo "Error executing statement: " . mysqli_stmt_error($stmt);
    
  }} else {
    echo "Error binding parameters: " . mysqli_stmt_error($stmt);
  }

  mysqli_stmt_close($stmt); // Close prepared statement
} else {
  echo "Error preparing statement: " . mysqli_error($conn);
}

// Добавление картинок
$sql_img = "INSERT INTO pic_products (id_pictures, picture) VALUES";
foreach ($uploaded_paths as $uploaded_path) {
  $sql_img .= "($id_pictures, '$uploaded_path'),";
}
$sql_img = rtrim($sql_img, ','); // Remove trailing comma
$sql_img .= ";"; // Add semicolon to end the statement
echo $id_pictures;

echo $sql_img;

// Выполнение запроса добавления картинок
if (!mysqli_query($conn, $sql_img)) {
  echo "Ошибка добавления картинок: " . mysqli_error($conn);
  exit;
}



// Закрытие соединения с БД
mysqli_close($conn);