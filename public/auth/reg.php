<?
session_start();
require __DIR__ . '/../../core/connect.php';
require __DIR__ . '/../../core/func.php';

if (getUser()) {
    header('location:dashboard.php', true, 301);
}

if (!empty($_POST)) {
    //dump($_POST);
    $name = trim($_POST['name']);
    $login = trim($_POST['login']);
    $pass = trim($_POST['password']);
    $password = password_hash($pass, PASSWORD_DEFAULT);

    if ($name == '' || $login == '' || $password == '') {
        $_SESSION['nodata'] = 'заполните поля';
        header('location:../register.php');
        exit;
    } else {
        $sql = "SELECT login FROM users";
        $res = $pdo->prepare($sql);
        $res->execute();
        $alllogins = $res->fetchAll(PDO::FETCH_ASSOC);


        foreach ($alllogins as $el) {
            if (in_array($login, $el)) {

                $_SESSION['usererr'] = 'такой login существует';
                header('location:../register.php');
                exit;
            }
        }

        $sql = "INSERT INTO users (name,login,password) VALUES (?,?,?)";
        $res = $pdo->prepare($sql);
        $res->execute([$name, $login, $password]);

        // $r = $pdo->query("SELECT * FROM users where login = '$login'");

        // $_SESSION['user_id'] = $r->fetchColumn();

        $_SESSION['reguser'] = 'вы зарегались';
        //    $_SESSION['user_id'] = $pdo->lastInsertId();
        // dump($_SESSION['user_pas']);
        header('location:../login.php');
    }
}
