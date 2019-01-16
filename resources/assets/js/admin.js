$( document ).ready(function() {

    //Remove error classes from forms
    $('textarea, input').click(function(){
        $(this).removeClass('is-invalid');
        $("label[for='"+$(this).attr("id")+"']").removeClass('text-danger');
    });



});