$(document).ready(function () {
    
    $('.checkconfirm').on('click', function(){
        var conf = confirm("Bạn có chắc chắn muốn xóa ?");
        return conf;
    });
})
