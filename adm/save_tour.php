<?php
// Подключение к базе данных
    require_once "../db.php";

    $conn = db();

// Обработка ошибок подключения
if (!$conn) {
    die('Ошибка подключения: ' . mysqli_connect_error());
}

// Получение данных из формы
$id_hike_pictures = $_POST['id_hike_pictures'];
$id_hike=$_POST['id_hike'];
$name_hike = $_POST['name_hike'];
$description_hike = $_POST['description_hike'];
$start_position = $_POST['start_position'];
$stop_position = $_POST['stop_position'];
$kod_map = $_POST['kod_map'];
$d_start=$_POST['d_start'];
$d_stop=$_POST['d_stop'];
$price_hike = $_POST['price_hike'];
$id_leader = $_POST['id_leader'];


// Обработка загруженных файлов
$files = $_FILES['picture_tour'];

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
    $upload_dir = '../hike_img/';

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
$sql = "INSERT INTO hike (id_hike, id_pictures, name_hike, description_hike, start_position, stop_position,kod_map, d_start, d_stop, price_hike, id_leader) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql); 

if ($stmt) {
  $bind_ok = mysqli_stmt_bind_param($stmt, "sssssssssss", $id_hike, $id_hike_pictures, $name_hike, $description_hike, $start_position, $stop_position, $kod_map, $d_start, $d_stop, $price_hike, $id_leader);

  if ($bind_ok) {
    if (mysqli_stmt_execute($stmt)) {
      echo "Hike data inserted successfully!";
    } else {
      echo "Error executing statement: " . mysqli_stmt_error($stmt);
    }
  } else {
    echo "Error binding parameters: " . mysqli_stmt_error($stmt);
  }

  mysqli_stmt_close($stmt); // Close prepared statement
} else {
  echo "Error preparing statement: " . mysqli_error($conn);
}

// Prepare image insertion (assuming you want prepared statements)
$sql_img = "INSERT INTO pic_hike (id_hike_pictures, picture_tour) VALUES (?, ?)";
$stmt_img = mysqli_prepare($conn, $sql_img);

if ($stmt_img) {
  foreach ($uploaded_paths as $uploaded_path) {
    // Consider mysqli_real_escape_string for uploaded paths to prevent SQL injection
    $bind_img_ok = mysqli_stmt_bind_param($stmt_img, "ss", $id_hike_pictures, $uploaded_path);
    if ($bind_img_ok) {
      if (mysqli_stmt_execute($stmt_img)) {
        // Image inserted successfully (handle for each image)
      } else {
        echo "Error inserting image: " . mysqli_stmt_error($stmt_img);
        break; // Exit loop on error (optional)
      }
    } else {
      echo "Error binding image parameters: " . mysqli_stmt_error($stmt_img);
      break; // Exit loop on error (optional)
    }
  }
  mysqli_stmt_close($stmt_img);
  header("Location: Tours.php");
} else {
  echo "Error preparing image insert statement: " . mysqli_error($conn);
}

// Закрытие соединения с БД
mysqli_close($conn);