<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $title; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="/public/styles/main.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
          integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <script src="/public/scripts/bootstrap.min.js"></script>
    <script src="/public/scripts/jquery.js"></script>
    <script src="/public/scripts/fa_drop_menu.js"></script>
    <script src="/public/scripts/index.js"></script>
    <script src="/public/scripts/text.js"></script>
    <script src="/public/scripts/reg_log.js"></script>
    <script src="/public/scripts/form.js"></script>
</head>
<body class='<?php echo $class ?>'>
<button class="menu-toggle"></button>
<nav class="main_nav">
    <ul class="main_ul_nav">
        <a href="/">
            <li data-text="Home">Главная</li>
        </a>
        <a href="">
            <li data-text="Portfolio">Портфолио</li>
        </a>
        <a href="">
            <li data-text="My Blog">Блог</li>
        </a>
        <a href="">
            <li data-text="Shop">Магазин</li>
        </a>
        <a href="">
            <li data-text="Contact">Контакты</li>
        </a>
        <?php if (isset($_SESSION['account']['id'])): ?>
            <a href="/account/logout">
                <li data-text="Logout">Выход</li>
            </a>
        <?php else: ?>
            <a href="/account/register">
                <li data-text="Sign up\in">Вход\Регис.</li>
            </a>
        <?php endif; ?>
    </ul>
</nav>
        <?php if (isset($_SESSION['account']['id'])): ?>
            <div class="enter_div">
                <a href="/account/profile"><i class="fab fa-wolf-pack-battalion fa-4x"></i></a>
            </div>
        <?php else: ?>
            <div class="enter_div">
                <a href="/account/register"><i class="fab fa-connectdevelop fa-4x"></i></a>
            </div>
        <?php endif; ?>
</div>

</div>
<div class="preloader">
    <div class="preloader_content">
        <div class="preloader_first"></div>
        <div class="preloader_second"></div>
        <div class="preloader_third"></div>
    </div>
</div>
<?php echo $content; ?>
</body>
</html>