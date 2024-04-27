<?php

session_start();

// Подключение к базе данных
            require_once "db.php";
            $db = db();

// Получение ID заказа
$id_order = $_GET['id_order'];

// Получение информации о заказе
$sql = "SELECT * FROM order_product WHERE id_order = $id_order";
$result = mysqli_query($db, $sql);
$order = mysqli_fetch_assoc($result);

// Получение товаров в заказе
$sql = "SELECT product.name, product.price FROM products_order JOIN product ON product.id_product = products_order.id_product WHERE products_order.id_order = $id_order";
$result = mysqli_query($db, $sql);
$products = mysqli_fetch_all($result, MYSQLI_ASSOC);

$sql = "SELECT COUNT(id_product) as count FROM products_order WHERE id_order = $id_order group by id_product";
$result = mysqli_query($db, $sql);
$count = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Подтверждение заказа</title>
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
      <h2>Подтверждение заказа №<?php echo $id_order; ?></h2>

      <p>Ваш заказ успешно оформлен!</p>

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
          $total = 0;
          $n=$count['count'];
          foreach ($products as $product) {

            $total += $product['price']*$n;
            ?>
            <?php if(($product['name']==null)||($name!=$product['name'])){
            echo '<tr>';
                echo '<td>';
                            echo $product['name'];
                            $name=$product['name'];
                            '</td>';
                            echo '<td>'. $product['price'] .'Р.</td>';
                            echo '<td>'. $n.'</td>';
                            
                            echo '<td>'. $n * $product['price'] .'Р.</td>';
                            $n=1;
                        }
                        else{
                            $n++;


            echo '</tr>';
            }
                ?>
            <?php
          }
          ?>
      </tbody>
    </table>
  </div>
        <tfoot>
          <tr>
            <td colspan="1">Итого:</td>
            <td colspan="2"><?php echo $total; ?> Р.</td>
          </tr>
        </tfoot>
      </table>

      <p><strong>Адрес доставки:</strong> <?php echo $order['adress']; ?></p>
      <p><strong>Способ оплаты:</strong> <?php echo $order['payment_method']; ?></p>
      <p><strong>Комментарий:</strong> <?php echo $order['comment']; ?></p>

      <p>Спасибо за ваш заказ!</p>
    </section>
  </main>

</body>
</html>

<?php

// Закрытие соединения с базой данных
mysqli_close($db);

?>