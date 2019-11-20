$(document).ready(function () {
    var i = 1;
    $('#add').click(function () {
        i++;
        $('#input-courses').append(
            '<tr id="row' + i + '"><td><select class="form-control" name="course_id[]" id="course_id"> @foreach ($subjects as $subject)<option value="{{ $subject->id }}">---- {{ $subject->name }} ----</option>    @endforeach</select></td><td><button class="btn btn-danger btn_remove"id="' + i + '" type="button" name="remove"><i class="far fa-trash-alt"></i></i></button></td></tr>'
            );
    });
    $(document).on('click', '.btn_remove', function () {
        var button_id = $(this).attr("id");
        $("#row" + button_id + "").remove();
    });
});
