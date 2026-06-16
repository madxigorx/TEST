<?php
// НАСТРОЙКИ MAMP 
$host = 'localhost';
$port = 8889;
$db   = 'web';
$user = 'root';
$pass = 'root';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    die('Ошибка подключения: ' . $e->getMessage());
}

$search = $_GET['q'] ?? '';
$contacts = [];

try {
    if ($search !== '') {
        $sql = "SELECT * FROM name
                WHERE name  LIKE :q
                   OR phone LIKE :q
                   OR dol   LIKE :q
                ORDER BY id DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':q' => '%' . $search . '%']); 
        $contacts = $stmt->fetchAll();
    } else {
        $contacts = [];
    }
} catch (PDOException $e) {
    die('Ошибка запроса: ' . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Поиск контактов</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            font-family: Arial, sans-serif;
            background-image: url('background.jpg'); 
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;[web:82][web:88][web:90]
        }

        .container {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.3);
        }

        .nav { background: rgba(0, 123, 255, 0.9); padding: 10px; margin: -20px -20px 20px -20px; border-radius: 10px 10px 0 0; }
        .nav a { color: white; text-decoration: none; padding: 10px 20px; margin: 0 5px; border-radius: 5px; }
        .nav a:hover { background: #0056b3; }
        .nav a.active { background: #0056b3; }

        h1 { margin-top: 0; }

        form.search-form { margin-top: 10px; display: flex; gap: 10px; }
        form.search-form input[type="text"] { flex: 1; padding: 8px; border-radius: 4px; border: 1px solid #ccc; }
        form.search-form button { padding: 8px 15px; border-radius: 4px; border: none; background: #28a745; color: white; cursor: pointer; }
        form.search-form button:hover { background: #218838; }

        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #f8f9fa; font-weight: bold; }
        tr:hover { background: #f1f1f1; }
        .empty { text-align: center; color: #666; padding: 40px; }
        .small { font-size: 13px; color: #666; margin-top: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <nav class="nav">
            <a href="index.php">➕ Добавить контакт</a>
            <a href="view.php" class="active">🔍 Поиск контактов</a>
        </nav>

        <h1>Поиск контактов</h1>

        <form class="search-form" method="get" action="view.php">
            <input type="text" name="q" placeholder="Поиск по имени, телефону или должности" value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit">Найти</button>
        </form>
        <div class="small">
            Введи текст и нажми «Найти».
        </div>

        <?php
        if ($search === '') {
            echo '<div class="empty">Введите запрос для поиска.</div>';
        } else {
            if (empty($contacts)) {
                echo '<div class="empty">По запросу <strong>' . htmlspecialchars($search) . '</strong> ничего не найдено.</div>';
            } else {
                echo '<table>
                        <tr>
                            <th>ID</th>
                            <th>Имя</th>
                            <th>Телефон</th>
                            <th>Должность</th>
                        </tr>';
                
                foreach ($contacts as $contact) {
                    echo '<tr>
                            <td>' . htmlspecialchars($contact['id']) . '</td>
                            <td>' . htmlspecialchars($contact['name']) . '</td>
                            <td>' . htmlspecialchars($contact['phone']) . '</td>
                            <td>' . htmlspecialchars($contact['dol']) . '</td>
                          </tr>';
                }
                echo '</table>';
            }
        }
        ?>
    </div>
</body>
</html>
