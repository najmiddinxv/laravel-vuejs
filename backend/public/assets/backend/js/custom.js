$(document).ready(function () {
    $('.delete-data-item').on('click', function (e) {
        var result = confirm("Are you sure to delete?");
        if(result){
            return true;
        }
        return false;
    });
});
