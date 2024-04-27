<?php


session_start();

    // Database connection (same as before)
require_once "db.php";

$conn = db();

if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}
// Get product ID from URL parameter
$product_id = $_GET['id_product'];

// Check if product exists in database
$sql = "SELECT * FROM product WHERE id_product = " . $product_id;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // Get product details
  $row = $result->fetch_assoc();

  // Add product to cart
  if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
  }

  $product = array(
    'id_product' => $row['id_product'],
    'name' => $row['name'],
    'price' => $row['price'],
    'quantity' => 1,
  );

  // Check if product already exists in cart
  $exists = false;
  foreach ($_SESSION['cart'] as &$item) {
    if ($item['id_product'] === $product_id) {
      $item['quantity']++;
      $exists = true;
      break;
    }
  }

  if (!$exists) {
    $_SESSION['cart'][] = $product;
  }

  // Redirect to cart page
  header('Location: cart.php');
} else {
  // Product not found
  echo "Товар не найден.";
}

?>