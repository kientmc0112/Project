$(document).ready(function () {
    var html = $('#option_subject')
    $('#btn_add').click(function () {
        $('#add_subject_main').after(html);
    });
});