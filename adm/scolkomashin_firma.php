<html>
<head>
<meta content="text/php; charset=windows-1251">
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body><p>

<div id="main">
        <div id="content">
        <div id="head_image">
        	<div id="slogan">Сколько машин в ассортименте у каждой фирмы</div>
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
  $sql = "SELECT firma.name as Name, Count(car.kod_firma) AS count_car FROM car INNER JOIN firma ON car.kod_firma = firma.kod_firma  GROUP BY firma.name;";
  $result = mysqli_query($conn, $sql);

  // Проверка наличия данных
  if (mysqli_num_rows($result) > 0) {
    echo '<table>';
    echo '<tr><th>Название фирмы</th><th>Кол-во машин</th></tr>';
    while ($row = mysqli_fetch_assoc($result)) {
      echo '<tr>';
      echo '<td style="text-align:center">' . $row['Name'] . '</td>';
      echo '<td style="text-align:center">' . $row['count_car'] . '</td>';
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