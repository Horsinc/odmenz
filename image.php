<?php
    require_once "db.php";

    $conn = db();

  // Проверка соединения
  if (!$conn) {
    die('Ошибка подключения: ' . mysqli_connect_error());
  }

  // Получение данных из формы
  $prod_images = $_POST['prod_images'];


  // Подготовка SQL-запроса для добавления данных в таблицу
  $result="select image from images where id = '. $_GET['id']";
  $result=mysqli_query($conn,$result);
  $numRows = mysqli_num_rows($result);
  // Проверка успешного выполнения запроса

  if($numRows==1){
    $row=mysqli_fetch_assoc($result);
    if(password_verify($password,$row["password"])){
      setcookie('user', $row['email'], time()+3600,"/");
      // Закрытие соединения
      mysqli_close($conn);
      header('Location: /');}
  }
  else{
    echo"Такой пользователь не найден";
    exit();
  }

?>