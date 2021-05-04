<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <style>
        #pop_up {
            margin-left: 65px;
        }

        h3 {
            padding-left: 5px;
            border-left: solid 5px #fd8e44;
        }

        #close {
            margin: 20px 0 0 80px;
            cursor: pointer;
        }

        li {
            list-style-type: none;
        }

        button {
            width: 70px;
            height: 25px;
            background: #fd8e44;
            border: 1px solid #fd8e44;
            color: white;
            border-radius: 10px;
        }
    </style>
</head>
<body>
<div id="pop_up">
    <h3>아이디 중복체크</h3>
    <p>
        <?php
        $id = $_GET["id"];

        if (!$id) {
            echo("<li>아이디를 입력해 주세요!</li>");
        } else {
            include_once $_SERVER['DOCUMENT_ROOT'] . "/myHomepage/db/db_connect.php";

            $sql = "select * from members where id='$id'";
            $result = mysqli_query($con, $sql);

            $num_record = mysqli_num_rows($result);

            if ($num_record) {
                echo "<li>" . $id . " 아이디는 중복됩니다.</li>";
                echo "<li>다른 아이디를 사용해 주세요!</li>";
            } else {
                echo "<li>" . $id . " 아이디는 사용 가능합니다.</li>";
            }

            mysqli_close($con);
        }
        ?>
    </p>
    <div id="close">
        <button onclick="javascript:self.close()">닫기</button>
    </div>
</div>
</body>
</html>

