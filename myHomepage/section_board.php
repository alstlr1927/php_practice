<div id="main_content">
    <div id="sell">
        <h4>'팝니다' 게시물</h4>
        <ul>
            <?php
            include_once $_SERVER['DOCUMENT_ROOT'] . "/myHomepage/db/db_connect.php";

            $sql = "select * from sell_board order by num desc limit 10";
            $result = mysqli_query($con, $sql);

            if (!$result) {
                echo "<li><span>아직 게시물이 없습니다.</span></li>";
            } else {
                while ($row = mysqli_fetch_array($result)) {
                    $regist_day = substr($row["regist_day"], 0, 10);
                    $imgNum = $row['num'];
                    $page = $row['board_page'];
                    ?>
                    <li>
                        <a class="link" href="http://<?= $_SERVER['HTTP_HOST'] ?>/php_practice/myHomepage/sell_board/board_view.php?num=<?= $imgNum ?>&page=<?= $page ?>"><span><?= $row["subject"] ?></span></a>
                        <span><?= $row["name"] ?></span>
                        <span><?= $regist_day ?></span>
                    </li>
                    <?php
                }
            }
            ?>
        </ul>
    </div>
    <div id="buy">
        <h4>'삽니다' 게시물</h4>
        <ul>
            <?php
            $sql = "select * from buy_board order by num desc limit 10";
            $result = mysqli_query($con, $sql);

            if (!$result) {
                echo "<li><span>아직 게시물이 없습니다.</span></li>";
            } else {
                while ($row = mysqli_fetch_array($result)) {
                    $regist_day = substr($row["regist_day"], 0, 10);
                    $imgNum = $row['num'];
                    $page = $row['board_page'];
                    ?>
                    <li>
                        <a class="link" href="http://<?= $_SERVER['HTTP_HOST'] ?>/php_practice/myHomepage/buy_board/board_view.php?num=<?= $imgNum ?>&page=<?= $page ?>"><span><?= $row["subject"] ?></span></a>
                        <span><?= $row["name"] ?></span>
                        <span><?= $regist_day ?></span>
                    </li>
                    <?php
                }
            }
            ?>
        </ul>
    </div>
    <div id="most_sell">
        <h4>'팝니다' 인기 게시물</h4>
        <ul>
            <?php
            $sql = "select * from sell_board order by hit desc limit 10";
            $result = mysqli_query($con, $sql);
            if (!$result) {
                echo "<li><span>아직 게시물이 없습니다.</span></li>";
            } else {
                while ($row = mysqli_fetch_array($result)) {
                    $imgNum = $row['num'];
                    $page = $row['board_page'];
                    ?>
                    <li>
                        <a class="link" href="http://<?= $_SERVER['HTTP_HOST'] ?>/php_practice/myHomepage/sell_board/board_view.php?num=<?= $imgNum ?>&page=<?= $page ?>"><span><?= $row["subject"] ?></span></a>
                        <span><?= $row["name"] ?></span>
                        <span><?= $row["hit"] ?></span>
                    </li>
                    <?php
                }
            }
            ?>
        </ul>
    </div>
    <div id="most_buy">
        <h4>'삽니다' 인기 게시물</h4>
        <ul>
            <?php
            $sql = "select * from buy_board order by hit desc limit 10";
            $result = mysqli_query($con, $sql);
            if (!$result) {
                echo "<li><span>아직 게시물이 없습니다.</span></li>";
            } else {
                while ($row = mysqli_fetch_array($result)) {
                    $imgNum = $row['num'];
                    $page = $row['board_page'];
                    ?>
                    <li>
                        <a class="link"› href="http://<?= $_SERVER['HTTP_HOST'] ?>/php_practice/myHomepage/buy_board/board_view.php?num=<?= $imgNum ?>&page=<?= $page ?>"><span><?= $row["subject"] ?></span></a>
                        <span><?= $row["name"] ?></span>
                        <span><?= $row["hit"] ?></span>
                    </li>
                    <?php
                }
            }
            ?>
        </ul>
    </div>
    <div id="point_rank">
        <h4>포인트 랭킹</h4>
        <ul>
            <?php
            $rank = 1;
            $sql = "select * from members order by point desc limit 10";
            $result = mysqli_query($con, $sql);

            if (!$result) {
                echo "<li>아직 가입된 회원이 없습니다.</li>";
            } else {
                while ($row = mysqli_fetch_array($result)) {
                    $name = $row["name"];
                    $id = $row["id"];
                    $point = $row["point"];
                    $name = mb_substr($name, 0, 1) . " * " . mb_substr($name, 2, 1);
                    ?>
                    <li>
                        <span><?= $rank ?></span>
                        <span><?= $name ?></span>
                        <span><?= $id ?></span>
                        <span><?= $point ?></span>
                    </li>
                    <?php
                    $rank++;
                }
            }
            mysqli_close($con);
            ?>
        </ul>
    </div>
</div>