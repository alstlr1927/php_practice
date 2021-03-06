<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>'삽니다' 페이지</title>
        <script src="https://kit.fontawesome.com/81f1a13e9a.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@500&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="../css/normalize.css">
        <link rel="stylesheet" href="./css/board.css">
		<script src="./js/board.js"></script>
<!--		<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>-->
	</head>
	<body>
		<header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/myHomepage/header.php"; ?>
		</header>
		<section>
			<div id="board_box">
				<h3>
					'삽니다' 게시판 > 목록보기
				</h3>
				<ul id="board_list">
                    <?php
                        include_once $_SERVER['DOCUMENT_ROOT'] . "/myHomepage/db/db_connect.php";
                        include_once $_SERVER['DOCUMENT_ROOT'] . "/myHomepage/db/create_table.php";
                        create_table($con,"buy_board");
                        create_table($con,"buy_board_ripple");
                        if (isset($_GET["page"]))
                            $page = $_GET["page"];
                        else
                            $page = 1;


                        $sql = "select * from buy_board order by num desc";
                        $result = mysqli_query($con, $sql);
                        $total_record = mysqli_num_rows($result); // 전체 글 수

                        $scale = 9;

                        // 전체 페이지 수($total_page) 계산
                        if ($total_record % $scale == 0)
                            $total_page = floor($total_record / $scale);
                        else
                            $total_page = floor($total_record / $scale) + 1;

                        // 표시할 페이지($page)에 따라 $start 계산
                        $start = ($page - 1) * $scale;

                        $number = $total_record - $start;

                        for ($i = $start;
                             $i < $start + $scale && $i < $total_record;
                             $i++) {
                            mysqli_data_seek($result, $i);
                            // 가져올 레코드로 위치(포인터) 이동
                            $row = mysqli_fetch_array($result);
                            // 하나의 레코드 가져오기
                            $num = $row["num"];
                            $id = $row["id"];
                            $name = $row["name"];
                            $subject = $row["subject"];
                            $regist_day = $row["regist_day"];
                            $hit = $row["hit"];
                            $file_name_0 = $row['file_name'];
                            $file_copied_0 = $row['file_copied'];
                            $file_type_0 = $row['file_type'];
                            $image_width = 200;
                            $image_height = 200;
                            $sql = "update buy_board set board_page=";
                            $sql .= $page;
                            $sql .= " where num=";
                            $sql .= $num;
                            mysqli_query($con, $sql);
                            //이미지 정보를 가져오기 위한 함수 width, height, type
//                            if (!empty($file_name_0)) {
//                                $image_info = getimagesize("./data/" . $file_copied_0);
//                                $image_width = $image_info[0];
//                                $image_height = $image_info[1];
//                                $image_type = $image_info[2];
//                                if ($image_width > 200 ) $image_width = 200;
//                            }

//                            if ($row["file_name"])
//                                $file_image = "<img src='./img/file.gif'>";
//                            else
//                                $file_image = " ";
                            ?>
							<li>
								<span>
									<a href="board_view.php?num=<?= $num ?>&page=<?= $page ?>">
										<?php
                                        if (strpos($file_type_0, "image") !== false) {
                                            echo "<img src='./data/$file_copied_0' width='$image_width' height='$image_height'><br>";
                                        } else {
                                            echo "<img src='./img/user.jpg' width='$image_width' height='$image_height'><br>";
                                        }
                                        ?>
                                        <?= $subject ?></a><br>
								<?= $id ?><br>
								<?= $regist_day ?>
								</span>
							</li>
                            <?php
                            $number--;

                        }
                        mysqli_close($con);

                    ?>
				</ul>
				<ul id="page_num">
                    <?php
                        if ($total_page >= 2 && $page >= 2) {
                            $new_page = $page - 1;
                            echo "<li><a href='board_list.php?page=$new_page'>◀ 이전</a> </li>";
                        } else
                            echo "<li>&nbsp;</li>";

                        // 게시판 목록 하단에 페이지 링크 번호 출력
                        for ($i = 1; $i <= $total_page; $i++) {
                            if ($page == $i)     // 현재 페이지 번호 링크 안함
                            {
                                echo "<li><b> $i </b></li>";
                            } else {
                                echo "<li><a href='board_list.php?page=$i'> $i </a><li>";
                            }
                        }
                        if ($total_page >= 2 && $page != $total_page) {
                            $new_page = $page + 1;
                            echo "<li> <a href='board_list.php?page=$new_page'>다음 ▶</a> </li>";
                        } else
                            echo "<li>&nbsp;</li>";
                    ?>
				</ul> <!-- page -->
				<ul class="buttons">
					<li>
						<button onclick="location.href='board_list.php'">목록</button>
					</li>
					<li>
                        <?php
                            if ($userid) {
                                ?>
								<button onclick="location.href='board_form.php'">글쓰기</button>
                                <?php
                            } else {
                                ?>
								<a href="javascript:alert('로그인 후 이용해 주세요!')">
									<button>글쓰기</button>
								</a>
                                <?php
                            }
                        ?>
					</li>
				</ul>
			</div> <!-- board_box -->
		</section>
		<footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/myHomepage/footer.php"; ?>
		</footer>
	</body>
</html>
