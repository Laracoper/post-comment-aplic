<? session_start() ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Addpostcomment форум где можно добавлять записи и комменты к ним на любые темы</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
<wrap>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">Форум тест</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <? if (!getUser()): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="register.php">регистрация</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="login.php">войти</a>
                            </li>
                        <? endif ?>

                        <? if (getUser()): ?>
                            <p class="me-3 fs-3 text-nowrap">hello <?=h($_SESSION['user']['name'])?> </p>
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard.php">админка</a>
                        </li>
                        <a class="btn btn-primary" href="?do=exit">выход</a>
                        <?endif?>
                    </ul>

                </div>
            </div>
        </nav>
    </header>