<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="style_tours_page.css">
</head>
<body>
  <header class="header">
    <div class="containerr containerr--header">
      <span class="turistic"><a href="2.php" class="textheader">Туришки</a></span>
      <span class="about-us"><a href="2.html" class="textheader">О нас</a></span>
      <span class="tours"><a href="Tours_page.php" class="textheader">Туры</a></span>
      <span class="equipment"><a href="2.php" class="textheader">Экипировка</a></span>
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
  <?php
    require_once "db.php";

    $conn = db();

    if ($conn->connect_error) {
      die("Ошибка подключения: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM hike order by id_pictures";
    $result = $conn->query($sql);

    $sql_img = "SELECT hike.id_pictures, pic_hike.picture_tour FROM hike, pic_hike
	WHERE hike.id_pictures=pic_hike.id_hike_pictures order by hike.id_pictures";
    $result_img = $conn->query($sql_img);

    echo '<div class="mini-shop">';
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo '<div class="tovar-2" data-product-id="' . $row["id"] . '">';

        // Load product images (same as before)
        $images = [];
        $result_img->data_seek(0);
        while ($row_img = $result_img->fetch_assoc()) {
          if ($row_img['id_pictures'] == $row['id_pictures']) {
            $images[] = $row_img['picture_tour'];
          } 
        }

        // Generate image display based on number of images
        if (count($images) > 1) {
          echo '<div class="tovar-img">';
          echo '<button class="prev-slide">&#8249;</button>';
          foreach ($images as $image) {
            echo '<img src="' . $image . '" class="pic-tovar2" alt="' . $row["name"] . '">';
          }
          echo'<button class="next-slide">›</button>';
          echo '</div>'; // tovar-img
        } else {
          echo '<img src="' . $images[0] . '" class="pic-tovarone" alt="' . $row["name"] . '">';
        }

        echo '<span class="novice-set">' . $row["name_hike"] . '</span>';
        echo '<span class="convenient-first-steps">' . $row["description_hike"] . '</span>';
        echo '<span class="ruble">' . $row["price_hike"] . ' Р.</span>';
        // Add link with product ID
        echo '<a href="page_hike.php?id_hike=' . $row["id_hike"] . '" class="more-details">				<button class="button">
					<span>Подробнее</span>
					<div class="cart">
						<svg viewBox="0 0 36 26">
							<polyline points="1 2.5 6 2.5 10 18.5 25.5 18.5 28.5 7.5 7.5 7.5"></polyline>
							<polyline points="15 13.5 17 15.5 22 10.5"></polyline>
						</svg>
					</div>
				</button></a>';
        echo '</div>'; // tovar-2
      }
    } else {
      echo "Товаров не найдено.";
    }

    $conn->close();
  ?>
</div>
  <script>
      const sliders = document.querySelectorAll('.tovar-img');
  console.log("JS подключен");

  sliders.forEach(slider => {
    const slides = slider.querySelectorAll('.pic-tovar2');
    let currentSlide = 0;
    slides[currentSlide].classList.add('active');
    function showSlide(n) {
      slides[currentSlide].classList.remove('active');
      currentSlide = n;

      if (currentSlide < 0) {
        currentSlide = slides.length - 1;
      } else if (currentSlide >= slides.length) {
        currentSlide = 0;
      }

      slides[currentSlide].classList.add('active');
    }

    slider.querySelector('.prev-slide').addEventListener('click', () => showSlide(currentSlide - 1));
    slider.querySelector('.next-slide').addEventListener('click', () => {
    console.log(currentSlide+1);   showSlide(currentSlide + 1);});
  });
  </script>
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
