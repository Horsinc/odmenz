<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="style_tours_page.css">
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
 width:300px;
 margin:auto;
 }
.tbl-content{
 height:100%;
 overflow-x:auto;
 margin-top: 0px;
 border: 1px solid rgba(255,255,255,0.3);
  width: 300px;
  margin-left: auto;
  margin-right: auto;
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
 margin: 150px;
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
  <header class="header">
    <div class="containerr containerr--header">
      <span class="turistic"><a href="index.php" class="textheader">Туришки</a></span>
      <span class="tours"><a href="Tours_page.php" class="textheader">Туры</a></span>
      <span class="okrug_form"><a href="okrug_form.php" class="textheader">Форма</a></span>
      <?php
        session_start();

        if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
            require_once "db.php";
            $conn = db();
            // Получение информации о пользователе
            $id = $_SESSION['id'];
            $result = mysqli_query($conn, "SELECT email FROM clients WHERE id_client = $id");
            $user = mysqli_fetch_assoc($result);
            $user_id = $user['email'];
        } else {
          $user_id = '';
        }
        ?>
			<?php if (isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id'])) : ?>
      <span class="contacts"><a href="adm/index.php" class="textheader">Админка</a></span>
			<?php endif; ?>
      <span class="contacts"><?php echo '<a href=Profile.php>'. $user_id .'</a>'; ?>
        <?php if (isset($_SESSION['id']) && !empty($_SESSION['id'])) : ?>
          <a href="exit.php" class="textheader"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-logout" width="50" height="60" viewBox="-5 6 40 40" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" />
            <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
            <path d="M7 12h14l-3 -3m0 6l3 -3" />
          </svg>
          </a>
          <a href="cart.php" class="textheader"><img src="img/cart_image.png" style="width:30px;"></a>
        <?php else: ?>
				<span class="contacts"><a class="textheader" href="#" id="registrationLink"><img style="scale:1.8;" src="img\untitled.svg"></a></span>
				<?php endif; ?>
      </span>
    </div>
    <div id="registrationBlock" class="container right-panel-active">
      <div class="container__form container--signup">
        <form action="register.php" method="POST" class=form>
          <div id="form1" class="form">
            <h2 class="form__title">Регистрация</h2>
            <input type="text" placeholder="ФИО" class="input" name="fio" />
            <input type="email" placeholder="Email" class="input" name="email" />
            <input type="password" placeholder="Пароль" class="input" name="password" />
            <button class="btn" type="submit">Зарегистрироваться</button>
          </div>
        </form>
      </div>


      <!-- Sign In -->
      <div class="container__form container--signin">
        <form action="login.php" method="POST" class="form">
          <div id="form2" class="form">
          <h2 class="form__title">Вход</h2>
          <input type="email" placeholder="Email" class="input" name="email"/>
          <input type="password" placeholder="Пароль" class="input" name="password"/>
          <a href="#" class="link">Забыли пароль?</a>
          <button class="btn">Войти</button>
          </div>
        </form>
      </div>

      <!-- Overlay -->
      <div class="container__overlay">
        <div class="overlay">
          <div class="overlay__panel overlay--left">
            <button class="btn" id="signIn">Вход</button>
          </div>
          <div class="overlay__panel overlay--right">
            <button class="btn" id="signUp">Регистрация</button>
          </div>
        </div>
      </div>
    </div>

  </header>
  <main>
    <section class="cart">
      <h2 style="margin-top:50px;">Выбор округа</h2>
      <div class="tbl-header">
        <table cellpadding="0" cellspacing="0" border="0">
          <thead>
            <tr>
              <th>Округ</th>
              <th>Выбор</th>
            </tr>
          </thead>
        </table>
      </div>
      <div class="tbl-content">
        <table cellpadding="0" cellspacing="0" border="0">
          <tbody>
            <?php
                require_once "db.php";
                $conn = db();
                if ($conn->connect_error) {
                  die("Ошибка подключения: " . $conn->connect_error);
                }
              $sql = "SELECT name, id_okruga FROM okruga order by id_okruga";
              $result = $conn->query($sql);
              while ($row = $result->fetch_assoc()){
                echo '<tr>';

                  echo '<td>'. $row['name'] . '</td>';
                  echo '<td><button class="button"><a href="region_form.php?id_okruga=' . $row["id_okruga"] . '" class="more-details">				
                        <button class="button-17">Выбрать</button></a></td>';
                echo '</tr>';
              }
            ?>
            
          </tbody>
        </table>
      </div>
    </table>
    </section>
  </main>
</div>
</body>
</html>
