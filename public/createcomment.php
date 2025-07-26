<?

session_start();
require __DIR__ . '/../core/connect.php';
require __DIR__ . '/../core/func.php';

if (!getUser()) {
    header('location:login.php', true, 301);
}

exitBtn();
// комментарии выводятся не в том порядке почему то
$user_id = $_SESSION['user']['id'];

if (isset($_GET['id'])) {
    $post_id = trim($_GET['id']);

    if (!empty($_POST)) {

        $comment = trim($_POST['comment']);
        if ($comment == '') {
            header('location:createcomment.php');
            exit;
        } else {
            $sql = "INSERT INTO comments (comment,post_id,user_id) VALUES (?,?,?)";
            $res = $pdo->prepare($sql);
            $res->execute([$comment, $post_id, $user_id]);

            header('location:/');
        }
    }
}

?>


<? require __DIR__ . '/inc/header.php' ?>


<main class="container">
    <h1>create comment</h1>
    <form action="" method="post">

        <textarea name="comment" placeholder="enter comment" class="form-control mb-4"></textarea>
        <!-- <input type="hidden" name="post_id" class="form-control mb-4" value="<?= $post_id ?>">
        <input type="hidden" name="user_id" class="form-control mb-4" value="<?= $user_id ?>"> -->
        <button type="submit" class="btn btn-info">create comment</button>
    </form>
</main>


<? require __DIR__ . '/inc/footer.php' ?>