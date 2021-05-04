<?php
    include_once $_SERVER["DOCUMENT_ROOT"]."/myHomepage/db/db_connect.php";
    $id = $_POST["id"];

    $sql = "delete from members  where id='$id'";
    $value = mysqli_query($con, $sql) or die('error : ' . mysqli_error($con));
    include_once $_SERVER['DOCUMENT_ROOT'] . "/myHomepage/login/logout.php";
?>






