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
    <h1>Добавить товар</h1>
    <form action="save_product.php" method="POST" enctype="multipart/form-data">
        <label for="name">Название:</label>
        <input type="text" id="name" name="name">
        <br>
        <label for="description">Описание:</label>
        <input type="text" id="description" name="description" required>
        <br>
        <label for="id_pictures">Айди картинки:</label>
        <input type="number" id="id_pictures" name="id_pictures" required>
        <br>
        <label for="model">Модель:</label>
        <input type="text" id="model" name="model" required>
        <br>
        <label for="price">Цена:</label>
        <input type="number" id="price" name="price" required>
        <br>
        <label for="option">Опции:</label>
        <input type="text" id="option" name="option" required>
        <br>
        <label for="id_manufacturer">Айди производителя:</label>
        <input type="number" id="id_manufacturer" name="id_manufacturer" required>
        <br>
        <label for="pictures">Изображения:</label>
        <input type="file" id="pictures" name="pictures[]" multiple required>
        <br>
        <br>
        <input type="submit" class="button" value="Добавить">
    </form>
</body>
</html>

<?php else: ?>
    <h1> Тебе сюда нельзя </h1>
<?php endif ?>