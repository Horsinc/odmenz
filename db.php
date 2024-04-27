  <?php
    // Database connection and queries (same as before)
    function db(){
      $servername = "localhost";
      $username = "ynrcdjio_root";
      $password = "36336862";
      $dbname = "ynrcdjio_site";
      $conn = new mysqli($servername, $username, $password, $dbname);
          // Проверка соединения
    if ($conn->connect_error) {
        die("Ошибка подключения: " . $conn->connect_error);
    }
      return $conn;
};


  ?>