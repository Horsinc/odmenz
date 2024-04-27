<?php
session_start();

require_once "db.php";

$conn = db();

// Получение информации о пользователе
$id = $_SESSION['id'];
$result = mysqli_query($conn, "SELECT * FROM clients WHERE id_client = $id");
$user = mysqli_fetch_assoc($result);

// Обработка запросов
if (isset($_POST['edit'])) {
  $phone = $_POST['phone'];
  $birthday = $_POST['birthday'];
  echo 1;
  // Обновление данных
  $sql = mysqli_query($conn, "UPDATE clients SET phone_number = '$phone', birthday = '$birthday' WHERE id_client = $id");
      if($result = mysqli_query($conn, $sql)){
        header("Location: Profile.php");
    } else{
        echo "Ошибка: " . mysqli_error($conn);
    }
  // Перенаправление на страницу профиля
  header('Location: Profile.php');
}

if (isset($_POST['change_password'])) {
  $old_password = $_POST['old_password'];
  $new_password = $_POST['new_password'];

  // Проверка пароля
    $result = mysqli_query($conn, "SELECT password FROM clients WHERE id_client = $id");
    $user = mysqli_fetch_assoc($result);
    $hashed_password = $user['password'];

  if (password_verify($old_password, $hashed_password)) {
    // Хеширование нового пароля
    $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);
    if (password_hash($new_password, PASSWORD_DEFAULT) === false) {
        echo '<p style="color: red;">Ошибка хеширования пароля!</p>';
        exit;
    }

    if (password_verify($old_password, $hashed_password) === false) {
         echo '<p style="color: red;">Ошибка проверки пароля!</p>';
        exit;
    }
    // Обновление пароля
    $sql = mysqli_query($conn, "UPDATE clients SET password = '$hashed_new_password' WHERE id_client = $id");

    // Перенаправление на страницу профиля
    header('Location: Profile.php');
  } else {
    echo '<p style="color: red;">Неверный пароль!</p>';
  }
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Профиль пользователя</title>
  <style>
  h1,h2{
  font-size: 30px;
  color: #fff;
  text-transform: uppercase;
  font-weight: 300;
  text-align: center;
  margin-bottom: 15px;
}
table{
  width:100%;
  table-layout: fixed;
}
.tbl-header{
  background-color: rgba(255,255,255,0.3);
 }
.tbl-content{
  height:300px;
  overflow-x:auto;
  margin-top: 0px;
  border: 1px solid rgba(255,255,255,0.3);
}
th{
  padding: 20px 15px;
  text-align: left;
  font-weight: 500;
  font-size: 12px;
  color: #fff;
  text-transform: uppercase;
}
td{
  padding: 15px;
  text-align: left;
  vertical-align:middle;
  font-weight: 300;
  font-size: 12px;
  color: #fff;
  border-bottom: solid 1px rgba(255,255,255,0.1);
}


/* demo styles */

@import url(https://fonts.googleapis.com/css?family=Roboto:400,500,300,700);
body{
  background: -webkit-linear-gradient(left, #25c481, #25b7c4);
  background: linear-gradient(to right, #25c481, #25b7c4);
  font-family: 'Roboto', sans-serif;
}
section{
  margin: 50px;
}


/* for custom scrollbar for webkit browser*/

::-webkit-scrollbar {
    width: 6px;
} 
::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
} 
::-webkit-scrollbar-thumb {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
}</style>
</head>
<body>
  <h1>Профиль</h1>
    <p>
      <strong>Email:</strong> <?php echo $user['email']; ?>
    </p>
    <p>
      <strong>ФИО:</strong> <?php echo $user['fio']; ?>
    </p>
  <form method="post">
    <p>
      <label for="phone">Номер телефона:</label>
      <input type="tel" name="phone" id="phone" value="<?php echo $user['phone_number']; ?>">
    </p>
    <p>
      <label for="birthday">Дата рождения:</label>
      <input type="date" name="birthday" id="birthday" value="<?php echo $user['birthday']; ?>">
    </p>
    <p><strong>Скидка:</strong> <?php echo $user['discount']; ?></p>
    <input type="submit" name="edit" value="Сохранить">
  </form>

  <h2>Смена пароля</h2>
  <form method="post">
    <p>
      <label for="old_password">Старый пароль:</label>
      <input type="password" name="old_password" id="old_password">
    </p>
    <p>
      <label for="new_password">Новый пароль:</label>
      <input type="password" name="new_password" id="new_password">
    </p>
    <input type="submit" name="change_password" value="Сменить пароль">
  </form>
  <h2 class="tbl-header">Заказы</h2>
  <?php
    session_start();
    require_once "db.php";
    $conn = db();
    $id = $_SESSION['id'];
    $sql = "SELECT id_order, status FROM order_product WHERE id_client = $id";
    $result = mysqli_query($conn, $sql);

  // Проверка наличия данных
  if (mysqli_num_rows($result) > 0) {
    echo '<div class="tbl-header">';
    echo '<table cellpadding="0" cellspacing="0" border="0">';
    echo '<thead>';
    echo '<tr>';
          echo '<th>Номер заказа</th>';
          echo '<th>Статус</th>';
        echo '</tr>';
      echo '</thead>';
    echo '</table>';
  echo '</div>';
  echo '<div class="tbl-content">';
  echo '<table cellpadding="0" cellspacing="0" border="0">';
  echo '<tbody>';
    while ($row = mysqli_fetch_assoc($result)) {
      echo '<tr>';
      echo '<td><a href="confirm.php?id_order=' . $row["id_order"] . '" class="more-details">' . $row['id_order'] . '</td>';
      echo '<td>' . $row['status'] . '</td>';
      echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
    echo '</div>';
  } else {
    echo 'Нет заказов.';
  }
  ?>
</body>
<script>// '.tbl-content' consumed little space for vertical scrollbar, scrollbar width depend on browser/os/platfrom. Here calculate the scollbar width .
$(window).on("load resize ", function() {
  var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
  $('.tbl-header').css({'padding-right':scrollWidth});
}).resize();</script>
</html>