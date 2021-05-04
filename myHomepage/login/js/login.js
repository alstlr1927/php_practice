let btnLogin = document.querySelector("input[type=button]");
btnLogin.addEventListener("click", function () {
    if(!document.login_form.id.value) {
        window.alert("아이디를 입력하세요.")
        document.login_form.focus();
        return;
    }

    if(!document.login_form.pass.value) {
        window.alert("비밀번호를 입력하세요.");
        document.login_form.focus();
        return;
    }
    document.login_form.submit();
});