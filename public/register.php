<?
session_start();
require __DIR__ . '/../core/connect.php';
require __DIR__ . '/../core/func.php';

if(getUser()){
    header('location:dashboard.php',true,301);
}

if (!empty($_POST)) {
    //dump($_POST);
    $name = trim($_POST['name']);
    $login = trim($_POST['login']);
    $password = trim($_POST['password']);
    // $password = password_hash($pass, PASSWORD_DEFAULT);

    if ($name == '' || $login == '' || $password == '') {
        $_SESSION['nodata'] = 'заполните поля';
        header('location:/register.php');
        exit;
    }else{
        $sql = "SELECT login FROM users";
        $res = $pdo->prepare($sql);
        $res->execute();
        $alllogins = $res->fetchAll(PDO::FETCH_ASSOC);

        //dump($alllogins);
        foreach ($alllogins as $el) {
        if (in_array($login, $el)) {
           
            $_SESSION['usererr'] = 'такой login существует';
            header('location:/');
            exit;
        }
    }

        $sql = "INSERT INTO users (name,login,password) VALUES (?,?,?)";
        $res = $pdo->prepare($sql);
        $res->execute([$name, $login, $password]);
        $_SESSION['reguser']= 'вы зарегались';
        header('location:login.php');
    }

}
?>


<? require __DIR__ . '/inc/header.php' ?>


<main class="container">
    <h1>регистрация</h1>

    <form action="" method="post" class="mb-3">
        <input type="text" name="name" placeholder="name" class="form-control mb-4">
        <input type="text" name="login" placeholder="login" class="form-control mb-4">
        <input type="text" name="password" placeholder="password" class="form-control mb-4">
        <button type="submit" class="btn btn-info">зарегестрироваться</button>
    </form>
    <p>если уже зарегестрированы <a href="login.php">войти</a></p>
</main>

<? if (isset($_SESSION['usererr'])): ?>
    <div class="alert alert-danger">
        <p><?= ($_SESSION['usererr']) ?></p>
        <? unset($_SESSION['usererr']) ?>
    </div>
<? endif ?>

<? require __DIR__ . '/inc/footer.php' ?>