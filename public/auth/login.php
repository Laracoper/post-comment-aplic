<?

session_start();
require __DIR__ . '/../../core/connect.php';
require __DIR__ . '/../../core/func.php';

if (getUser()) {
    header('location:dashboard.php', true, 301);
}

// dump(getUser());

if (!empty($_POST)) {
    // dump($_POST);
    $login = trim($_POST['login']) ?? null;
    $password = trim($_POST['password']) ?? null;

    if ($login == '' || $password == '') {
        $_SESSION['nodata'] = 'заполните поля';
        header('location:../login.php');
        exit;
    }

    if ($login != '' && $password != '') {
        $sql = "SELECT * FROM users WHERE login = ?";
        $res = $pdo->prepare($sql);
        $res->execute([$login]);
        $user = $res->fetch(PDO::FETCH_ASSOC);
        dump($user);
    }

    if (password_verify($password, $user['password'])) {

        $_SESSION['user'] = $user;
        // dump($_SESSION['user']);
        header('location:../dashboard.php');
    } else {
        //  $_SESSION['nodata'] = '<script>alert("hello proger")</script>';
        $_SESSION['nodata'] = 'неправильный логин или пароль';
        header('location:../login.php');
        exit;
    }
}
?>

<!-- <script>alert('hello proger')</script> -->