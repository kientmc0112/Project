$(document).ready(function () {
    $('#btn_add').click(function () {
        $('#input').clone().appendTo('.add_main')
    });
    $(document).on('click','#btn_remove',function(){
        $(this).parents('#input').remove();
    });
    $(document).on('click','#btn_remove_edit',function(){
        $(this).parents('.add_sub').remove();
    });
});