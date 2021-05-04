<?php
if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
else $userid = "";
if (isset($_SESSION["username"])) $username = $_SESSION["username"];
else $username = "";
if (isset($_SESSION["userlevel"])) $userlevel = $_SESSION["userlevel"];
else $userlevel = "";
if (isset($_SESSION["userpoint"])) $userpoint = $_SESSION["userpoint"];
else $userpoint = "";
?>

<div class="menu">
    <a href="http://<?= $_SERVER['HTTP_HOST'] ?>/php_practice/myHomepage/index.php" class="title_icon">
        <div><i class="fas fa-carrot"></i> 당근 나라</div>
    </a>
    <ul class="menu_list">
        <a href="http://<?= $_SERVER['HTTP_HOST'] ?>/php_practice/myHomepage/index.php">
            <li>메인</li>
        </a>
        <a href="http://<?= $_SERVER['HTTP_HOST'] ?>/php_practice/myHomepage/sell_board/board_list.php">
            <li>'팝니다' 게시판</li>
        </a>
        <a href="http://<?= $_SERVER['HTTP_HOST'] ?>/php_practice/myHomepage/buy_board/board_list.php">
            <li>'삽니다' 게시판</li>
        </a>
        <a href="http://<?= $_SERVER['HTTP_HOST'] ?>/php_practice/myHomepage/message/message_box.php">
            <li>메세지</li>
        </a>
        <a href="http://<?= $_SERVER['HTTP_HOST'] ?>/php_practice/myHomepage/board/board_list.php">
            <li>자료실</li>
        </a>
    </ul>
    <ul class="login_signIn">
        <?php
        if (!$userid) {
            ?>
            <a href="http://<?= $_SERVER['HTTP_HOST'] ?>/php_practice/myHomepage/login/login_form.php">
                <i class="fas fa-sign-in-alt"></i>
            </a>
            <li> |</li>
            <a href="http://<?= $_SERVER['HTTP_HOST'] ?>/php_practice/myHomepage/member/member_form.php">
                <i class="fas fa-user-plus"></i>
            </a>
            <?php
        } else {
            $logged = $username . "(" . $userid . ")님<br>[ Level : " . $userlevel . " , Point : " . $userpoint . " ]";
            ?>
            <li id="user_info"><?= $logged ?> </li>
            <li> |</li>
            <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/php_practice/myHomepage/login/logout.php">
                <i class="fas fa-sign-out-alt"></i>
            </a>
            <li> |</li>
            <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/php_practice/myHomepage/member/member_modify_form.php">
                <i class="fas fa-edit"></i>
            </a>
            <li> |</li>
            <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/php_practice/myHomepage/member/member_delete_form.php">
                <i class="fas fa-user-slash"></i>
            </a>
            <?php
        }
        ?>
        <?php
        if($userlevel==1) {
            ?>
            <li> | </li>
            <a href="http://<?=$_SERVER['HTTP_HOST'];?>/php_practice/myHomepage/admin/admin.php">
                <i class="fas fa-user-shield"></i>
            </a>
            <?php
        }
        ?>
    </ul>
</div>
