<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    require_once '../app/core/init.php';

    $url = $_GET['url'] ?? 'home';
    $url = explode('/', $url);
    $pagename = $url[0];
    $filename = "../app/pages/" . "$pagename" . ".php";

    $PAGE = get_pagination();

    if (file_exists($filename)) {
        require_once $filename;
    } else {
        require_once "../app/pages/404.php";
    }
    ?>
</body>

</html>