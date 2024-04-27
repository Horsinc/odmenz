<?php
  $host = 'localhost';
  $username = 'root';
  $password = '';
  $database = 'lab2';
if(isset($_POST["kod_firma"]))
{
    $conn = mysqli_connect($host, $username, $password, $database);
    // Проверка соединения
    if (!$conn) {
      die('Ошибка подключения: ' . mysqli_connect_error());
    }
    $kod_firma = mysqli_real_escape_string($conn, $_POST["kod_firma"]);
    $sql = "DELETE FROM firma WHERE kod_firma = '$kod_firma'";
    if(mysqli_query($conn, $sql)){
         
        header("Location: firma.php");
    } else{
        echo "Ошибка: " . mysqli_error($conn);
    }
    mysqli_close($conn);    
}
?>