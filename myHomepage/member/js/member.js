let btnSign = document.querySelector("input[type=submit]");
let btnCheck = document.querySelector("#check");

btnSign.addEventListener("click", function () {
    if(!document.sign_form.id.value) {
        alert("Input ID.");
        document.sign_form.id.focus();
        return;
    }

    if(!document.sign_form.pass.value) {
        alert("Input Password.");
        document.sign_form.pass.focus();
        return;
    }

    if(!document.sign_form.pass_chk.value) {
        alert("Input Password_Chk");
        document.sign_form.pass_chk.focus();
        return;
    }

    if(!document.sign_form.name.value) {
        alert("Input Name.");
        document.sign_form.name.focus();
        return;
    }

    if(!document.sign_form.tel1.value) {
        alert("Input Phone.");
        document.sign_form.tel1.focus();
        return;
    }

    if(!document.sign_form.tel2.value) {
        alert("Input Phone.");
        document.sign_form.tel2.focus();
        return;
    }

    if(!document.sign_form.tel3.value) {
        alert("Input Phone.");
        document.sign_form.tel3.focus();
        return;
    }

    if(!document.sign_form.email1.value) {
        alert("Input E-mail.");
        document.sign_form.email1.focus();
        return;
    }

    if(!document.sign_form.email2.value) {
        alert("Input E-mail.");
        document.sign_form.email2.focus();
        return;
    }

    if(!document.sign_form.addr.value) {
        alert("Input Address.");
        document.sign_form.addr.focus();
        return;
    }

    if(document.sign_form.pass.value !==
    document.sign_form.pass_chk.value) {
        alert("비밀번호가 일치하지 않습니다.\n다시 입력해 주세요!");
        document.sign_form.pass.focus();
        document.sign_form.pass.select();
        return;
    }

    document.sign_form.submit();
});

btnCheck.addEventListener("click", function() {
    window.open("member_check_id.php?id=" + document.sign_form.id.value,
        "IDcheck",
        "left=700,top=300,width=350,height=200,scrollbars=no,resizable=yes");
});
