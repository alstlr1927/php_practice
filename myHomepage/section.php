<div class="slideshow">
    <div class="slideshow_slides">
        <?php
            include_once $_SERVER['DOCUMENT_ROOT'] . "/myHomepage/db/db_connect.php";
            $sql = "select * from sell_board order by num desc;";
            $result = mysqli_query($con, $sql);

            while($row = mysqli_fetch_array($result)) {
                $imgPath = "./sell_board/data/";
                $imgFile = $row['file_copied'];
                $imgPath .= $imgFile;
                $imgNum = $row['num'];
                $page = $row['board_page'];
                ?>
                <a href="http://<?= $_SERVER['HTTP_HOST'] ?>/php_practice/myHomepage/sell_board/board_view.php?num=<?= $imgNum ?>&page=<?= $page ?>"><img src="<?= $imgPath ?>" alt=""></a>
                <?php
            }
        ?>

    </div>

    <div class="slideshow_nav">
        <a href="#" class="prev">prev</a>
        <a href="#" class="next">next</a>
    </div>
</div>
