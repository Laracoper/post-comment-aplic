<?
session_start();
require __DIR__ . '/../core/connect.php';
require __DIR__ . '/../core/func.php';

if (getUser()) {
    header('location:dashboard.php', true, 301);
}

if (!empty($_POST)) {
    //dump($_POST);
    $login = trim($_POST['login']);
    $password = trim($_POST['password']);
    // $password = password_hash($pass, PASSWORD_DEFAULT);

    if ($login == '' || $password == '') {
        $_SESSION['nodata'] = 'заполните поля';
        header('location:/login.php');
        //exit;
    }

    if($login != '' || $password != ''){
        $sql = "SELECT * FROM users WHERE login = ? AND password = ?";
         $res = $pdo->prepare($sql);
        $res->execute([$login,$password]);
        $user = $res->fetch(PDO::FETCH_ASSOC);
        // dump($user);
        $_SESSION['user'] = $user['name'];
        $_SESSION['user_id'] = $user['id'];
        header('location:dashboard.php');
        // dump($_SESSION['user_id']);
    }

   
}

?>

<? require __DIR__ . '/inc/header.php' ?>


<main class="container">
    <? if (isset($_SESSION['reguser'])): ?>
        <div class="alert alert-info">
            <p><?= ($_SESSION['reguser']) ?></p>
            <? unset($_SESSION['reguser']) ?>
        </div>
    <? endif ?>
    <h1>Аутентификация</h1>
    <form action="" method="post" class="mb-3">
        <input type="text" name="login" placeholder="login" class="form-control mb-4">
        <input type="text" name="password" placeholder="password" class="form-control mb-4">
        <button type="submit" class="btn btn-info">войти</button>
    </form>
    <p>Чтобы иметь возможность создавать посты и комменарии нужно <a href="register.php">зарегестрироваться</a></p>
</main>


<? require __DIR__ . '/inc/footer.php' ?>