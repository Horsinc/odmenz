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
        	<div id="slogan">Таблица "Товары"</div>
        </div>
        <div id="text">
<table border=1>
<?php
    require_once "../db.php";

    $conn = db();

  // Проверка соединения
  if (!$conn) {
    die('Ошибка подключения: ' . mysqli_connect_error());
  }

  // Вывод данных из таблицы "Фирмы"
  $sql = "SELECT * FROM product, pic_products
	WHERE product.id_pictures=pic_products.id_pictures";
  $result = mysqli_query($conn, $sql);

  // Проверка наличия данных
  if (mysqli_num_rows($result) > 0) {
    echo '<table>';
    echo '<tr><th>Айди продукта</th><th>Название</th><th>Описание</th><th>айди картинок</th><th>Картинка</th><th>Модель</th><th>Цена</th>
    <th>Опции</th><th>Айди производителя</th></tr>';
    while ($row = mysqli_fetch_assoc($result)) {
      echo '<tr>';
      echo '<td>' . $row['id_product'] . '</td>';
      echo '<td>' . $row['name'] . '</td>';
      echo '<td>' . $row['description'] . '</td>';
      
      echo '<td>' . $row['id_pictures'] . '</td>';
      echo '<td> <img src="' . $row['picture'] . '" class="pic"> </td>';
      echo '<td>' . $row['model'] . '</td>';
      echo '<td>' . $row['price'] . '</td>';
      echo '<td>' . $row['option'] . '</td>';
      echo '<td>' . $row['id_manufacturer'] . '</td>';
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

