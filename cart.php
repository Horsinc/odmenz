<?php     session_start(); ?>
<!DOCTYPE html>
<html lang="ru">

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Корзина</title>
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
td a{
  text-decoration: none;
  color: #f55555db;
  font-weight: 900;
  text-shadow: 0 0 10px #ffffff;
}

.quantity-change{
  border: none;
  border-radius: 20px;
  width: 30px;
  height: 30px;
  margin: 0 5px 0 5px;
  background-color: #22ebc9;
  color:white;
}
.quantity-change:hover{
  background-color: #b5e3db;
}

/* CSS */
.button-17 {
 align-items: center;
 appearance: none;
 background-color: #fff;
 border-radius: 24px;
 border-style: none;
 box-shadow: rgba(0, 0, 0, .2) 0 3px 5px -1px,rgba(0, 0, 0, .14) 0 6px 10px 0,rgba(0, 0, 0, .12) 0 1px 18px 0;
 box-sizing: border-box;
 color: #3c4043;
 cursor: pointer;
 display: inline-flex;
 fill: currentcolor;
 font-family: "Google Sans",Roboto,Arial,sans-serif;
 font-size: 14px;
 font-weight: 500;
 height: 48px;
 justify-content: center;
 letter-spacing: .25px;
 line-height: normal;
 max-width: 100%;
 overflow: visible;
 padding: 2px 24px;
 position: relative;
 text-align: center;
 text-transform: none;
 transition: box-shadow 280ms cubic-bezier(.4, 0, .2, 1),opacity 15ms linear 30ms,transform 270ms cubic-bezier(0, 0, .2, 1) 0ms;
 user-select: none;
 -webkit-user-select: none;
 touch-action: manipulation;
 width: auto;
 will-change: transform,opacity;
 z-index: 0;
}

.button-17:hover {
 background: #F6F9FE;
 color: #174ea6;
}

.button-17:active {
 box-shadow: 0 4px 4px 0 rgb(60 64 67 / 30%), 0 8px 12px 6px rgb(60 64 67 / 15%);
 outline: none;
}

.button-17:focus {
 outline: none;
 border: 2px solid #4285f4;
}

.button-17:not(:disabled) {
 box-shadow: rgba(60, 64, 67, .3) 0 1px 3px 0, rgba(60, 64, 67, .15) 0 4px 8px 3px;
}

.button-17:not(:disabled):hover {
 box-shadow: rgba(60, 64, 67, .3) 0 2px 3px 0, rgba(60, 64, 67, .15) 0 6px 10px 4px;
}

.button-17:not(:disabled):focus {
 box-shadow: rgba(60, 64, 67, .3) 0 1px 3px 0, rgba(60, 64, 67, .15) 0 4px 8px 3px;
}

.button-17:not(:disabled):active {
 box-shadow: rgba(60, 64, 67, .3) 0 4px 4px 0, rgba(60, 64, 67, .15) 0 8px 12px 6px;
}

.button-17:disabled {
 box-shadow: rgba(60, 64, 67, .3) 0 1px 3px 0, rgba(60, 64, 67, .15) 0 4px 8px 3px;
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
      <h2>Ваша корзина</h2>
      <div class="tbl-header">
        <table cellpadding="0" cellspacing="0" border="0">
          <thead>
            <tr>
              <th>Наименование</th>
              <th>Цена</th>
              <th>Количество</th>
              <th>Итого</th>
              <th></th>
            </tr>
          </thead>
        </table>
      </div>
      <div class="tbl-content">
        <table cellpadding="0" cellspacing="0" border="0">
          <tbody>
            <?php
            session_start();

            // Retrieve cart data from session (if it exists)
            if (isset($_SESSION['cart'])) {
              $cart = $_SESSION['cart'];
            } else {
              $cart = []; // Initialize empty cart
            }

            if (empty($cart)) {
              echo "Ваша корзина пуста.";
            } else {
              $total = 0;
              foreach ($cart as $productId => $item) {
                $quantity = $item['quantity'];
                $price = $item['price'];
                $name = $item['name'];

                $total += $quantity * $price;
                ?>
                <tr data-product-id="<?php echo $productId; ?>">
                  <td><?php echo $name; ?></td>
                  <td id="price-<?php echo $productId; ?>"><?php echo $price; ?> Р.</td>
                  <td>
                    <button class="quantity-change" data-product-id="<?php echo $productId; ?>" data-action="decrease">-</button>
                    <span id="quantity-<?php echo $productId; ?>"><?php echo $quantity; ?></span>
                    <button class="quantity-change" data-product-id="<?php echo $productId; ?>" data-action="increase">+</button>
                    <input type="hidden" name="quantity_<?php echo $productId; ?>" value="<?php echo $quantity; ?>">
                  </td>
                  <td id="total-<?php echo $productId; ?>"><?php echo $quantity * $price; ?> Р.</td>

                  <td>
                    <a href="cart.php?remove_product=<?php echo $productId; ?>" onclick="return confirm('Удалить товар?')">Удалить</a>
                  </td>
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
          <td colspan="3"><span style="color:white;">Итого:</span></td>
          <td colspan="2"><span style="color:white;" id="total-price"><?php echo $total; ?> Р.</span></td>
        </tr>
      </tfoot>
    </table>
    <a href="oform.php"><button class="button-17">Оформить заказ</button></a>
    </section>
  </main>

  <script>
// Handle quantity change buttons
const quantityButtons = document.querySelectorAll('.quantity-change');
quantityButtons.forEach(button => {
 button.addEventListener('click', function() {
  const productId = this.dataset.productId;
  const action = this.dataset.action;
  const quantityInput = document.querySelector(`input[name="quantity_${productId}"]`);
  const quantitySpan = document.getElementById(`quantity-${productId}`);
  const totalPriceSpan = document.getElementById(`total-${productId}`);

  const itemPrice = document.getElementById(`price-${productId}`); // Extract price without "Р."
  const itemPrice2 = parseFloat(itemPrice.textContent.slice(0, -2)); // Extract price without "Р."

  console.log(itemPrice2);
  let currentQuantity = parseInt(quantitySpan.textContent);

  if (action === 'decrease' && currentQuantity > 1) {
   currentQuantity--;
   // Update total price for this item
   console.log(currentQuantity);
   console.log(totalPriceSpan.textContent);
   totalPriceSpan.textContent = (currentQuantity * itemPrice2).toFixed(2) + ' Р.';
   console.log(totalPriceSpan.textContent);
  } else if (action === 'increase') {
   currentQuantity++;
   console.log(currentQuantity);
   console.log(itemPrice2);
   // Update total price for this item
   totalPriceSpan.textContent = (currentQuantity * itemPrice2).toFixed(2) + ' Р.';
  }

  quantitySpan.textContent = currentQuantity;
  quantityInput.value = currentQuantity;

  // Update total price at the bottom of the cart (optional)
  let total = 0;
  const allTotalPrices = document.querySelectorAll('.tbl-content td:nth-child(4)'); // Выбрать все ячейки с итоговой ценой
  allTotalPrices.forEach(priceCell => {
   total += parseFloat(priceCell.textContent.slice(0, -2));
  });
  const totalPriceEl = document.getElementById('total-price');
  totalPriceEl.textContent = total.toFixed(2) + ' Р.';

  // Update cart on server (using AJAX)
  const xhr = new XMLHttpRequest();
  xhr.open('POST', 'oform.php', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onload = function() {
   if (xhr.status === 200) {
    console.log('Quantity updated on server!');
    // Update cart data in cookie (since we're using cookie storage)
    const updatedCart = $_SESSION['cart']; // Get current cart data
    updatedCart[productId].quantity = currentQuantity; // Update quantity for the changed item
    $_SESSION['cart'] = updatedCart; // Update the cart in session
    document.cookie = `cart=${JSON.stringify(updatedCart)}; path=/;`; // Update cookie with updated cart data
   } else {
    console.error('Error updating quantity:', xhr.statusText);
   }
  };
  const data = `product_id=${productId}&quantity=${currentQuantity}`;
  xhr.send(data);
 });
});
// Handle remove product link click
const removeLinks = document.querySelectorAll('.tbl-content a[href*="remove_product"]');
console.log(-1);
removeLinks.forEach(link => {
  console.log(-0.5);
  link.addEventListener('click', function(event) {
    event.preventDefault(); // Prevent default link behavior (page reload)

    const productId = this.getAttribute('href').split('remove_product=')[1];

    // Send AJAX request to remove product from server
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'cart.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    console.log(0);
    xhr.onload = function() {
      if (xhr.status === 200) {
        // Remove product from cart data in session (assuming server-side script handles this)
        console.log(1);
        // Update cart table and total price (similar to quantity change)
        const productRow = document.querySelector(`tr[data-product-id="${productId}"]`);
        productRow.parentNode.removeChild(productRow);

        // Recalculate total price
        let total = 0;
        const allTotalPrices = document.querySelectorAll('.tbl-content td:nth-child(4)');
        allTotalPrices.forEach(priceCell => {
          total += parseFloat(priceCell.textContent.slice(0, -2));
          console.log(2);
        });
        const totalPriceEl = document.getElementById('total-price');
        totalPriceEl.textContent = total.toFixed(2) + ' Р.';
      } else {
        console.error('Error removing product:', xhr.statusText);
      }
    };
    const data = `remove_product=${productId}`;
    xhr.send(data);
  });
});
  </script>
</body>
</html>


