<?php
  $host = 'localhost';
  $username = 'root';
  $password = '';
  $database = 'lab2';
if(isset($_POST["id_engine"]))
{
    $conn = mysqli_connect($host, $username, $password, $database);
    // Проверка соединения
    if (!$conn) {
      die('Ошибка подключения: ' . mysqli_connect_error());
    }
    $id_engine = mysqli_real_escape_string($conn, $_POST["id_engine"]);
    $sql = "DELETE FROM car WHERE id_engine = '$id_engine'";
    if(mysqli_query($conn, $sql)){
         
        header("Location: Car.php");
    } else{
        echo "Ошибка: " . mysqli_error($conn);
    }
    mysqli_close($conn);    
}
?>