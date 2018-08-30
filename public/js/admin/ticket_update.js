/*!
 * Ticket Update
 * Docs & License: https://github.com/dreboard
 * (c) 2018 Dev-PHP
 */
$(document).ready(function(){

    $( ".edited" ).removeClass('text-danger');

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
                $( ".edited" ).text( json.allowed ).show();
                if($("#status").val() == 'complete'){
                    $('.progress-bar').css('width', '100%').attr('aria-valuenow', 100);
                    $('#progressbarText').text(100);
                    $('#completed').prop( "disabled", true );
                    $("#completed").val("100").change();

                } else {
                    $('.progress-bar').css('width', json.completed+'%').attr('aria-valuenow', json.completed);
                    $('#progressbarText').text(json.completed);
                    $('#completed').prop( "disabled", false );
                }
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
        var el = $(this);
        taskChecked(el);
    });

    $('#completed').on('change', function(){
        ajaxCompleteStatus(percent=100);
    });





    $('#new_task_form').on( "submit", function(e) {
        e.preventDefault();
        $( "div.edited" ).hide();

        var taskAjax = $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: ticket.task_new_url,

            data: {
                title: $("#task_title").val(),
                user_id: $("#task_user_id").val(),
                ticket_id: $("#task_ticket_id").val(),
                _token: ticket.token,
            },

            type: "POST",
            dataType : "json",
        })

            .done(function( json ) {
                $( ".edited" ).text( json.allowed ).show();

                if(json.allowed == 'Not assigned this task'){
                    $( ".edited" ).addClass('text-danger');
                } else {
                    $( ".edited" ).removeClass('text-danger');
                }

                var form = $(
                    '<tr>' +
                    '<td class="completeCheck">' +
                    '<form class="form-inline">' +
                    '<div class="form-check mb-2 mr-sm-2">' +
                    '<input class="task_check" type="checkbox" id="taskStatus'+json.task_id+' " name="taskStatus" data-task="'+json.task_id+'" value="0">' +
                    '</div></form></td>' +
                    '<td><span id="taskText'+json.task_id+'" class="taskTitle"> '+json.title+'</span></td>'+
                    '</tr>'
                );

                $('#taskListTable').append(form);
                $(form).on('click','.task_check',function(e){
                    var el = $(this);
                    taskChecked(el);
                });
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



    function taskChecked(element){
        $( "div.edited" ).hide();
        var task_id = $(element).data("task");
        var task_complete = 0;

        if ($(element).prop('checked')=== true) {
            task_complete = 1;
        }

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: ticket.task_url,

            data: {
                task_id: $(element).data("task"),
                task_complete: task_complete,
                _token: ticket.token,
            },

            type: "POST",
            dataType : "json",
        })

            .done(function( json ) {

                $( ".edited" ).text( json.allowed ).show();

                if(json.allowed == 'Not assigned this task'){
                    $( ".edited" ).addClass('text-danger');
                } else {
                    $( ".edited" ).removeClass('text-danger');
                }

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
    }

    function ajaxCompleteStatus(percent){

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
                $( ".edited" ).text( json.allowed ).show();
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
    }
});