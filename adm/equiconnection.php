<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<title></title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="main">
        <div id="content">
        <div id="head_image">
        	<div id="slogan">Результат запроса</div>
        </div>
        <div id="text">
     
<table  border=1>
<?php 
 // Подключение к базе данных
  $host = 'localhost';
  $username = 'root';
  $password = '';
  $database = 'lab2';
  $conn = mysqli_connect($host, $username, $password, $database);
if (!$conn) {
  die("Ошибка: " . mysqli_connect_error());
}
  $mode = MYSQLI_NUM;
	$sql = "SELECT car.kod_firma, id_engine, model, 
	price, color, engine_power, max_speed, run_km, 
	data, used, firma.name, director, address, phone_number FROM car, 
	firma WHERE car.kod_firma=firma.kod_firma";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    echo '<table>';
    echo '<th>Код фирмы</th><th>Номер двигателя</th><th>Модель</th><th>Цена</th><th>Цвет</th><th>Мощность двигателя</th><th>Макс. скорость км/ч</th><th>Пробег(км)</th><th>Дата производства</th><th>Б/У</th><th>Название фирмы</th><th>Директор</th><th>Адрес фирмы</th><th>Контактный телефон</th>';
    while ($row = mysqli_fetch_assoc($result)) {
      echo '<tr>';
      echo '<td>' . $row['kod_firma'] . '</td>';
      echo '<td>' . $row['id_engine'] . '</td>';
      echo '<td>' . $row['model'] . '</td>';
      echo '<td>' . $row['price'] . '</td>';
      echo '<td>' . $row['color'] . '</td>';
      echo '<td>' . $row['engine_power'] . '</td>';
      echo '<td>' . $row['max_speed'] . '</td>';
      echo '<td>' . $row['run_km'] . '</td>';
      echo '<td>' . $row['data'] . '</td>';
      echo '<td>' . $row['used'] . '</td>';
      echo '<td>' . $row['name'] . '</td>';
      echo '<td>' . $row['director'] . '</td>';
      echo '<td>' . $row['address'] . '</td>';
      echo '<td>' . $row['phone_number'] . '</td>';
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
</body>
</html>
