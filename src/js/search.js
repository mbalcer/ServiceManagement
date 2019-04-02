$(document).ready(function() {
    $("#search").keyup( function () {
            $("#table tbody tr")
                .hide()
                .filter(function () {
                    return $(this).text().toLowerCase().indexOf($("#search").val()) >= 0;
                })
                .show();
    });
});