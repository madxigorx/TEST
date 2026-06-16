<?php 
header('Content-Type: text/html; charset=UTF-8');
$host = 'localhost';
$port = 8889;        // порт MySQL в MAMP
$db   = 'web';
$user = 'root';
$pass = 'root';      
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die('Ошибка подключения: ' . $e->getMessage());
}

$name  = $_POST['name']  ?? '';
$phone = $_POST['phone'] ?? '';
$dol   = $_POST['dol']   ?? '';

if (trim($name) === '' || trim($phone) === '' || trim($dol) === '') {
    die('Все поля обязательны для заполнения.');
}

try {
    $sql = "INSERT INTO name (name, phone, dol) VALUES (:name, :phone, :dol)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':name'  => $_POST['name'],
        ':phone' => $_POST['phone'],
        ':dol'   => $_POST['dol'],
    ]);
    
    // Возвращаемся на форму с сообщением об успехе
    header('Location: index.php?status=ok');
} catch (PDOException $e) {
    header('Location: index.php?status=error');
}
exit;
?>
