<!DOCTYPE html>
<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<h1>Список фирм</h1>
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
$sql = "SELECT * FROM firma";
if($result = mysqli_query($conn, $sql)){
    echo "<table><tr><th>Номер фирмы</th><th>Название фирмы</th><th>Директор</th><th>Адрес фирмы</th><th>Контактный телефон</th></tr>";
while ($row = mysqli_fetch_assoc($result)) {
      echo '<tr>';
      echo '<td>' . $row['kod_firma'] . '</td>';
      echo '<td>' . $row['name'] . '</td>';
      echo '<td>' . $row['director'] . '</td>';
      echo '<td>' . $row['address'] . '</td>';
      echo '<td>' . $row['phone_number'] . '</td>';
            echo "<td><form action='delete2.php' method='post'>
                        <input type='hidden' name='kod_firma' value='" . $row["kod_firma"] . "' />
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