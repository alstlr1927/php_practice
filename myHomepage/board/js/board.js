function check_input() {
    if (!document.board_form.subject.value) {
        window.alert("제목을 입력하세요.");
        document.board_form.subject.focus();
        return;
    }
    if (!document.board_form.content.value) {
        window.alert("내용을 입력하세요.");
        document.board_form.content.focus();
        return;
    }
    document.board_form.submit();
}