<?php
    require_once "isAdmin.php"; //Подгрузка файла isAdmin
    $user_email = isAdmin(); // Запуск метода на проверку сессии админа
?>
<?php  if (isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id'])): ?> 


<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Веб-интерфейс к базе данных</title>
  <style>
.button {
  position: relative;
  display: inline-block;
  /* width: 200px;
  height: 60px; */
  text-align: center;
  line-height: 60px;
  color: #fff;
  font-size: 24px;
  text-transform: uppercase;
  text-decoration: none;
  font-family: sans-serif;
  box-sizing: border-box;
  background: linear-gradient(90deg, #03a9f4, #f441a5, #ffeb3b, #03a9f4);
  background-size: 400%;
  border-radius: 30px;
  z-index: 1;
  left: 50%;
  transform: translate(-50%, 0);
}
 
.button:hover {
  animation: animate 8s linear infinite;
}
 
@keyframes animate {
  0% {
    background-position: 0%;
  }
  100% {
    background-position: 400%;
  }
}
 
.button:before {
  content: "";
  position: absolute;
  top: -5px;
  right: -5px;
  bottom: -5px;
  left: -5px;
  z-index: -1;
  background: linear-gradient(90deg, #03a9f4, #f441a5, #ffeb3b, #03a9f4);
  background-size: 400%;
  border-radius: 40px;
  opacity: 0;
  transition: .5s;
}
 
.button:hover:before {
  filter: blur(20px);
  opacity: 1;
  animation: animate 8s linear infinite;
}

body {
  background-color: #111111;
color: #ffffff;
}
</style>
</head>
<body>
  <h1 style="text-align:center;font-family:Montserrat;">Выберите действие</h1>
    <a href="Clients.php"><button class="button">Клиенты</button></a><br><br>
    <a href="Products.php"><button class="button">Товары</button></a><br><br>
    <a href="Tours.php"><button class="button">Туры</button></a><br><br>
    <!-- <a href="add_car.php"><button class="button">Добавить Машину</button></a><br><br>
    <a href="delete_car.php"><button class="button">Удалить Машину</button></a><br><br> -->
    <a href="add_product.php"><button class="button">Добавить Товар</button></a><br><br>
    <a href="add_tour.php"><button class="button">Добавить Тур</button></a><br><br>
    <!-- <a href="delete_firma.php"><button class="button">Удалить Фирму</button></a><br><br> -->
    <!-- <a href="equiconnection.php"><button class="button">Естественное соединение</button></a><br><br>
    <a href="spisok_mashin.php"><button class="button">Список машин, бывших в употреблении, по алфавиту</button></a><br><br>
    <a href="dorozhe_12.php"><button class="button">Машины дороже 1.200.000</button></a><br></li><br>
    <a href="scolkomashin_firma.php"><button class="button">Сколько машин в ассортименте у каждой фирмы</button></a><br><br> -->
</body>
</html>
<?php else: ?>
    <h1> Тебе сюда нельзя </h1>
<?php endif ?>