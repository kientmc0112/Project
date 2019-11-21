$(document).ready(function () {
    var i = 1;
    $('#add').click(function () {
        i++;
        $('#add_subject').append(
            
            );
    });
    $(document).on('click', '.btn_remove', function () {
        var button_id = $(this).attr("id");
        $("#row" + button_id + "").remove();
    });
});
