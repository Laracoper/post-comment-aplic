<?
session_start();
require __DIR__ . '/../core/connect.php';
require __DIR__ . '/../core/func.php';

if (!getUser()) {
    header('location:login.php');
}

$user_id = $_SESSION['user']['id'];

// $sql = "SELECT * FROM posts INNER JOIN users ON users.id = posts.user_id";
$sql = "select * from posts where user_id = ?";
$res = $pdo->prepare($sql);
$res->execute([$user_id]);
$postsuser = $res->fetchAll(PDO::FETCH_ASSOC);


exitBtn();
?>

<? require __DIR__ . '/inc/header.php' ?>


<main class="container-fluid">
    <h1>ваша админка</h1>
    <a class="d-lg-none" href="?do=exit">выход</a>
    <div class="alert alert-success">
        <p>привет <?= $_SESSION['user']['name'] ?></p>
    </div>
    <a class="btn btn-warning" href="createpost.php">создать пост</a>
</main>


<? require __DIR__ . '/inc/footer.php' ?>