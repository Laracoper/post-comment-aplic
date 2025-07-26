<?

function dump($array)
{
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}

// function dd($array)
// {
//     dump($array);
//     die;
// }

function dd($array)
{
    echo '<pre>';
    dump($array);
    echo '</pre>';
    die;
}

function getUser()
{
    return isset($_SESSION['user']);
}

function exitBtn()
{
    if (isset($_GET['do']) && $_GET['do'] == 'exit') {
        unset($_SESSION['user']);
        header('location:login.php');
        // return $path;
    }
}

function h($a)
{
    return htmlspecialchars($a, ENT_QUOTES);
}


function insert($table, array $value)
{
    // $fields = [
    //     'title',
    //     'content',
    //     'user_id'
    // ];

    global $pdo;
    $sql = "INSERT INTO $table (title,content,user_id) VALUES (?,?,?)";
    $res = $pdo->prepare($sql);
    $res->execute($value);
    $data = $res->fetchAll();
    return $data;
}
