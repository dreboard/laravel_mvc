/*!
 * Ticket Update
 * Docs & License: https://github.com/dreboard
 * (c) 2018 Dev-PHP
 */
$(document).ready(function () {

    $(".edited").removeClass('text-danger');

    $("input:checked").each(function () {
        var id = $(this).data("task");
        $("#taskText" + id).addClass('taskDone');
    });

    $('#status').on("change", function (e) {
        $("div.edited").hide();
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
            dataType: "json",
        })

            .done(function (json) {
                $(".edited").text(json.allowed).show();
                if ($("#status").val() == 'complete') {
                    $('.progress-bar').css('width', '100%').attr('aria-valuenow', 100);
                    $('#progressbarText').text(100);
                    $('#completed').prop("disabled", true);
                    $("#completed").val("100").change();

                } else {
                    $('.progress-bar').css('width', json.completed + '%').attr('aria-valuenow', json.completed);
                    $('#progressbarText').text(json.completed);
                    $('#completed').prop("disabled", false);
                }
            })

            .fail(function (xhr, status, errorThrown) {
                ajaxError(xhr, status, errorThrown);
            })

            .always(function (xhr, status) {
                //alert( data );
            });
    });

    $('.task_check').on("click", function (e) {
        var el = $(this);
        taskChecked(el);
    });

    $('#completed').on('change', function () {
        ajaxCompleteStatus(percent = 100);
    });


    $('#new_task_form').on("submit", function (e) {
        e.preventDefault();

        if ($("#task_title").val() === '') {
            return false;
        }
        $(".edited").hide();

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
            dataType: "json",
        })

            .done(function (json) {
                showMessage(json.allowed);
                if (json.allowed == 'Not assigned this task') {
                    $(".edited").addClass('text-danger');
                } else {
                    $(".edited").removeClass('text-danger');
                }

                var form = $(
                    '<tr>' +
                    '<td class="completeCheck">' +
                    '<form class="form-inline">' +
                    '<div class="form-check mb-2 mr-sm-2">' +
                    '<input class="task_check" type="checkbox" id="taskStatus' + json.task_id + ' " name="taskStatus" data-task="' + json.task_id + '" value="0">' +
                    '</div></form></td>' +
                    '<td><span id="taskText' + json.task_id + '" class="taskTitle"> ' + json.title + '</span></td>' +
                    '</tr>'
                );

                $('#taskListTable').append(form);

                scrollDiv();

                $(form).on('click', '.task_check', function (e) {
                    var el = $(this);
                    taskChecked(el);
                });
            })

            .fail(function (xhr, status, errorThrown) {
                ajaxError(xhr, status, errorThrown);
            })

            .always(function (xhr, status, json) {
                if (ENVIRONMENT === "local") {
                    console.log(status);
                }
            });
    });


    $("span.editable").on('dblclick', function () {
        var task_id = $(this).data("task");
        if ($('#taskStatus' + task_id).prop('checked') === true) {
            return false;
        }
        $('#editTaskInput' + task_id).html($(this).html()).show().focus();
        $(this).hide();
    });

    $(".editTaskInputs").blur(function () {
        var task_id = $(this).data("task_id");
        var new_task_title;
        if ($(this).val() === '') {
            new_task_title = $('#editTaskInput' + task_id).html();
        }else {
            new_task_title = $(this).val();
        }
        $('span#taskText' + task_id).html($(this).val()).show();
        $(this).hide();
        saveTaskData(task_id, new_task_title);
    });

    function saveTaskData(id, val) {
        $("div.edited").hide();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: ticket.task_url,

            data: {
                task_id: id,
                task_title: val,
                _token: ticket.token,
            },

            type: "POST",
            dataType: "json",
        })

            .done(function (json) {
                showMessage(json.allowed)
                if (json.allowed == 'Not assigned this task') {
                    $(".edited").addClass('text-danger');

                } else {
                    $(".edited").removeClass('text-danger');
                }

            })

            .fail(function (xhr, status, errorThrown) {
                ajaxError(xhr, status, errorThrown);
            })

            .always(function (xhr, status, json) {
                if (ENVIRONMENT === "local") {
                    console.log(status);
                }
            });
    }
    function taskChecked(element) {
        $("div.edited").hide();
        var task_id = $(element).data("task");
        var task_complete = 0;

        if ($(element).prop('checked') === true) {
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
            dataType: "json",
        })

            .done(function (json) {
                showMessage(json.allowed)
                if (json.allowed == 'Not assigned this task') {
                    $(".edited").addClass('text-danger');
                } else {
                    $(".edited").removeClass('text-danger');
                }

                if (json.complete == 0) {
                    $("#taskText" + task_id).removeClass('taskDone');
                } else {
                    $("#taskText" + task_id).addClass('taskDone');
                }
            })

            .fail(function (xhr, status, errorThrown) {
                ajaxError(xhr, status, errorThrown);
            })

            .always(function (xhr, status, json) {
                if (ENVIRONMENT === "local") {
                    console.log(status);
                }
            });
    }

    function ajaxCompleteStatus(percent) {

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
            dataType: "json",
        })

            .done(function (json) {
                $('.progress-bar').css('width', json.completed + '%').attr('aria-valuenow', json.completed);
                $('#progressbarText').text(json.completed);
                showMessage(json.allowed);
            })

            .fail(function (xhr, status, errorThrown) {
                ajaxError(xhr, status, errorThrown);
            })

            .always(function (xhr, status, json) {
                if (ENVIRONMENT === "local") {
                    console.log(status);
                }
            });


    }

    $('#saveTicketNoteBtn').on('click', function () {
        //
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: ticket.note_url,

            data: {
                ticket_id: $("#ticket_id").val(),
                note: $("#note").val(),
                _token: ticket.token,
            },

            type: "POST",
            dataType: "json",
        })

            .done(function (json) {
                showMessage(json.allowed);

                if (json.allowed == 'Note Not Added') {
                    $(".edited").addClass('text-danger');
                } else {
                    $(".edited").removeClass('text-danger');
                    $('#modalNotesForm').modal('hide')
                }
            })

            .fail(function (xhr, status, errorThrown) {
                ajaxError(xhr, status, errorThrown);
            })

            .always(function (xhr, status, json) {
                if (ENVIRONMENT === "local") {
                    console.log(status);
                }
            });

    });

    function showMessage(msg){
        $(".edited").text(msg).show();
        setTimeout(function(){
            $(".edited").text('');
        }, 3000);
    }

    function scrollDiv(){
        $(".table-wrapper").animate({
            scrollTop: $('.table-wrapper')[0].scrollHeight - $('.table-wrapper')[0].clientHeight
        }, 1000);
    }

    function ajaxError(xhr, status, errorThrown){
        showMessage("Sorry, there was a problem!");
        if (ENVIRONMENT === "local") {
            console.log("Error: " + errorThrown);
            console.log("Status: " + status);
            console.dir(xhr);
        }
    }
});