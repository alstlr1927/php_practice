<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>당근 나라</title>
    <script src="https://kit.fontawesome.com/81f1a13e9a.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/normalize.css">
    <link rel="stylesheet" href="./css/section_board.css">
    <script src="./js/main.js"></script>
</head>
<body onload="slide_func()">
<header>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/myHomepage/header.php" ?>
</header>
<section>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/myHomepage/section.php" ?>
</section>
<section>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/myHomepage/section_board.php" ?>
</section>
<footer>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/myHomepage/footer.php" ?>
</footer>
</body>
</html>