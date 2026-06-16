<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Форма ввода данных</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            font-family: Arial, sans-serif;
            background-image: url('background.jpg'); /* картинка */
            background-size: cover;                  /* растянуть на весь экран */ 
            background-position: center;             /* центрировать */ 
            background-repeat: no-repeat;            /* не повторять */[web:82][web:86][web:88]
        }

        /* Полупрозрачный контейнер, чтобы текст читался */
        .container {
            max-width: 600px;
            margin: 40px auto;
            padding: 20px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.3);
        }

        .nav { background: rgba(0, 123, 255, 0.9); padding: 10px; margin: -20px -20px 20px -20px; border-radius: 10px 10px 0 0; }
        .nav a { color: white; text-decoration: none; padding: 10px 20px; margin: 0 5px; border-radius: 5px; }
        .nav a:hover { background: #0056b3; }
        .nav a.active { background: #0056b3; }

        h1 { margin-top: 0; }
        label { display: block; margin-top: 15px; font-weight: bold; }
        input { width: 100%; padding: 10px; margin-top: 5px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        input:invalid { border-color: red; }
        input:valid { border-color: green; }
        button { background: #28a745; color: white; padding: 12px 20px; border: none; border-radius: 4px; cursor: pointer; width: 100%; margin-top: 20px; font-size: 16px; }
        button:hover { background: #218838; }
        #message { margin-top: 20px; padding: 15px; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="container">
        <nav class="nav">
            <a href="index.php" class="active">➕ Добавить контакт</a>
            <a href="view.php">📋 Список / поиск</a>
        </nav>

        <h1>Добавить контакт</h1>
        <form action="save.php" method="post">
            <label for="name">Имя:</label>
            <input type="text" id="name" name="name" required minlength="2" maxlength="50">

            <label for="phone">Номер телефона:</label>
            <input type="tel" id="phone" name="phone" required pattern="[+]?[0-9\s\-\(\)]{4,}" title="Формат: +375 (29) 123-45-67">

            <label for="dol">Должность:</label>
            <input type="text" id="dol" name="dol" required minlength="2" maxlength="100">

            <button type="submit">Сохранить данные</button>
        </form>

        <div id="message">
            <?php
            if (isset($_GET['status']) && $_GET['status'] === 'ok') {
                echo 'Запись успешно добавлена!';
            } elseif (isset($_GET['status']) && $_GET['status'] === 'error') {
                echo 'Произошла ошибка при сохранении.';
            }
            ?>
        </div>
    </div>
</body>
</html>
