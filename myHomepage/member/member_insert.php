<?php
// 데이터 베이스 연동
include $_SERVER['DOCUMENT_ROOT'] . "/myHomepage/db/db_connect.php";
include $_SERVER['DOCUMENT_ROOT'] . "/myHomepage/db/create_table.php";
create_table($con, 'members');

$id = $_POST["id"];
$pass = $_POST["pass"];
$name = $_POST["name"];
$tel1 = $_POST["tel1"];
$tel2 = $_POST["tel2"];
$tel3 = $_POST["tel3"];
$email1 = $_POST["email1"];
$email2 = $_POST["email2"];
$addr = $_POST["addr"];

//이름형식 검증
$patternName = "/[가-힣]+/";
if(!preg_match($patternName, $name)) {
    alert_back($name . '은(는) 이름 형식에 맞지 않습니다.');
}

//받아온값 정리
$phone = $tel1 . $tel2 . $tel3;
$email = $email1 . "@" . $email2;
$regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분' 을 저장.

//트랜잭션 처리구간
$result = mysqli_query($con, "SET AUTOCOMMIT=0");
$result = mysqli_query($con, "START TRANSACTION");

$sql = "insert into members(id, pass, name, phone, email, address, regist_day, level, point)";
$sql .= "values('$id', '$pass', '$name', '$phone', '$email', '$addr', '$regist_day', 9, 10)";

$result = mysqli_query($con, $sql);  // $sql 에 저장된 명령 실행
if (!$result) {
    alert_back("삽입이 잘못 되었습니다. 다시 입력하시기 바랍니다.");
    mysqli_query($con, "ROLLBACK");
} else {
    echo "
        <script>
            alert(`회원가입에 성공했습니다.`);
            location.href = 'http://{$_SERVER['HTTP_HOST']}/php_practice/myHomepage/index.php';
        </script>
        ";
    mysqli_query($con, "COMMIT");
    mysqli_query($con, "SET AUTOCOMMIT=1");
}
mysqli_close($con);

?>