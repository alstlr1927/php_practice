<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/myHomepage/db/db_connect.php";

if (isset($_SESSION["userlevel"]) && $_SESSION["userlevel"] != 1) {
    echo("
            <script>
            alert('관리자가 아닙니다! 회원정보 수정은 관리자만 가능합니다!');
            history.go(-1)
            </script>
        ");
    exit;
}

$num = $_GET["num"];

$sql = "delete from delete_members where num = $num";
$result = mysqli_query($con, $sql);

if($result) {
    echo "
        <script>
            window.alert('영구삭제 성공');
            location.href = 'http://{$_SERVER['HTTP_HOST']}/php_practice/myHomepage/admin/admin.php';
        </script>
        ";
} else {
    echo "
        <script>
            window.alert('영구삭제 실패'); 
            history.go(-1);
        </script>
        ";
}

?>
