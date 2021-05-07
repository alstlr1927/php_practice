<div class="section_content">
    <h2>회원가입</h2>
    <form name="sign_form" method="post" action="member_insert.php">
        <table id="form_table">
            <tr>
                <th>ID</th>
                <td>
                    <input type="text" name="id" size="14" spellcheck="false">
                    <input type="button" value="Check" id="check">
                    <span>•  4~8자리의 영문, 숫자만 가능</span>
                </td>
            </tr>
            <tr>
                <th>Password</th>
                <td>
                    <input type="password" name="pass" size="14">
                    <span>•  4~12자리의 영문, 숫자, 특수문자(!,@,$,%,^,&,*)만 가능</span>
                </td>
            </tr>
            <tr>
                <th>Password Check</th>
                <td><input type="password" name="pass_chk" size="14"></td>
            </tr>
            <tr>
                <th>Name</th>
                <td>
                    <input type="text" name="name" size="14" spellcheck="false">
                    <span>•  띄어쓰기 없이 입력, 반드시 실명이여야 합니다.</span>
                </td>
            </tr>
            <tr>
                <th>Phone</th>
                <td><input type="tel" name="tel1" maxlength="3" size="6"> -
                    <input type="tel" name="tel2" maxlength="4" size="6"> -
                    <input type="tel" name="tel3" maxlength="4" size="6">
                </td>
            </tr>
            <tr>
                <th>E-mail</th>
                <td>
                    <input type="text" name="email1" size="14" spellcheck="false">
                    @
                    <input type="text" name="email2" size="14" spellcheck="false">
                </td>
            </tr>
            <tr>
                <th>Address</th>
                <td><input type="text" name="addr" size="33" spellcheck="false"></td>
            </tr>
        </table>
        <br>
        <div id="btnSign">
            <input id="btn_sign_in" type="button" value="Sign-In" onclick="check_data()">
        </div>
    </form>
</div>