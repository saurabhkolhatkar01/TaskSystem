@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>Tasks System</h4></div>

                <div class="panel-body">
                    <div id="mainModuleWraper">
                        <div class="row">
                            <!-- START PROFILE SIDEBAR -->
                            <div class="col-sm-3 style-inverse">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <a data-name='Today' href="#">
                                            <i class='glyphicon glyphicon-calendar'></i>
                                            <span>Today</span>
                                            <span class="badge pull-right">14</span>
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <a data-name='Week' href="#">
                                            <i class='glyphicon glyphicon-calendar'></i>
                                            <span>Next 7 days</span>
                                            <span class="badge pull-right">14</span>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <div class="border">
                                            <i class="fa text-lg fa-folder-open"> </i>&nbsp;
                                            <span class=" text-bold">Folders</span>
                                        </div>
                                    </li>
                                    <li class="list-group-item list-group-item-warning">
                                        <a data-name='General' href="#">
                                            <span >General Tasks</span>
                                            <span class="badge pull-right">14</span>
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <a data-name='Completed' href="#">
                                            <span >Completed Tasks</span>
                                            <span class="badge pull-right">14</span>
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#" id="add_edit_folder">
                                            <i class='glyphicon glyphicon-plus'></i>
                                            <span class="text-bold text-primary">Add Folder</span>
                                        </a>
                                        <div style="display: none;" id="add_edit_folder_section">
                                            <div>
                                                <input type="text" placeholder="Enter Folder Name" maxlength="30" required="" class="form-control" data-id="" name="folder_name" id="folder_name">
                                                <span id="folder_name-error"></span>
                                            </div>
                                            <div>
                                                <button class="btn btn-primary" id="save_folder"> Add folder</button>
                                                <a href="#" id="cancel_folder_section">
                                                    <i class="fa"> </i>
                                                    <span >Cancel</span>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <div id="user_folder_list">
                                        {!! $arrFoldersList !!}
                                    </div>

                                    <li class="list-group-item">
                                        <a id="show_hide_archive_folders" href="#">
                                            <i class="fa text-primary fa-download"> </i>
                                            <span class=" text-bold text-primary">Archived Folders</span>
                                        </a>
                                    </li>
                                    <ul style="display: none;" id="archive_folder_section">

                                    </ul>
                                </ul>
                            </div><!--end .col-sm-3 -->
                            <!-- END PROFILE SIDEBAR -->

                            <!-- START PROFILE CONTENT -->
                            <div class="col-sm-9 style-inverse">
                                <div id="tasks_listing">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="text-lg" id="task_header">
                                                <h4>General Tasks </h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-11">
                                            <div style="display: none;" id="add_task_section">
                                                <div class="col-sm-9 border">
                                                    <input type="text" placeholder="Type here to add new task title" class="form-control" maxlength="50" id="task_title">
                                                </div>
                                                <div class="input-group col-sm-3 border control-width-normal">
                                                    <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                    <input id="due_date" type="text" placeholder="dd-mm-yyyy" class="form-control datepicker">
                                                </div>
                                                <div class="col-sm-12">
                                                    <span id="task-error"></span>
                                                </div>
                                                <div class="col-sm-12">
                                                    <button id="add_task" class="btn btn-primary"> Add Task</button>
                                                    <a id="cancel_task_section" href="#">
                                                        <i class="fa"> </i>
                                                        <span >Cancel</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div>
                                                <a href="#" id="add_task_link" style="display: inline-block;">
                                                    <i class='glyphicon glyphicon-plus'></i>
                                                    <span class=" text-bold text-primary">Add Task</span>
                                                </a>
                                            </div>
                                        </div>
                                        <hr/>
                                    </div>

                                    <div class="box box-underline style-transparent" id="load_tasks_list">
                                        {!! $arrTasksList !!}
                                    </div>
                                </div>
                            </div><!--end .col-sm-9 -->
                            <!-- END PROFILE CONTENT -->


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
<script>
    strBaseUrl = document.location.origin;
    $_token = "{{ csrf_token() }}";

    $('body').on('click', '#add_edit_folder', function () {
        $('#save_folder').html('Add folder');
        $('#add_edit_folder_section').show('slow');
        $('#folder_name-error').empty();
        $("#folder_name").val('');
        $("#folder_name").attr('data-id', '');
        $('#add_edit_folder').hide();
    });

    $('body').on('click', '#add_task_link', function () {
        $('#add_task_section').show('slow');
        $('#add_task_link').hide('slow');
        $('#task-error').empty();
        $('#task_title').val('');
        $('.datepicker').val('');
    });

    $('body').on('click', '#cancel_task_section', function () {
        $('#add_task_section').hide('slow');
        $('#add_task_link').show('slow');
    });

    $('body').on('click', '#cancel_folder_section', function () {
        $('#add_edit_folder_section').hide('slow');
        $('#add_edit_folder').show('slow');
        if ('' != $("#folder_name").attr('data-id')) {
            $("#custom_folder_" + $("#folder_name").attr('data-id')).show('slow');
            $("#folder_name").attr('data-id', '');
        }
    });

    $('body').on('click', '#edit_folder', function () {
        $("#folder_name").val($('#custom_folder_' + $(this).parents('ul').attr('data-id')).children('a').attr('data-name'));
        $("#custom_folder_" + $(this).parents('ul').attr('data-id')).hide();
        $('#folder_name-error').empty();
        $("#folder_name").attr('data-id', $(this).parents('ul').attr('data-id'));
        $('#save_folder').html('Save');
        $('#add_edit_folder_section').show('slow');
        $('#add_edit_folder').hide();
    });

    $('body').on('click', '.list-group-item a', function () {
        if (undefined == $(this).attr('id')) {
            $('.list-group-item-warning').removeClass('list-group-item-warning');
            $(this).parent('li').addClass('list-group-item-warning');
        }

        if (undefined != $(this).attr('data-name')) {
            $('#task_header').children().text($('.list-group-item-warning a span:first').text());
            listTasks($(this).attr('data-name'), $(this).attr('data-id'));
        }
    });

    $('body').on('click', '#save_folder', function () {
        if ('' == $('#folder_name').attr('data-id')) {
            var strUrl = '/folder/add';
        } else {
            var strUrl = '/folder/edit';
        }

        saveFolder(strUrl);
    });

    $('body').on('click', '#remove_folder', function () {
        $.ajax({
            url: '/folder/remove',
            type: "POST",
            data: {id: $(this).parents('ul').attr('data-id'), _token: $_token},
            dataType: "json",
            success: function (data, textStatus, jqXHR) {
                if (data.success)
                {
                    listFolders();
                }
            }
        });
    });

    $('body').on('click', '#remove_task', function () {
        var folderId = '';
        var folderName = '';

        if (undefined != $('.list-group-item-warning').children('a').attr('data-id')) {
            folderId = $('.list-group-item-warning').children('a').attr('data-id');
        }

        folderName = $('.list-group-item-warning').children('a').attr('data-name');

        $.ajax({
            url: '/task/remove',
            type: "POST",
            data: {id: $(this).parents('ul').attr('data-id'), _token: $_token},
            dataType: "json",
            success: function (data, textStatus, jqXHR) {
                if (data.success)
                {
                    listTasks(folderName, folderId);
                }
            }
        });
    });

    $('body').on('click', '#complete_task', function () {
        var folderId = '';
        var folderName = '';

        if (undefined != $('.list-group-item-warning').children('a').attr('data-id')) {
            folderId = $('.list-group-item-warning').children('a').attr('data-id');
        }

        folderName = $('.list-group-item-warning').children('a').attr('data-name');

        $.ajax({
            url: '/task/complete',
            type: "POST",
            data: {id: $(this).parents('ul').attr('data-id'), _token: $_token},
            dataType: "json",
            success: function (data, textStatus, jqXHR) {
                if (data.success)
                {
                    listTasks(folderName, folderId);
                }
            }
        });
    });

    $('body').on('click', '#archive_folder', function () {
        $.ajax({
            url: '/folder/archive',
            type: "POST",
            data: {id: $(this).parents('ul').attr('data-id'), _token: $_token},
            dataType: "json",
            success: function (data, textStatus, jqXHR) {
                if (data.success)
                {
                    listFolders();
                }
            }
        });
    });

    $('body').on('click', '#add_task', function () {
        var strUrl = '/task/add';
        saveTask(strUrl);
    });

    function saveFolder(strUrl) {
        $.ajax({
            url: strUrl,
            type: "POST",
            data: {id: $('#folder_name').attr('data-id'), folder_name: $('#folder_name').val(), _token: $_token},
            dataType: "json",
            success: function (data, textStatus, jqXHR) {
                if (data.success)
                {
                    listFolders();
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                var errors = jqXHR.responseJSON;
                $.each(errors, function (key, value) {
                    $('#' + key + '-error').html('<p style="color:red">' + value + '</p>');
                })
            }
        });
    }

    function saveTask(strUrl) {

        var folderId = '';
        var folderName = '';

        if (undefined != $('.list-group-item-warning').children('a').attr('data-id')) {
            folderId = $('.list-group-item-warning').children('a').attr('data-id');
        }

        folderName = $('.list-group-item-warning').children('a').attr('data-name');

        $.ajax({
            url: strUrl,
            type: "POST",
            data: {folder_name: folderName, folder_id: folderId, task_title: $('#task_title').val(), due_date: $('#due_date').val(), _token: $_token},
            dataType: "json",
            success: function (data, textStatus, jqXHR) {
                if (data.success)
                {
                    listTasks(folderName, folderId);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                var errors = jqXHR.responseJSON;

                $('#task-error').empty();

                $strError = '<p style="color:red">';
                $.each(errors, function (key, value) {
                    $strError += value + ' ';

                })

                $strError += '</p>';
                $('#task-error').append($strError);
            }
        });
    }

    function listTasks(folderName, folderId) {
        $.ajax({
            url: '/tasks/list',
            type: "POST",
            data: {folder_id: folderId, folder_name: folderName, _token: $_token},
            dataType: "json",
            success: function (data, textStatus, jqXHR) {
                if (data.success)
                {
                    $('#load_tasks_list').empty();
                    $('#load_tasks_list').html(data.html);
                    $('#add_task_section').hide();
                    $('#add_task_link').show();
                }
            }
        });
    }

    function listFolders() {
        $.ajax({
            url: '/folders/list',
            type: "GET",
            data: {_token: $_token},
            dataType: "json",
            success: function (data, textStatus, jqXHR) {
                if (data.success)
                {
                    $('#user_folder_list').empty();
                    $('#user_folder_list').html(data.html);
                    $('#add_edit_folder_section').hide();
                    $('#add_edit_folder').show();
                }
            }
        });
    }

</script>
@endsection