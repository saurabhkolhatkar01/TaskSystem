<?php

Route::group( ['middleware' => 'web' ], function () {
    Route::get( 'tasks', 'CodeBank\TaskSystem\Http\Controllers\TaskSystemController@index' )->name( 'tasks' );
    Route::post( 'task/add', 'CodeBank\TaskSystem\Http\Controllers\TaskSystemController@updateOrCreateTask' );
    Route::post( 'tasks/list', 'CodeBank\TaskSystem\Http\Controllers\TaskSystemController@getTasksList' )->name( 'tasksList' );
    Route::post( 'task/remove', 'CodeBank\TaskSystem\Http\Controllers\TaskSystemController@removeTask' );
    Route::post( 'task/complete', 'CodeBank\TaskSystem\Http\Controllers\TaskSystemController@completeTask' );

    Route::post( 'folder/add', 'CodeBank\TaskSystem\Http\Controllers\TaskSystemController@updateOrCreateFolder' );
    Route::post( 'folder/edit', 'CodeBank\TaskSystem\Http\Controllers\TaskSystemController@updateOrCreateFolder' );
    Route::post( 'folder/remove', 'CodeBank\TaskSystem\Http\Controllers\TaskSystemController@removeFolder' );
    Route::post( 'folder/archive', 'CodeBank\TaskSystem\Http\Controllers\TaskSystemController@archiveFolder' );
    Route::get( 'folders/list', 'CodeBank\TaskSystem\Http\Controllers\TaskSystemController@getFoldersList' )->name( 'foldersList' );
} );
