<?php
date_default_timezone_set("Asia/Seoul");
$server_name = "localhost";
$user_name = "root";
$pass = "Hyun1004!";
$db_name = "userDB";

$con = mysqli_connect($server_name, $user_name, $pass);
$query = "create database if not exists userDB";
// die($con-error) 쿼리문을 실행하고 결과값이 오류가 나오면 프로그램을 멈춤. ErrorMessage 출력
// $con-query() : 쿼리문 실행
$result = $con->query($query) or die($con->error);

// 데이터베이스 선택(userDB 선택)
$con->select_db($db_name) or die($con->error);

// 결과가 잘못 되었을 경우 경고해주고 뒤로가라.
function alert_back($message)
{
    echo("
			<script>
			alert('$message');
			history.go(-1)
			</script>
			");
}

function input_set($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>