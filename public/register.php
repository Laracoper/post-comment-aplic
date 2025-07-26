<?
session_start();
require __DIR__ . '/../core/connect.php';
require __DIR__ . '/../core/func.php';
// require __DIR__ . '/../auth/reg.php';

if (getUser()) {
    header('location:dashboard.php', true, 301);
}
?>


<? require __DIR__ . '/inc/header.php' ?>


<main class="container">
    <h1>регистрация</h1>

    <? if (isset($_SESSION['usererr'])): ?>
        <div class="alert alert-danger">
            <p><?= h($_SESSION['usererr']) ?></p>
            <? unset($_SESSION['usererr']) ?>
        </div>
    <? endif ?>
    <? if (isset($_SESSION['nodata'])): ?>
        <div class="alert alert-danger">
            <p><?= h($_SESSION['nodata']) ?></p>
            <? unset($_SESSION['nodata']) ?>
        </div>
    <? endif ?>

    <form action="/auth/reg.php" method="post" class="mb-3">
        <input type="text" name="name" placeholder="name" class="form-control mb-4">
        <input type="text" name="login" placeholder="login" class="form-control mb-4">
        <input type="text" name="password" placeholder="password" class="form-control mb-4">
        <button type="submit" class="btn btn-info">зарегистрироваться</button>
    </form>
    <p>если уже зарегестрированы <a href="login.php">войти</a></p>
</main>



<? require __DIR__ . '/inc/footer.php' ?>