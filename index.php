<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Туришки</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" />
  <link rel="stylesheet" href="style.css" />
  <script src="js.js"></script>
</head>


<body>
  <header class="header">
    <div class="containerr containerr--header">
      <span class="turistic"><a href="index.php" class="textheader">Туришки</a></span>
      <span class="about-us"><a href="2.html" class="textheader">О нас</a></span>
      <span class="tours"><a href="Tours_page.php" class="textheader">Туры</a></span>
      <span class="equipment"><a href="all_product_page.php" class="textheader">Экипировка</a></span>
      <span class="contacts"><a href="2.html" class="textheader">Контакты</a></span>
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
  <section>
    <div class="containerr">

    </div>
  </section>
  <section class="tour-section">
    <div class="wrapper">
      <div class="tour">
        <img src="img\pic-tour.png" class="pic-tour"></img>
        <div class="wrapper-2">
          <span class="day-tour">10-24</span><span class="month-tour">апреля</span><span
            class="place-tour">Байкал</span>
        </div>
        <img src="img\Arrow 1.png" class="img-arrow-1">
        <span class="title-tour">Посмотрите все<br />направления туров</span><span class="description-tour">Байкал –
          место с удивительно красивой природой и уникальной
          экосистемой.Достопримечательности Байкала – это не только уникальная
          природа, но и рукотворные памятники.</span>
        <form action="Page_tours.php" target="_blank">
          <div class="wrapper-3"><button class="smotretvsem-tour-button">Смотреть все</button></div>
        </form>
      </div>
  </section>
  <section class="mini-shop-section">
    <div class="mini-shop">
      <div class="tovar-1">
        <span class="span">Изготовлен для самых первых шагов со всеми удобствами</span>
        <img src="img\pic-tovar1.png" class="pic-tovar1"></img>
        <span class="span-3">Набор “Новичок”</span><span class="span-4">7.990₽</span>
        <button class="button">
          <span>Добавить</span>
          <div class="cart">
            <svg viewBox="0 0 36 26">
              <polyline points="1 2.5 6 2.5 10 18.5 25.5 18.5 28.5 7.5 7.5 7.5"></polyline>
              <polyline points="15 13.5 17 15.5 22 10.5"></polyline>
            </svg>
          </div>
        </button>
      </div>
      <div class="tovar-2">
        <span class="novice-set">Набор “Новичок”</span>
        <img src="img/pic-tovar2.png" class="pic-tovar2"> </img>
        <span class="convenient-first-steps">Изготовлен для самых первых шагов со всеми удобствами</span>
        <span class="ruble">7.990₽</span>
        <button class="button">
          <span>Добавить</span>
          <div class="cart">
            <svg viewBox="0 0 36 26">
              <polyline points="1 2.5 6 2.5 10 18.5 25.5 18.5 28.5 7.5 7.5 7.5"></polyline>
              <polyline points="15 13.5 17 15.5 22 10.5"></polyline>
            </svg>
          </div>
        </button>
      </div>
      <div class="tovar-3">
        <span class="convenient-first-steps-9">Изготовлен для самых первых шагов со всеми удобствами</span>
        <img src="img\pic-tovar3.png" class="pic-tovar3"></img>
        <span class="nabir-novichok">Набор “Новичок”</span><span class="ruble-b">7.990₽</span>
        <button class="button">
          <span>Добавить</span>
          <div class="cart">
            <svg viewBox="0 0 36 26">
              <polyline points="1 2.5 6 2.5 10 18.5 25.5 18.5 28.5 7.5 7.5 7.5"></polyline>
              <polyline points="15 13.5 17 15.5 22 10.5"></polyline>
            </svg>
          </div>
        </button>
      </div>
    </div>
  </section>


  <script src="js.js"></script>
  <script>
    var registrationLink = document.getElementById('registrationLink');
    var registrationBlock = document.getElementById('registrationBlock');
    var isVisible = false;

    registrationLink.addEventListener('click', function (event) {
      event.preventDefault();

      if (isVisible) {
        registrationBlock.classList.remove('visible');
        setTimeout(function () {
          registrationBlock.style.display = 'none';
        }, 500);
      } else {
        registrationBlock.style.display = 'block';
        setTimeout(function () {
          registrationBlock.classList.add('visible');
        }, 10);
      }

      isVisible = !isVisible;
    });
  </script>
  <script>

    const signInBtn = document.getElementById("signIn");
    const signUpBtn = document.getElementById("signUp");
    const fistForm = document.getElementById("form1");
    const secondForm = document.getElementById("form2");
    const container = document.querySelector(".container");

    signInBtn.addEventListener("click", () => {
      container.classList.remove("right-panel-active");
    });

    signUpBtn.addEventListener("click", () => {
      container.classList.add("right-panel-active");
    });

    fistForm.addEventListener("submit", (e) => e.preventDefault());
    secondForm.addEventListener("submit", (e) => e.preventDefault());
  </script>
</body>

</html>