<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>자료실 게시물 쓰기</title>
    <script src="https://kit.fontawesome.com/81f1a13e9a.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="./css/board.css">
    <script src="./js/board.js" defer></script>
</head>
<body>
<header>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/myHomepage/header.php" ?>
</header>
<?php
if (empty($userid)) {
    echo("
            <script>
                window.alert('로그인 후 이용해주세요.');
                history.go(-1);
            </script>
        ");
    exit;
}
?>
<section>
    <?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/myHomepage/db/db_connect.php";
    $mode = isset($_POST["mode"]) ? $_POST["mode"] : "insert";
    $subject = "";
    $content = "";
    $file_name = "";

    if (isset($_POST["mode"]) && $_POST["mode"] === "modify") {
        $num = $_POST["num"];
        $page = $_POST["page"];

        $sql = "select * from board where num=$num";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);
        $writer = $row["id"];
        if (!isset($userid) || ($userid !== $writer && $userlever !== '1')) {
            alert_back('수정권한이 없습니다.');
            exit;
        }
        $name = $row["name"];
        $subject = $row["subject"];
        $content = $row["content"];
        $file_name = $row["file_name"];
        if (empty($file_name)) {
            $file_name = "없음";
        }
    }
    ?>
    <div id="board_box">
        <h3 id="board_title">
            <?php if ($mode === "modify"): ?>
                자료실 > 수정하기
            <?php else: ?>
                자료실 > 작성하기
            <?php endif; ?>
        </h3>
<!--        파일을 첨부할때는 enctype="multipart/form-data"를 반드시 폼태그에 입력해야함-->
        <form name="board_form" method="post" action="dmi_board.php" enctype="multipart/form-data">
            <?php if ($mode === "modify"): ?>
                <input type="hidden" name="num" value=<?= $num ?>>
                <input type="hidden" name="page" value=<?= $page ?>>
            <?php endif; ?>

            <input type="hidden" name="mode" value=<?= $mode ?>>
            <ul id="board_form">
                <li>
                    <span class="col1">이름 : </span>
                    <span class="col2"><?= $username ?></span>
                </li>
                <li>
                    <span class="col1">제목 : </span>
                    <span class="col2"><input type="text" name="subject" value=<?= $subject ?>></span>
                </li>
                <li id="text-area">
                    <span class="col1">내용 : </span>
                    <span class="col2">
                        <textarea name="content"><?= $content ?></textarea>
                    </span>
                </li>
                <li>
                    <span class="col1">첨부 파일 : </span>
                    <span class="col2">
                        <input type="file" name="upfile">
                        <?php if ($mode === "modify"): ?>
                            <input type="checkbox" value="yes" name="file_delete">
                            &nbsp;파일 삭제하기
                            <br>현재 파일 : <?= $file_name ?>
                        <?php endif; ?>
                    </span>
                </li>
            </ul>
            <ul class="buttons">
                <li>
                    <button type="button" onclick="check_input()">완료</button>
                </li>
                <li>
                    <button type="button" onclick="location.href='board_list.php'">목록</button>
                </li>
            </ul>
        </form>
    </div><!-- board_box -->
</section>
<footer>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/myHomepage/footer.php" ?>
</footer>
</body>
</html>