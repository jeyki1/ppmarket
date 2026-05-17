<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PPM Market | Биты и продакшн</title>
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
</head>
<body>
<header>
    <div class="head-cont">
        <h2 class="head-title">PPM Market</h2>
        <div class="head-nav">
            <nav>
            <a href="index.php">Главная</a>
            <a href="explore.php">Каталог</a>
            <a href="about.php">О компании</a>
            <a href="prices.php">Цены</a>
            <a href="othsevr.php">Услуги</a>
            <?php if(!isset($_SESSION['user'])){ ?>
                <a href="login.php">Войти</a>
            <?php }else{ ?>
                <a href="basket.php">Корзина</a>
                <a href="account.php">Кабинет</a>
                <?php if($_SESSION['user']['role'] == 2){ ?>
                    <a href="admin.php" >Админ-панель</a>
                <?php } ?>
                <a href="./logout.php">Выход</a>
            <?php } ?>
            </nav>
        </div>
    </div>
</header>

