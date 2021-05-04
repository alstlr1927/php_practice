<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>회원 탈퇴</title>
		<link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="../css/normalize.css">
		<link rel="stylesheet" type="text/css" href="css/member.css">
        <script src="https://kit.fontawesome.com/81f1a13e9a.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@500&display=swap" rel="stylesheet">
	</head>
	<body>
		<header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/myHomepage/header.php"; ?>
		</header>
		<section>
			<div id="delete_content">
				<div id="join_box_delete">
					<h2>정말로 회원탈퇴를 하시겠습니까?</h2>
					<form name="member_form" method="post" action="member_delete.php">
						<input type="hidden" name="id" value="<?=$userid?>">
						<br><br>
						<div>
							<input type="submit" value="확인">
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

