<?
session_start();
require __DIR__ . '/../core/connect.php';
require __DIR__ . '/../core/func.php';

exitBtn();

if (isset($_GET['id'])) {
    $_SESSION['post_id'] = trim((int)$_GET['id']);

    $user_id = $_SESSION['user_id'];
    // dump($user_id);
    // dump($_SESSION['post_id']);
    $post_id = $_SESSION['post_id'];



    $sql = "SELECT * FROM posts INNER JOIN users ON  posts.user_id = users.id where posts.id= ?";

    $res = $pdo->prepare($sql);
    $res->execute([$post_id]);
    $post = $res->fetch(PDO::FETCH_ASSOC);

    // dump($post);

    $sql = "SELECT * FROM users INNER JOIN comments ON  users.id = comments.user_id where post_id= ?";
    // $sql = "select * from comments where post_id = '$post_id'";
    $res = $pdo->prepare($sql);
    $res->execute([$post_id]);
    $comments = $res->fetchAll(PDO::FETCH_ASSOC);

    // dump($comments);
}

?>

<? require __DIR__ . '/inc/header.php' ?>


<main class="container-fluid">
    <h1>show post</h1>

    <div class="card bg-light mb-5">
        <div class="card-body">
            <h5 class="card-title">номер поста <?= h($post['id']) ?></h5>
            <h6 class="card-subtitle mb-2 text-body-secondary">заголовок <span class="fw-bold"><?= h($post['title']) ?></span></h6>
            <p class="card-text mb-3">контент <span class="fw-bold"><?= h($post['content']) ?></span></p>
            <p class="card-text">дата создания <span class="fw-bold"><?= $post['created_at'] ?></span></p>
            <p class="card-text">автор поста <span class="fw-bold"><?= h($post['name']) ?></span></p>
        </div>
        <span class="fw-bold"></span>
    </div>
    <? if ($comments): ?>
        <h2>комментарии к посту </h2>
        <div class="comments">
            <? foreach ($comments as $comment): ?>
                <div class="card bg-success text-light mb-2">
                    <div class="card-body">

                        <p class="card-text mb-4"><?= h($comment['comment']) ?></p>
                        <p class="card-text">автор комментария <span class="fw-bold"><?= h($comment['name']) ?></span></p>
                        <p class="card-text">дата создания <span class="fw-bold"><?= $comment['created_at'] ?></span></p>
                    </div>
                </div>
            <? endforeach ?>
        </div>
    <? else: ?>
        <div class="alert alert-danger">
            <p>комментариев пока нет</p>
        </div>
    <? endif ?>

</main>



<? require __DIR__ . '/inc/footer.php' ?>