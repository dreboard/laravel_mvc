/*!
 * Ticket Update
 * Docs & License: https://github.com/dreboard
 * (c) 2018 Dev-PHP
 */
$(document).ready(function(){

    $("input:checked").each(function () {
        var id = $(this).data("task");
        $( "#taskText" +  id).addClass('taskDone');
    });

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

    $('.task_check').on( "click", function(e) {
        $( "div.edited" ).hide();
        var task_id = $(this).data("task");
        var task_complete = 0;

        if ($(this).prop('checked')=== true) {
            task_complete = 1;
        }

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: ticket.task_url,

            data: {
                task_id: $(this).data("task"),
                task_complete: task_complete,
                _token: ticket.token,
            },

            type: "POST",
            dataType : "json",
        })

            .done(function( json ) {
                $( ".edited" ).text( "Tasks Updated" ).show();
                if (json.complete == 0) {
                    $( "#taskText" +  task_id).removeClass('taskDone');
                } else {
                    $( "#taskText" +  task_id).addClass('taskDone');
                }
            })

            .fail(function( xhr, status, errorThrown ) {
                $( "div.edited" ).text( "Sorry, there was a problem!" ).show();
                console.log( "Error: " + errorThrown );
                console.log( "Status: " + status );
                console.dir( xhr );
            })

            .always(function( xhr, status, json ) {
                //console.log( status );
            });
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