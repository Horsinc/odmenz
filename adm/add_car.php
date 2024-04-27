<html>
<head>
<meta content="text/php; charset=windows-1251">
<link href="style.css" rel="stylesheet" type="text/css" />
<style>
  .button {
	background: linear-gradient(to right, violet, blue);
	font-family: Montserrat;
	color: white;
	padding: 10px 20px;
	border: none;
	border-radius: 5px;
	box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
	transition: background 0.3s ease;
}

.button:hover {
	background: linear-gradient(to right, violet, blue);
	position: relative;
}

.button:hover::before {
	content: '';
	position: absolute;
	top: -10px;
	left: -10px;
	right: -10px;
	bottom: -10px;
	background: white;
	opacity: 0.3;
	border-radius: 5px;
}

</style>
</head>


<div id="main">
        <div id="content">
        <div id="head_image">
        </div>
        <div id="text">
<table border=1>

<body>
  <h1>Добавить машину</h1>
  <form action="save_car.php" method="POST">
    <label>Номер двигателя:</label>
    <input type="text" name="id_engine"><br>
    <label>Марка автомобиля:</label>
    <input type="text" name="model"><br>
    <label>Стоимость:</label>
    <input type="text" name="price"><br>
    <label>Цвет:</label>
    <input type="text" name="color"><br>
    <label>Мощность двигателя:</label>
    <input type="text" name="engine_power"><br>
    <label>Макс. скорость:</label>
    <input type="text" name="max_speed"><br>
    <label>Пробег:</label>
    <input type="text" name="run_km"><br>
    <label>Дата выпуска:</label>
    <input type="date" name="data"><br>
    <label>Б/У:</label>
    <input type="checkbox" name="used"><br>
    <label>Номер фирмы:</label>
    <input type="text" name="kod_firma"><br>
    <input type="submit" class = "button" value="Добавить">
  </form>
</body>
</html>