$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function () {
    $('#course_id').on('click', function (event) {
        event.preventDefault();
        let id = $(this).attr('data-courseId');
        let _this = $(this);
        $.ajax({
            url: '/admin/user/' + id + '/export_subject',
            method: 'POST',
            data: {
                // id: courseId,
            },
            success: function() {
                alert('ok');
            },
            error: function() {
                alert('error');
            }
        });
        
    });
});
