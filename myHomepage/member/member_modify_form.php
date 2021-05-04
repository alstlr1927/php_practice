<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>회원정보 수정</title>
        <script src="https://kit.fontawesome.com/81f1a13e9a.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@500&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="../css/normalize.css">
        <link rel="stylesheet" href="./css/member.css">
	</head>
	<body>
		<header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/myHomepage/header.php"; ?>
		</header>
        <?php
            include_once $_SERVER['DOCUMENT_ROOT']."/myHomepage/db/db_connect.php";
            $sql = "select * from members where id='$userid'";
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_array($result);

            $pass = $row["pass"];
            $name = $row["name"];
            $phone = $row["phone"];

            $email = explode("@", $row["email"]);
            $email1 = $email[0];
            $email2 = $email[1];

            $addr = $row["address"];

            mysqli_close($con);
        ?>
		<section>
			<div id="modify_content">
				<div id="join_box_modify">

					<h2>회원 정보 수정</h2>
					<form name="member_form" method="post" action="member_modify.php">
						<table>
							<tr>
								<th>사용자 ID</th>
								<td><?= $userid ?>	<input type="hidden" name="id" value="<?=$userid?>">
							</tr>
							<tr>
								<th>비밀번호</th>
								<td><input type="password" name="pass" value="<?= $pass ?>">
									<!--									4~12자리의 영문,숫자,특수문자(!, @, $, %, ^,&,*)만 가능-->
								</td>
							</tr>
							<tr>
								<th>성명</th>
								<td><input type="text" name="name" value="<?= $name ?>">
								</td>
							</tr>
                            <tr>
                                <th>전화번호</th>
                                <td><input type="text" name="phone" value="<?= $phone ?>">
                                </td>
                            </tr>
							<tr>
								<th>E-mail</th>
								<td><input type="text" name="email1" value="<?= $email1 ?>">@<input type="text" name="email2" value="<?= $email2 ?>">

								</td>
							</tr>
                            <tr>
                                <th>주소</th>
                                <td><input type="text" name="addr" value="<?= $addr ?>">
                                </td>
                            </tr>
						</table>
						<br>
						<div id="btn_modify">
							<input type="submit" value="수정">
							<input type="button" value="취소" onclick="location.href='http://<?=$_SERVER['HTTP_HOST']?>/php_practice/myHomepage/index.php'">
						</div>
					</form>
				</div> <!-- join_box -->
			</div> <!-- main_content -->
		</section>
		<footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/myHomepage/footer.php"; ?>
		</footer>
	</body>
</html>

