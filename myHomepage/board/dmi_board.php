<?php
session_start();
if (isset($_SESSION["userid"])) {
    $userid = $_SESSION["userid"];
}
if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
}
include_once $_SERVER['DOCUMENT_ROOT'] . "/myHomepage/db/db_connect.php";

if (isset($_POST["mode"]) && $_POST["mode"] === "delete") {
    $num = $_POST["num"];
    $page = $_POST["page"];
    $sql = "select * from board where num = $num";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $writer = $row["id"];
    if (!isset($userid) || ($userid) !== $writer && $userlevel !== '1') {
        alert_back('수정권한이 없습니다.');
        exit;
    }
    $copied_name = $row["file_copied"];

    if ($copied_name) {
        $file_path = "./data/" . $copied_name;
        unlink($file_path);
    }

    $sql = "delete from board where num = $num";
    mysqli_query($con, $sql);
    mysqli_close($con);

    echo "
        <script>
            location.href = 'board_list.php?page=$page';
        </script>
    ";
} else if (isset($_POST["mode"]) && $_POST["mode"] === "insert") {
    include_once $_SERVER['DOCUMENT_ROOT'] . "/myHomepage/db/db_connect.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/myHomepage/db/create_table.php";

    create_table($con, 'board');

    // 세션값 확인

    if (!$userid) {
        echo("
            <script>
                window.alert('게시판 글쓰기는 로그인 후 이용해 주세요.');
                history.go(-1);
            </script>
        ");
        exit;
    }

    $subject = $_POST["subject"];
    $content = $_POST["content"];

    $subject = input_set($subject);
    $content = input_set($content);

    $regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장

    // 자료를 업로드할때 저장될 디렉토리
    $upload_dir = "./data/";

    $upfile_name = $_FILES["upfile"]["name"];
    $upfile_tmp_name = $_FILES["upfile"]["tmp_name"];
    $upfile_type = $_FILES["upfile"]["type"];
    $upfile_size = $_FILES["upfile"]["size"]; // 안되면 php init 에서 최대크기 수정!
    $upfile_error = $_FILES["upfile"]["error"];

    if (!empty($upfile_name) && !$upfile_error) {   // 업로드가 잘되었는지 판단
        $file = explode(".", $upfile_name); // "." 배열로 분리시킨다. (you.jpg)
        $file_name = $file[0];  // (you)
        $file_ext = $file[1];   // (jpg)

        $new_file_name = date("Y_m_d_H_i_s");
        $new_file_name = $new_file_name . "_" . $file_name;
        $copied_file_name = $new_file_name . "." . $file_ext; // 2021_04_24_15_00_00_you.jpg
        $uploaded_file = $upload_dir . $copied_file_name;    // ./data/2021_04_24_15_00_00_you.jpg 다 합친것

        if ($upfile_size > 1000000) {
            echo("
                <script>
                    window.alert('업로드 파일 크기가 지정된 용랑(1mb)을 초과합니다.<br>파일 크기를 체크해주세요.');
                    history.go(-1);
                </script>
            ");
            exit;
        }

        if (!move_uploaded_file($upfile_tmp_name, $uploaded_file)) {
            echo("
                <script>
                    window.alert('파일을 지정한 디렉토리에 복사하는데 실패했습니다.');
                    history.go(-1);
                </script>
            ");
            exit;
        }
    } else {
        $upfile_name = "";
        $upfile_type = "";
        $copied_file_name = "";
    }

    $sql = "insert into board (id, name, subject, content, regist_day, hit, file_name, file_type, file_copied)";
    $sql .= "values('$userid', '$username', '$subject', '$content', '$regist_day', 0, '$upfile_name', '$upfile_type', '$copied_file_name')";
    mysqli_query($con, $sql);

    $point_up = 100;

    $sql = "select point from members where id='$userid'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $new_point = $row["point"] + $point_up;

    $sql = "update members set point=$new_point where id='$userid'";
    mysqli_query($con, $sql);

    mysqli_close($con);

    echo "
        <script>
            location.href = 'board_list.php';
        </script>
    ";
} else if (isset($_POST["mode"]) && $_POST["mode"] === "modify") {
    $num = $_POST["num"];
    $page = $_POST["page"];

    $subject = $_POST["subject"];
    $content = $_POST["content"];
    $file_delete = (isset($_POST["file_delete"])) ? $_POST["file_delete"] : 'no';

    $sql = "select * from board where num = $num";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);

    $copied_name = $row["file_copied"];

    $upfile_name = $row["file_name"];
    $upfile_type = $row["file_type"];
    $copied_file_name = $row["file_copied"];
    if ($file_delete === "yes") {
        if ($copied_name) {
            $file_path = "./data/" . $copied_name;
            unlink($file_path);
        }
        $upfile_name = "";
        $upfile_type = "";
        $copied_file_name = "";
    } else {
        if (isset($_FILES["upfile"])) {
            if ($copied_name) {
                $file_path = "./data/" . $copied_name;
                unlink($file_path);
            }

            $upload_dir = "./data/";

            $upfile_name = $_FILES["upfile"]["name"];
            $upfile_tmp_name = $_FILES["upfile"]["tmp_name"];
            $upfile_type = $_FILES["upfile"]["type"];
            $upfile_size = $_FILES["upfile"]["size"];   // 안되면  php init 에서 최대크기 수정.
            $upfile_error = $_FILES["upfile"]["error"];
            if ($upfile_name && !upfile_error) {    // 업로드가 잘되없는지 판단.
                $file = explode(".", $upfile_name); // trim 과 같다. (memo.sql)
                $file_name = $file[0];  // (memo)
                $file_ext = $file[1]; // (sql)

                $new_file_name = date("Y_m_d_H_i_s");
                $new_file_name = $new_file_name . "_" . $file_name;
                $copied_file_name = $new_file_name . "." . $file_ext;
                $uploaded_file = $upload_dir . $copied_file_name;

                if ($upfile_size > 1000000) {
                    echo("
                        <script>
                            window.alert('업로드 파일 크기가 지정된 용량(1mb)을 초과합니다. <br>파일 크기를 체크해주세요.');
                            history.go(-1);
                        </script>
                    ");
                    exit;
                }

                if (!move_uploaded_file($upfile_tmp_name, $uploaded_file)) {
                    echo("
                        <script>
                            window.alert('파일을 지정한 디렉토리에 복사하는데 실패했습니다.');
                            history.go(-1);
                        </script>
                    ");
                    exit;
                }
            } else {
                $upfile_name = $row["file_name"];
                $upfile_type = $row["file_type"];
                $copied_file_name = $row["file_copied"];
            }
        }
    }
    $sql = "update board set subject='$subject', content='$content', file_name='$file_name', file_type='$upfile_type', file_copied='$copied_file_name'";
    $sql .= " where num=$num";
    mysqli_query($con, $sql);

    mysqli_close($con);
    echo "
        <script>
            location.href = 'board_list.php?page=$page';
        </script>
    ";
}

?>