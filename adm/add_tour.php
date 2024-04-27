<?php
    require_once "isAdmin.php"; //Подгрузка файла isAdmin
    $user_email = isAdmin(); // Запуск метода на проверку сессии админа
?>
<?php  if (isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id'])): ?> 


<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить товар</title>
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
<body>
    <h1>Добавить Тур</h1>
    <form action="save_tour.php" method="POST" enctype="multipart/form-data">
        <label for="id_hike">Айди похода:</label>
        <input type="number" id="id_hike" name="id_hike">
        <br>
        <label for="id_hike_pictures">Айди картинок:</label>
        <input type="number" id="id_hike_pictures" name="id_hike_pictures" required>
        <br>
        <label for="name_hike">Название:</label>
        <input type="text" id="name_hike" name="name_hike" required>
        <br>
        <label for="description_hike">Описание:</label>
        <textarea type="text" id="description_hike" name="description_hike" style="width: fit-content;"></textarea>
        <br>
        <label for="start_position">Стартовая позиция:</label>
        <input type="text" id="start_position" name="start_position" required>
        <br>
        <label for="stop_position">Конечная позиция:</label>
        <input type="text" id="stop_position" name="stop_position" required>
        <br>
        <label for="d_start">Время/дата начала:</label>
        <input type="datetime-local" id="d_start" name="d_start" required>
        <br>
        <label for="d_stop">Время/дата конца:</label>
        <input type="datetime-local" id="d_stop" name="d_stop" required>
        <br>
        <label for="kod_map"><a href="https://yandex.ru/map-constructor" target="_blank">Код карты:</a></label>
        <input type="text" id="kod_map" name="kod_map" required>
        <br>
        <label for="price_hike">Цена:</label>
        <input type="number" id="price_hike" name="price_hike" required>
        <br>
        <label for="id_leader">Айди лидера:</label>
        <input type="number" id="id_leader" name="id_leader" required>
        <br>
        <label for="picture_tour">Изображения:</label>
        <input type="file" id="picture_tour" name="picture_tour[]" multiple required>
        <br>
        <br>
        <input type="submit" class="button" value="Добавить">
    </form>
</body>
</html>

<?php else: ?>
    <h1> Тебе сюда нельзя </h1>
<?php endif ?>
