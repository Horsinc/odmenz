<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Топ 24 региона по голосам</title>
    <style>
        .chart {
            width: 100%;
            height: 400px;
            margin: 0 auto;
        }

        .bar {
  display: flex;
  flex-direction: column; /* Вертикальное направление */
  align-items: flex-start; /* Выравнивание по левому краю */
}

.bar-fill {
  width: 100%; /* Полная ширина */
  height: 20px; /* Высота */
  background: linear-gradient(to right, #e0e0e0, #4CAF50);
}

.bar-label {
  background: #fff;
  color: #333;
  padding: 5px;
}

        .region-name {
            font-weight: Monsterrat;
            margin-bottom: 5px;
        }

        .percentage {
            font-size: 0.8em;
            color: #fff;
        }
    </style>
</head>
<body>

<?php

// Подключение к базе данных
$db = new mysqli('localhost', 'root', '', 'site');

// Проверка соединения
if ($db->connect_error) {
    die('Ошибка подключения: ' . $db->connect_error);
}

// Запрос для получения 24 регионов с наибольшим количеством голосов
$sql = "
    SELECT
        r.id_region,
        r.name,
        v.votes_count,
        ROUND(v.votes_count / (SELECT SUM(votes_count) FROM votes), 4) * 100 AS percent
    FROM regions r
    JOIN votes v ON r.id_region = v.id_region
    ORDER BY v.votes_count DESC
    LIMIT 24
";

// Выполнение запроса
$result = $db->query($sql);

// Проверка результата запроса
if ($result->num_rows > 0) {
    // Вывод данных
    while ($row = $result->fetch_assoc()) {
        echo "<div class='bar'>" . $row['name'] ;
        echo "<div class='bar-fill' style='width: " . $row['percent'] . "%'></div>";
        echo "<div class='bar-label'>". " (" . $row['votes_count'] . " голосов, " . $row['percent'] . "%)</div>";
        echo "</div>";
    }
} else {
    echo "Нет данных";
}

// Закрытие соединения
$db->close();

?>
 
</body>
</html>