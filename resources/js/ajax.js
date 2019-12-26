$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function () {
    $('#course_id').on('change', function (event) {
        event.preventDefault();
        $("#subject_id").html('');
        var id = $('#course_id').val();
        $.ajax({
            url: '/admin/users/' + id + '/export_subject',
            method: 'get',
            success: function (response) {
                $.each(response.listSubject, function (key, value) {
                    var option = "<option value=" + value.subject_id + ">" + value.subject_name + "</option>";
                    $("#subject_id").append(option);
                });
            },
            error: function () {
                alert('error');
            }
        });
    });
});
// $(document).ready(function (event) {
//     event.preventDefault();
//     $('#btn-reset').on('click', function(){
//         $.ajax({
//             url: 'dashboard/chart',
//             method: 'GET',
//             success: function () {
//                 alert('oke');
//             },
//             error: function () {
//                 alert('error');
//             }
//         });
//     })
// });
