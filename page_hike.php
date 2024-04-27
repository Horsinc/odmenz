<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Карточка товара</title>
  <link rel="stylesheet" href="style_hike_shop.css">
</head>

<body>
  <header>
    <h1>Туришки</h1>
    <nav>
      <a href="#">О нас</a>
      <a href="#">Туры</a>
      <a href="#">Экипировка</a>
      <a href="#">Контакты</a>
    </nav>
  </header>
  <main>
    <?php
      // Database connection (same as before)
    require_once "db.php";

    $conn = db();
      $month = [
      '01'  => 'Января',
      '02'  => 'Февраля',
      '03'  => 'Марта',
      '04'  => 'Апреля',
      '05'  => 'Мая',
      '06'  => 'Июня',
      '07'  => 'Июля',
      '08'  => 'Августа',
      '09'  => 'Сентября',
      '10' => 'Октября',
      '11' => 'Ноября',
      '12' => 'Декабря'
      ];

      if ($conn->connect_error) {
        die("Ошибка подключения: " . $conn->connect_error);
      }

      // Get product ID from URL parameter
      $id_hike = $_GET['id_hike'];
      echo $id_hike;
      // Query product details based on ID
      $sql = "SELECT * FROM hike WHERE id_hike = ". $id_hike;
      $result = $conn->query($sql);

      // Check if product exists
      if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Get product images
        $sql_img = "SELECT picture_tour FROM pic_hike WHERE id_hike_pictures = " . $row['id_pictures'];
        $result_img = $conn->query($sql_img);

        // Generate product card
        echo '<section class="product-card">';
        echo '<div class="product-image">';

        // Display main image
        $result_img_main=$conn->query($sql_img);
        // Display thumbnails if multiple images exist
        if ($result_img->num_rows == 1) {
          $row_img = $result_img->fetch_assoc();
          echo '<img src="' . $row_img['picture_tour'] . '" class="product-image img.active" id="big">';
        }else{
          $flag=true;
          while (($row_img_main = $result_img_main->fetch_assoc()) and $flag){
            echo '<img src="' . $row_img_main['picture_tour'] . '" class="product-image img.active" id="big">';
            $flag=false;
          }
          echo '<div id="thumbs">';
          while ($row_img = $result_img->fetch_assoc()) {
            echo '<a href="' . $row_img['picture_tour'] . '">';
            echo '<img src="' . $row_img['picture_tour'] . '">';
            echo '</a>';
          }
          echo '</div>';
        }

        echo '</div>';

        echo '<div class="product-info">';
        echo '<div class="name">';
        echo '<h2>' . $row['name_hike'] . '</h2>';
        echo '<span> Начальная точка: ' . $row['start_position'] . '</span>';
        echo '<br>';
        echo '<span> Конечная точка: ' . $row['stop_position'] . '</span>';
        echo '<br>';
        echo '<span> Начало : ' . date("d " ,strtotime($row['d_start'])) . $month[date('m', strtotime($row['d_start']))] . date(" Y \в H:i ",strtotime($row['d_start'])) .'</span>';
        echo '<br>';
        echo '<span> Конец : ' . date("d " ,strtotime($row['d_stop'])) . $month[date('m', strtotime($row['d_stop']))] . date(" Y \в H:i ",strtotime($row['d_stop'])) .'</span>';
        echo '</div>';

        echo '<div class="buy">';
        echo '<span class="price">' . $row['price_hike'] . ' Р</span>';
        echo '<button class="button">Купить</button>';
        echo '</div>';

        echo '</div>';
        echo '<div class="description">';
          echo '<p>' . nl2br($row['description_hike']) . '</p>';
          echo '<div class="map">' . $row['kod_map'] . '</div>';

        echo '</div>';
        echo '</section>';

      } else {
        echo "Товар не найден.";
      }

      $conn->close();

    ?>
  </main>
  <script>
    var thumbs = document.querySelectorAll('#thumbs > a');
    var big = document.getElementById('big');

    for (var i = 0; i < thumbs.length; i++) {
      thumbs[i].addEventListener('click', function (e) {
        e.preventDefault();
        big.src = this.href;
      });
    }
  </script>
</body>

</html>
