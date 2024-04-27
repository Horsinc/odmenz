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
      <span class="tours"><a href="Tours_page.php" class="textheader">Туры</a></span>
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
    <div id="main_info">
    
            <div class="about-project">
                <h2>О проекте</h2>
                <p>Пеший туризм переживает возрождение популярности во всем мире, и многие организации и правительства принимают меры по поддержке и развитию этой деятельности.</p>
                <p>Данный сайт является некоммерческим проектом по продвижению туризма на территории Российской Федерации.</p>
                <p>Благодаря этому проекту люди могут голосовать за регионы, в которых благодаря пожертвованиям будут развиваться походные тропы</p>
            </div>
            <div class="voting-rules">
                <h2>Правила голосования</h2>
                <ol>
                    <li>Окружной этап – определяется 3 региона в рамках каждого округа для прокладки маршрута. По результатам голосования будет представлен перечень из 24 субъектов РФ для проведения второго этапа голосования (3 от каждого округа).</li>
                    <li>Федеральный этап – в рамках этапа пользователям путем голосования необходимо будет определить Топ-10 регионов из представленных 24.</li>
                </ol>
                <p>Минимальная сумма за каждый голос составляет – 100 рублей, однако максимальная сумма не ограничена, НО она не влияет на «вес» голоса.</p>
            </div>
            <div class="project-development">
                <h2>Развитие проекта</h2>
                <ul>
                    <li>Создание новых пешеходных троп и маршрутов: Строительство и маркировка новых троп расширяет возможности для пешеходного туризма и делает его более доступным.</li>
                    <li>Улучшение существующих троп: Ремонт и обслуживание существующих троп обеспечивает безопасность и комфорт туристов.</li>
                    <li>Создание инфраструктуры для пешеходного туризма: Развитие зон отдыха, кемпингов и других удобств делает пешеходный туризм более привлекательным и доступным для всех.</li>
                </ul>
            </div>
        
      

    </div>
    <div id="registrationBlock" class="container right-panel-active">
      <div class="container__form container--signup">
        <form action="register.php" method="POST" class=form>
          <div id="form1" class="form">
            <h2 class="form__title">Регистрация</h2>
            <input type="text" placeholder="ФИО" class="input" name="fio" />
            <fieldset>
              <legend>Пол:</legend>
              <div>
              <input type="radio" name="male" value=0> Женский<Br>
              <input type="radio" name="male" value=1>Мужской<Br>
              </div>
            </fieldset>
            <input type="email" placeholder="Email" class="input" name="email" />
            <input type="password" placeholder="Пароль" class="input" name="password" />
            <input type="text" placeholder="78005553535" class="input" name="phone_number" />
            <input type="text" placeholder="г.Рязань ул.Бирюзова д.2 к.2" class="input" name="address" />
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