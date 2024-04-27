<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Карточка товара</title>
  <link rel="stylesheet" href="style_prod_shop.css">
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

      if ($conn->connect_error) {
        die("Ошибка подключения: " . $conn->connect_error);
      }

      // Get product ID from URL parameter
      $product_id = $_GET['id_product'];
      echo $product_id;
      // Query product details based on ID
      $sql = "SELECT * FROM product WHERE id_product = ". $product_id;
      $result = $conn->query($sql);

      // Check if product exists
      if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Get product images
        $sql_img = "SELECT picture FROM pic_products WHERE id_pictures = " . $row['id_pictures'];
        $result_img = $conn->query($sql_img);

        // Generate product card
        echo '<section class="product-card">';
        echo '<div class="product-image">';

        // Display main image
        $result_img_main=$conn->query($sql_img);
        // Display thumbnails if multiple images exist
        if ($result_img->num_rows == 1) {
          $row_img = $result_img->fetch_assoc();
          echo '<img src="' . $row_img['picture'] . '" class="product-image img.active" id="big">';
        }else{
          $flag=true;
          while (($row_img_main = $result_img_main->fetch_assoc()) and $flag){
            echo '<img src="' . $row_img_main['picture'] . '" class="product-image img.active" id="big">';
            $flag=false;
          }
          echo '<div id="thumbs">';
          while ($row_img = $result_img->fetch_assoc()) {
            echo '<a href="' . $row_img['picture'] . '">';
            echo '<img src="' . $row_img['picture'] . '">';
            echo '</a>';
          }
          echo '</div>';
        }

        echo '</div>';

        echo '<div class="product-info">';
        echo '<div class="name">';
        echo '<h2>' . $row['name'] . '</h2>';
        echo '<p>' . $row['description'] . '</p>';
        echo '</div>';

        echo '<div class="buy">';
        echo '<span class="price">' . $row['price'] . ' Р.</span>';
        echo '<a href="addproducttocart.php?id_product=' . $row["id_product"] . '" class="more-details"><button class="button" style="width:100%;">Купить</button></a>';
        echo '</div>';

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
