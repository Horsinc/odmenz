<?php
    require_once "isAdmin.php"; //Подгрузка файла isAdmin
    $user_email = isAdmin(); // Запуск метода на проверку сессии админа
?>
<?php  if (isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id'])): ?> 
<html>
<head>
<meta content="text/php; charset=windows-1251">
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body><p>

<div id="main">
        <div id="content">
        <div id="head_image">
        	<div id="slogan">Таблица "Туры"</div>
        </div>
        <div id="text">
<table border=1>
<?php
  // Подключение к базе данных
    require_once "../db.php";

    $conn = db();

  // Проверка соединения
  if (!$conn) {
    die('Ошибка подключения: ' . mysqli_connect_error());
  }

  // Вывод данных из таблицы "Фирмы"
  $sql = "SELECT * FROM hike, pic_hike
	WHERE hike.id_pictures=pic_hike.id_hike_pictures";
  $result = mysqli_query($conn, $sql);

  // Проверка наличия данных
  if (mysqli_num_rows($result) > 0) {
    echo '<table>';
    echo '<tr><th>Айди похода</th><th>Айди картинок</th><th>Картинки</th><th>Название</th><th>Описание</th><th>Стартовая позиция</th><th>Конечная позиция</th><th>Карта маршрута</th><th>Время начала</th><th>Время конца</th><th>Цена</th><th>Айди лидера</th></tr>';
    while ($row = mysqli_fetch_assoc($result)) {
      echo '<tr>';
      echo '<td>' . $row['id_hike'] . '</td>';
      echo '<td>' . $row['id_hike_pictures'] . '</td>';
      echo '<td> <img src="' . $row['picture_tour'] . '" class="pic"> </td>';
      echo '<td>' . $row['name_hike'] . '</td>';
      echo '<td>' . $row['description_hike'] . '</td>';
      echo '<td>' . $row['start_position'] . '</td>';
      echo '<td>' . $row['stop_position'] . '</td>';
      echo '<td>' . $row['kod_map'] . '</td>';
      echo '<td>' . $row['d_start'] . '</td>';
      echo '<td>' . $row['d_stop'] . '</td>';
      echo '<td>' . $row['price_hike'] . '</td>';
      echo '<td>' . $row['id_leader'] . '</td>';
      echo '</tr>';
    }
    echo '</table>';
  } else {
    echo 'Нет данных.';
  }

  // Закрытие соединения
  mysqli_close($conn);
  ?>
</table></p>
<div id = "footer">
</div>
</html>
<?php else: ?>
    <h1> Тебе сюда нельзя </h1>
<?php endif ?>

