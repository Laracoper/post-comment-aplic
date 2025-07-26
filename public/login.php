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
    <? if (isset($_SESSION['reguser'])): ?>
        <div class="alert alert-info">
            <p><?= h($_SESSION['reguser']) ?></p>
            <? unset($_SESSION['reguser']) ?>
        </div>
    <? endif ?>

    <? if (isset($_SESSION['nodata'])): ?>
        <div class="alert alert-danger">
            <p><?= h($_SESSION['nodata']) ?></p>
            <? unset($_SESSION['nodata']) ?>
        </div>
    <? endif ?>
    <h1>Аутентификация</h1>
    <form action="/auth/login.php" method="post" class="mb-3">
        <input type="text" name="login" placeholder="login" class="form-control mb-4">
        <input type="text" name="password" placeholder="password" class="form-control mb-4">
        <button type="submit" class="btn btn-info">войти</button>
    </form>
    <p>Чтобы иметь возможность создавать посты и комменарии нужно <a href="register.php">зарегестрироваться</a></p>
</main>


<? require __DIR__ . '/inc/footer.php' ?>