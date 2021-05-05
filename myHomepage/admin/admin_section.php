<div id="admin_box">

    <h3 class="member_title">
        관리자 모드 > 회원수 그래프
    </h3>

    <div id="curve_chart" style="width: 900px; height: 500px"></div>

    <h3 class="member_title">
        관리자 모드 > 회원 관리
    </h3>

    <ul class="member_list">
        <li>
            <span class="col1">번호</span>
            <span class="col2">아이디</span>
            <span class="col3">이름</span>
            <span class="col4">레벨</span>
            <span class="col5">포인트</span>
            <span class="col6">가입일</span>
            <span class="col7">수정</span>
            <span class="col8">삭제</span>
        </li>
        <?php
        include_once $_SERVER['DOCUMENT_ROOT'] . "/myHomepage/db/db_connect.php";
        if (!isset($_SESSION['userid']) && $_SESSION['userlevel'] !== '1') {
            echo("
						            <script>
						            alert('관리자만 접근가능합니다');
						            history.go(-1)
						            </script>
						        ");
            exit;
        }

        $sql = "select * from members order by num desc";
        $result = mysqli_query($con, $sql);
        // 레코드 셋 에서 해당되는 레코드 갯수 mysqli_num_rows($result)
        $total_record = mysqli_num_rows($result); // 전체 회원 수

        // $number = 전체 레코드 갯수
        $number = $total_record;

        // 레코드셋에서 레코드 1개씩 리턴해줌
        // 더이상 리턴할게 없다면 null 리턴. = false
        while ($row = mysqli_fetch_array($result)) {
            $num = $row["num"];
            $id = $row["id"];
            $name = $row["name"];
            $level = $row["level"];
            $point = $row["point"];
            $regist_day = $row["regist_day"];
            ?>

            <li>
                <form method="post" action="admin_member_update.php">
                    <input type="hidden" name="num" value="<?= $num ?>">
                    <span class="col1"><?= $number ?></span>
                    <span class="col2"><?= $id ?></a></span>
                    <span class="col3"><?= $name ?></span>
                    <span class="col4"><input type="text" name="level" value="<?= $level ?>"></span>
                    <span class="col5"><input type="text" name="point" value="<?= $point ?>"></span>
                    <span class="col6"><?= $regist_day ?></span>
                    <span class="col7"><button type="submit">수정</button></span>
                    <span class="col8"><button type="button"
                                               onclick="location.href='admin_member_delete.php?num=<?= $num ?>'">삭제</button></span>
                </form>
            </li>

            <?php
            $number--;
        }
        ?>
    </ul>

    <h3 class="member_title">
        관리자 모드 > 탈퇴 회원 관리
    </h3>

    <ul class="member_list">
        <li>
            <span class="col1">선택</span>
            <span class="col2">아이디</span>
            <span class="col3">이름</span>
            <span class="col4">레벨</span>
            <span class="col5">포인트</span>
            <span class="col6">가입일</span>
            <span class="col7">복구</span>
            <span class="col8">영구 삭제</span>
        </li>

        <?php
        if (!isset($_SESSION['userid']) && $_SESSION['userlevel'] !== '1') {
            echo("
						            <script>
						            alert('관리자만 접근가능합니다');
						            history.go(-1)
						            </script>
						        ");
            exit;
        }
        $sql = "select * from delete_members order by num desc";
        $result = mysqli_query($con, $sql);

        $total_record = mysqli_num_rows($result);
        $number = $total_record;

        while ($row = mysqli_fetch_array($result)) {
            $num = $row['num'];
            $id = $row['id'];
            $name = $row['name'];
            $level = $row['level'];
            $point = $row['point'];
            $regist_day = $row['regist_day'];
            ?>
            <li>
                <form method="post" action="admin_quit_restore.php">
                    <input type="hidden" name="num" value="<?= $num ?>">
                    <span class="col1"><?= $number ?></span>
                    <span class="col2"><?= $id ?></span>
                    <span class="col3"><?= $name ?></span>
                    <span class="col4"><?= $level ?></span>
                    <span class="col5"><?= $point ?></span>
                    <span class="col6"><?= $regist_day ?></span>
                    <span class="col7"><button type="submit">복구</button></span>
                    <span class="col8"><button type="button"
                                               onclick="location.href='admin_quit_delete.php?num=<?= $num ?>'">삭제</button></span>
                </form>
            </li>
            <?php
            $number--;
        }

        ?>

    </ul>


    <h3 class="member_title">
        관리자 모드 > '팝니다' 게시판 관리
    </h3>
    <ul class="board_list">
        <li class="title">
            <span class="col1">선택</span>
            <span class="col2">번호</span>
            <span class="col3">이름</span>
            <span class="col4">제목</span>
            <span class="col5">첨부파일명</span>
            <span class="col6">작성일</span>
        </li>
        <form method="post" action="admin_sell_board_delete.php">
            <?php
            $sql = "select * from sell_board order by num desc";
            $result = mysqli_query($con, $sql);
            $total_record = mysqli_num_rows($result); // 전체 글의 수

            $number = $total_record;

            while ($row = mysqli_fetch_array($result)) {
                $num = $row["num"];
                $name = $row["name"];
                $subject = $row["subject"];
                $file_name = $row["file_name"];
                $regist_day = $row["regist_day"];
                $regist_day = substr($regist_day, 0, 10)
                ?>
                <li>
                    <span class="col1"><input type="checkbox" name="item[]" value="<?= $num ?>"></span>
                    <span class="col2"><?= $number ?></span>
                    <span class="col3"><?= $name ?></span>
                    <span class="col4"><?= $subject ?></span>
                    <span class="col5"><?= $file_name ?></span>
                    <span class="col6"><?= $regist_day ?></span>
                </li>
                <?php
                $number--;
            }
            ?>
            <button type="submit">선택된 글 삭제</button>
        </form>
    </ul>

    <h3 class="member_title">
        관리자 모드 > '삽니다' 게시판 관리
    </h3>
    <ul class="board_list">
        <li class="title">
            <span class="col1">선택</span>
            <span class="col2">번호</span>
            <span class="col3">이름</span>
            <span class="col4">제목</span>
            <span class="col5">첨부파일명</span>
            <span class="col6">작성일</span>
        </li>
        <form method="post" action="admin_buy_board_delete.php">
            <?php
            $sql = "select * from buy_board order by num desc";
            $result = mysqli_query($con, $sql);
            $total_record = mysqli_num_rows($result); // 전체 글의 수

            $number = $total_record;

            while ($row = mysqli_fetch_array($result)) {
                $num = $row["num"];
                $name = $row["name"];
                $subject = $row["subject"];
                $file_name = $row["file_name"];
                $regist_day = $row["regist_day"];
                $regist_day = substr($regist_day, 0, 10)
                ?>
                <li>
                    <span class="col1"><input type="checkbox" name="item[]" value="<?= $num ?>"></span>
                    <span class="col2"><?= $number ?></span>
                    <span class="col3"><?= $name ?></span>
                    <span class="col4"><?= $subject ?></span>
                    <span class="col5"><?= $file_name ?></span>
                    <span class="col6"><?= $regist_day ?></span>
                </li>
                <?php
                $number--;
            }
            mysqli_close($con);
            ?>
            <button type="submit">선택된 글 삭제</button>
        </form>
    </ul>
</div> <!-- admin_box -->