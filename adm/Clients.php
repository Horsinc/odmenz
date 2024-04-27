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
        	<div id="slogan">Таблица "Клиенты"</div>
        </div>
        <div id="text">
<table border=1>
<?php    // Подключение к базе данных
    require_once "../db.php";

    $conn = db();
  // Проверка соединения
  if (!$conn) {
    die('Ошибка подключения: ' . mysqli_connect_error());
  }
  // Вывод данных из таблицы "Клиенты"
  $sql = "SELECT * FROM clients";
  $result = mysqli_query($conn, $sql);

  // Проверка наличия данных
  if (mysqli_num_rows($result) > 0) {
    echo '<table>';
    echo '<tr><th>Айди клиента</th><th>Почта</th><th>Фио</th><th>Номер телефона</th><th>Скидка</th><th>День рождения</th></tr>';
    while ($row = mysqli_fetch_assoc($result)) {
      echo '<tr>';
      echo '<td>' . $row['id_client'] . '</td>';
      echo '<td>' . $row['email'] . '</td>';
      echo '<td>' . $row['fio'] . '</td>';
      echo '<td>' . $row['phone_number'] . '</td>';
      echo '<td>' . $row['discount'] . '</td>';
      echo '<td>' . $row['birthday'] . '</td>';
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
        
        
    


