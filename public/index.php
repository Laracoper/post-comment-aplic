<?
session_start();
require __DIR__ . '/../core/connect.php';
require __DIR__ . '/../core/func.php';

exitBtn();

$sql = "SELECT * FROM users INNER JOIN posts ON users.id = posts.user_id";
$res = $pdo->prepare($sql);
$res->execute();
$postsuser = $res->fetchAll(PDO::FETCH_ASSOC);

// dump($postsuser);


?>

<? require __DIR__ . '/inc/header.php' ?>


<main class="container-fluid main">
    <h1>главная страница</h1>
    <a class="mb-4 d-flex" href="dashboard.php">ваша админ панель</a>
    <? if (isset($_SESSION['nodata'])): ?>
        <div class="alert alert-danger">
            <p><?= h($_SESSION['nodata']) ?></p>
            <? unset($_SESSION['nodata']) ?>
        </div>
    <? endif ?>

    <? if (isset($_SESSION['usererr'])): ?>
        <div class="alert alert-success">
            <p><?= h($_SESSION['usererr']) ?></p>
            <? unset($_SESSION['usererr']) ?>
        </div>
    <? endif ?>
    <h2 class="mb-4">Регистрируйтесь, добавляйте посты и комментарии</h2>

    <?if(getUser()):?>
        <a class="btn btn-warning mb-4" href="createpost.php">создать пост</a>
    <?endif?>

    <div class="cards d-flex flex-wrap gap-3 justify-content-center">
        <? foreach ($postsuser as $el): ?>
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title mb-4"><a href="showpost.php?id=<?= $el['id'] ?>"><?= h($el['title']) ?></a></h5>
                    <h6 class="card-subtitle mb-2 text-body-secondary"><?= h($el['content']) ?></h6>
                    <p class="card-text">автор текста <span class="fw-bold"><?= h($el['name']) ?></span></p>
                    <a href="createcomment.php?id=<?= $el['id'] ?>" class="btn btn-info mt-3">добавить комментарий</a>

                </div>
            </div>
        <? endforeach ?>
    </div>


</main>


<? require __DIR__ . '/inc/footer.php' ?>