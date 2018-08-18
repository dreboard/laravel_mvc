/*!
 * Ticket Update
 * Docs & License: https://github.com/dreboard
 * (c) 2018 Dev-PHP
 */
jQuery(document).ready(function(){

    jQuery('#status').on( "change", function( event ) {
        $( "div.edited" ).hide();
        e.preventDefault();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: ticket.url,

            data: {
                ticket_id: $("#ticket_id").val(),
                created_by: $("#created_by").val(),
                status: $("#status").val(),
                _token: ticket.token,
            },

            type: "POST",
            dataType : "json",
        })

            .done(function( json ) {
                $( "div.edited" ).text( "All done" ).show();
            })

            .fail(function( xhr, status, errorThrown ) {
                $( "div.edited" ).text( "Sorry, there was a problem!" ).show();
                console.log( "Error: " + errorThrown );
                console.log( "Status: " + status );
                console.dir( xhr );
            })

            .always(function( xhr, status ) {
                //alert( data );
            });
    });
});