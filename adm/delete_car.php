<!DOCTYPE html>
<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<h1>Список машин</h1>
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
$sql = "SELECT * FROM car";
if($result = mysqli_query($conn, $sql)){
    echo "<table><tr><th>Номер двигателя</th><th>Модель</th><th>Цена</th><th>Цвет</th><th>Мощность двигателя</th><th>Макс. скорость км/ч</th><th>Пробег(км)</th><th>Дата производства</th><th>Б/У</th><th>Код фирмы</th></tr>";
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
            echo "<td><form action='delete.php' method='post'>
                        <input type='hidden' name='id_engine' value='" . $row["id_engine"] . "' />
                        <input type='submit' value='Удалить'>
                   </form></td>";
        echo "</tr>";
    }
    echo "</table>";
mysqli_free_result($result);
} else{
    echo "Ошибка: " . mysqli_error($conn);
}
mysqli_close($conn);
?>
</body>
</html>