$(document).ready(function () {
    $('#btn_add').click(function () {
        $('#input').clone().appendTo('#add_subject_main')
    });
    $(document).on('click','#btn_remove',function(){
        $(this).parents('#input').remove();
    });
    $(document).on('click','#btn_remove_edit',function(){
        $(this).parents('#add_subject_main').remove();
    });
});