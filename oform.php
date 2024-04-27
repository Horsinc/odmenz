<?php
session_start();
require_once "db.php"; // Assuming you have a separate file named "db.php" for database connection
$db = db(); // Connect to the database


// Handle AJAX request for quantity updates
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'], $_POST['quantity'])) {
  $productId = (int)$_POST['product_id'];

  $quantity = (int)$_POST['quantity'];
  echo $quantity;

  // Check if product ID and quantity are valid
  if (isset($_SESSION['cart'][$productId])) {
    $_SESSION['cart'][$productId]['quantity'] = $quantity; // Update quantity in session
    echo $quantity;
  }

  // Send JSON response back to cart.php
  echo json_encode(['success' => true]);
  exit; // Stop further processing
}

// Handle form submission for order placement
if (isset($_POST['submit'])) {
  // Get data from the form
  $clientId = $_SESSION['id'];
  $address = $_POST['address'];
  $paymentMethod = $_POST['payment_method'];
  $comment = $_POST['comment'];

  // Save address if the user wants to
  if (isset($_POST['save_address'])) {
    $sql = "UPDATE clients SET address = '$adress' WHERE id_client = $clientId";
    mysqli_query($db, $sql);
  }

  // Create a new order
  $sql = "INSERT INTO order_product (id_client, adress, payment_method, status, comment) VALUES ($clientId, '$address', '$paymentMethod', 'собирается', '$comment')";
  if (mysqli_query($db, $sql)) {
    $orderId = mysqli_insert_id($db);
    echo "Order created successfully! Order ID: $orderId";
  } else {
    echo "Error creating order: " . mysqli_error($db);
  }

// Add products to the order
foreach ($_SESSION['cart'] as $item) {
  $productId = $item['id_product']; // Get the product ID
  $quantity = $item['quantity']; // Get the quantity

  // Insert the product with correct values
  for ($i = 0; $i < $quantity; $i++) {
    $sql = "INSERT INTO products_order (id_order, id_product) VALUES ($orderId, $productId)";
    mysqli_query($db, $sql);
  }
}
  // Clear the cart
  unset($_SESSION['cart']);

  // Redirect to order confirmation page
  header("Location: confirm.php?id_order=$orderId");
}

?>

<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Оформление заказа</title>
<style>

h2{
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
    <section class="cart">
      <h2>Оформление заказа</h2>
      <form action="######" method="post">
        <p>Введите адрес доставки:</p>
        <input type="text" name="address" value="<?php echo $_SESSION['address']; ?>" required>
        <br>
        <p>Сохранить адрес для будущих заказов:</p>
        <input type="checkbox" name="save_address" checked>
        <br>
        <p>Выберите способ оплаты:</p>
        <select name="payment_method">
          <option value="Наличные деньги">Наличные деньги</option>
          <option value="Банковская карта">Банковская карта</option>
        </select>
        <br>
        <p>Комментарий к заказу:</p>
        <textarea name="comment"></textarea>
        <br>
        <br>
        <input type="submit" name="submit" value="Оформить заказ">
      </form>
  <div class="tbl-header">
    <table cellpadding="0" cellspacing="0" border="0">
      <thead>
          <tr>
            <th>Наименование</th>
            <th>Цена</th>
            <th>Количество</th>
            <th>Итого</th>
          </tr>
      </thead>
    </table>
  </div>
   <div class="tbl-content">
    <table cellpadding="0" cellspacing="0" border="0">
      <tbody>
          <?php
          if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
            echo "Ваша корзина пуста.";
          } else {
            $total = 0;
            foreach ($_SESSION['cart'] as $item) {
              $total += $item['quantity'] * $item['price'];
              ?>
              <tr>
                <td><?php echo $item['name']; ?></td>
                <td><?php echo $item['price']; ?> Р.</td>
                <td><?php echo $item['quantity']; ?></td>
                <td><?php echo $item['quantity'] * $item['price']; ?> Р.</td>
              </tr>
              <?php
            }
          }

          ?>
      </tbody>
    </table>
  </div>
        <tfoot>
          <tr>
            <td colspan="3">Итого:</td>
            <td colspan="2"><?php echo $total; ?> Р.</td>
          </tr>
        </tfoot>
      </table>
    </section>
  </main>

</body>
</html>

<?php

// Закрытие соединения с базой данных
mysqli_close($db);

?>