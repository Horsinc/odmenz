  <?php
    // Database connection and queries (same as before)
    function db(){
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "site";
      $conn = new mysqli($servername, $username, $password, $dbname);
          // Проверка соединения
    if ($conn->connect_error) {
        die("Ошибка подключения: " . $conn->connect_error);
    }
      return $conn;
};


  ?>