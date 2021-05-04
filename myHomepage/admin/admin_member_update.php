<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/myHomepage/db/db_connect.php";

    //여기서 CURD한다는 의미
    session_start();
    if (isset($_SESSION["userlevel"])&& $_SESSION["userlevel"] != 1 )
    {
        echo("
            <script>
            alert('관리자가 아닙니다! 회원정보 수정은 관리자만 가능합니다!');
            history.go(-1)
            </script>
        ");
        exit;
    }

    $num   = $_POST["num"];
    $level = $_POST["level"];
    $point = $_POST["point"];

    $sql = "update members set level=$level, point=$point where num=$num";
    $result = mysqli_query($con, $sql);

    mysqli_close($con);

    if($result) {
        echo "
            <script>
                window.alert('수정 성공');
                location.href = 'http://{$_SERVER['HTTP_HOST']}/php_practice/myHomepage/admin/admin.php';
            </script>
        ";
    } else {
        echo "
            <script>
                window.alert('수정 실패'); 
                history.go(-1);
            </script>
        ";
    }
?>

