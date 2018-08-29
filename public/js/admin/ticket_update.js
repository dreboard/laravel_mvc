/*!
 * Ticket Update
 * Docs & License: https://github.com/dreboard
 * (c) 2018 Dev-PHP
 */
$(document).ready(function(){

    $('#status').on( "change", function(e) {
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
                $( ".edited" ).text( "Ticket Updated" ).show();
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

    $('.status_check').on( "click", function(e) {
        $( "div.edited" ).hide();

        var task_complete = 0;
        if ($(this).prop('checked')) {
            task_complete = 1;
        }

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: ticket.url,

            data: {
                task_id: $(this).data("task"),
                task_complete: task_complete,
                _token: ticket.token,
            },

            type: "POST",
            dataType : "json",
        })

            .done(function( json ) {
                console.log(json);
                $( ".edited" ).text( json.toString() ).show();
            })

            .fail(function( xhr, status, errorThrown ) {
                $( "div.edited" ).text( "Sorry, there was a problem!" ).show();
                console.log( "Error: " + errorThrown );
                console.log( "Status: " + status );
                console.dir( xhr );
            })

            .always(function( xhr, status, json ) {
                console.log( status );
            });
    });


    $('.status_check2').on( "click", function(e) {
        $( "div.edited" ).hide();

        var task_complete = 0;
        if ($(this).prop('checked')) {
            task_complete = 1;
        }

        console.log(this.id);
        console.log(task_complete);

    });

    $('#completed').on('change', function(){

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: ticket.url_completed,

            data: {
                ticket_id: $("#ticket_id").val(),
                completed: $("#completed").val(),
                _token: ticket.token,
            },

            type: "POST",
            dataType : "json",
        })

            .done(function( json ) {
                $('.progress-bar').css('width', json.completed+'%').attr('aria-valuenow', json.completed);
                $('#progressbarText').text(json.completed);

            })

            .fail(function( xhr, status, errorThrown ) {
                $( "div.edited" ).text( "Sorry, there was a problem!" ).show();
                console.log( "Error: " + errorThrown );
                console.log( "Status: " + status );
                console.dir( xhr );
            })

            .always(function( xhr, status, json ) {
                console.log( status );
            });


    });


});