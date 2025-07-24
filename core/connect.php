<?

   $host = 'mysql-8.0';
   $dbname = 'addpostcomment';
   $username = 'root';
   $password = '';



try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // ... дальнейшая работа с базой данных
} catch (PDOException $e) {
    // Обработка ошибки подключения
    echo "Ошибка подключения: " . $e->getMessage();
    exit;
}
