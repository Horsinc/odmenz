<html>
<head>
<meta content="text/php; charset=windows-1251">
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body><p>

<div id="main">
        <div id="content">
        <div id="head_image">
        	<div id="slogan">Список машин, бывших в употреблении, по алфавиту</div>
        </div>
        <div id="text">
<table border=1>
<?php
  // Подключение к базе данных
  $host = 'localhost';
  $username = 'root';
  $password = '';
  $database = 'lab2';
  $conn = mysqli_connect($host, $username, $password, $database);
  // Проверка соединения
  if (!$conn) {
    die('Ошибка подключения: ' . mysqli_connect_error());
  }
  // Вывод данных из таблицы "Машины"
  $sql = "SELECT * FROM car WHERE price > 1200000";
  $result = mysqli_query($conn, $sql);

  // Проверка наличия данных
  if (mysqli_num_rows($result) > 0) {
    echo '<table>';
    echo '<tr><th>Номер двигателя</th><th>Модель</th><th>Цена</th><th>Цвет</th><th>Мощность двигателя</th><th>Макс. скорость км/ч</th><th>Пробег(км)</th><th>Дата производства</th><th>Б/У</th><th>Код фирмы</th></tr>';
    while ($row = mysqli_fetch_assoc($result)) {
      echo '<tr>';
      echo '<td>' . $row['id_engine'] . '</td>';
      echo '<td>' . $row['model'] . '</td>';
      echo '<td>' . $row['price'] . '</td>';
      echo '<td>' . $row['color'] . '</td>';
      echo '<td>' . $row['engine_power'] . '</td>';
      echo '<td>' . $row['max_speed'] . '</td>';
      echo '<td>' . $row['run_km'] . '</td>';
      echo '<td>' . $row['data'] . '</td>';
      echo '<td>' . $row['used'] . '</td>';
      echo '<td>' . $row['kod_firma'] . '</td>';
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