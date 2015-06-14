$(document).ready(function(){

    $('.datepicker').datepicker({
        dateFormat: 'dd-mm-yyyy'
    });
});

$(window).focus(function(){

    $(".login, .portlet-body").find("input:visible:first").focus();
});
