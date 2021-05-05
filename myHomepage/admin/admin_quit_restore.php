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

$num = $_POST["num"];

$sql = "select * from delete_members where num = $num";

$result = mysqli_query($con, $sql);

$row = mysqli_fetch_array($result);
$id = $row['id'];
$pass = $row['pass'];
$name = $row['name'];
$phone = $row['phone'];
$email = $row['email'];
$address = $row['address'];
$regist_day = $row['regist_day'];
$level = $row['level'];
$point = $row['point'];

$sql = "insert into members(id, pass, name, phone, email, address, regist_day, level, point)";
$sql .= " values('$id', '$pass', '$name', '$phone', '$email', '$address', '$regist_day', $level, $point);";

$result = mysqli_query($con, $sql);

if($result) {
    echo "
        <script>
            window.alert('복구 성공');
            location.href = 'http://{$_SERVER['HTTP_HOST']}/php_practice/myHomepage/admin/admin.php';
        </script>
        ";
    $sql = "delete from delete_members where num = $num";
    mysqli_query($con, $sql);
} else {
    echo "
        <script>
            window.alert('복구 실패'); 
            history.go(-1);
        </script>
        ";
}


?>