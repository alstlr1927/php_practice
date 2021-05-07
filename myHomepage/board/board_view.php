<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>게시물 보기</title>
    <script src="https://kit.fontawesome.com/81f1a13e9a.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="./css/board.css">
    <script src="./js/board.js" defer></script>
</head>
<body>
<header>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/myHomepage/header.php" ?>
</header>
<section>
    <div id="board_box">
        <h3 class="title">
            자료실 > 내용보기
        </h3>
        <?php
        if (!$userid) {
            echo("
                <script>
                    window.alert('로그인 후 이용해주세요.');
                    history.go(-1);
                </script>
            ");
            exit;
        }
        include_once $_SERVER['DOCUMENT_ROOT'] . "/myHomepage/db/db_connect.php";
        $num = $_GET["num"];
        $page = $_GET["page"];

        $sql = "select * from board where num=$num";
        $result = mysqli_query($con, $sql);

        $row = mysqli_fetch_array($result);
        $id = $row["id"];
        $name = $row["name"];
        $regist_day = $row["regist_day"];
        $subject = $row["subject"];
        $content = $row["content"];
        $file_name = $row["file_name"];
        $file_type = $row["file_type"];
        $file_copied = $row["file_copied"];
        $hit = $row["hit"];

        $content = str_replace(" ", "&nbsp;", $content);
        $content = str_replace("\n", "<br>", $content);
        if ($userid !== $id) {
            $new_hit = $hit + 1;
            $sql = "update board set hit=$new_hit where num=$num";
            mysqli_query($con, $sql);
        }
        ?>
        <ul id="view_content">
            <li>
                <span class="col1"><b>제목 : </b><?= $subject ?></span>
                <span class="col2"><?= $name ?> | <?= $regist_day ?></span>
            </li>
            <li>
                <?php
                if ($file_name) {
                    $real_name = $file_copied;
                    $file_path = "./data/" . $real_name;
                    $file_size = filesize($file_path);  // 파일 사이즈를 구하는 함수

                    echo "
                          ▷ 첨부파일 : $file_name ($file_size Byte) &nbsp;&nbsp;&nbsp;&nbsp;
                          <a href='board_download.php?num=$num&real_name=$real_name&file_name=$file_name&file_type=$file_type'>[저장]</a>
                    ";
                }
                ?>
            </li>
            <li>
                <?php
                if ($file_type == "image/jpeg") {
                    echo "<img src='./data/$file_copied'>";
                }
                echo "$content";
                ?>
            </li>
        </ul>
        <ul class="buttons">
            <li>
                <button onclick="location.href='board_list.php?page=<?= $page ?>'">목록</button>
            </li>
            <li>
                <form action="board_form.php" method="post">
                    <button>수정</button>
                    <input type="hidden" name="num" value=<?= $num ?>>
                    <input type="hidden" name="page" value=<?= $page ?>>
                    <input type="hidden" name="mode" value="modify">
                </form>
            </li>
            <li>
                <form action="dmi_board.php" method="post">
                    <button>삭제</button>
                    <input type="hidden" name="num" value=<?= $num ?>>
                    <input type="hidden" name="page" value=<?= $page ?>>
                    <input type="hidden" name="mode" value="delete">
                </form>
            </li>
            <li>
                <button onclick="location.href='board_form.php'">글쓰기</button>
            </li>
        </ul>
    </div>
</section>
<footer>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/myHomepage/footer.php" ?>
</footer>
</body>
</html>