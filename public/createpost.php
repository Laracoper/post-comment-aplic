<?

session_start();
require __DIR__ . '/../core/connect.php';
require __DIR__ . '/../core/func.php';

if (!getUser()) {
    header('location:login.php', true, 301);
}

exitBtn();


// dump($_SESSION['user_id']);

// dump($user_id);
$user_id = $_SESSION['user_id'];
if (!empty($_POST)) {

    //dump($_POST);
    // dump($_POST['id']);
    //dump($user_id);
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    if($content==''||$title==''){
        header('location:createpost.php');
        exit;
    }else{
        $sql = "INSERT INTO posts (title,content,user_id) VALUES (?,?,?)";
        $res = $pdo->prepare($sql);
        $res->execute([$title, $content, $user_id]);
   
        header('location:/');
    }


    
}
// $sql = "select id from posts ";
// $res = $pdo->prepare($sql);
// $res->execute();
// $allpostid = $res->fetchAll(PDO::FETCH_ASSOC);
// dump($allpostid);


?>

<? require __DIR__ . '/inc/header.php' ?>


<main class="container">
    <h1>создайте пост</h1>
    <form action="" method="post">
        <input type="text" name="title" placeholder="title" class="form-control mb-4">
        <textarea name="content" placeholder="enter text" class="form-control mb-4"></textarea>
        <input type="hidden" name="user_id" class="form-control mb-4" value="<?= $user_id ?>">
        <button type="submit" class="btn btn-info">создать</button>
    </form>
</main>


<? require __DIR__ . '/inc/footer.php' ?>