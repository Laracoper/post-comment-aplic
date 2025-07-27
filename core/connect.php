<?

   $host = 'mysql-8.0';
   $dbname = 'addpostcomment';
   $username = 'root';
   $password = '';



try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=UTF8", $username, $password);
} catch (PDOException $e) {
    // echo "Ошибка подключения: " . $e->getMessage();
    file_put_contents('/error.log',$e->getMessage(),true);
    exit;
}
