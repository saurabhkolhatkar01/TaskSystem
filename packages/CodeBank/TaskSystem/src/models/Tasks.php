<?php

namespace CodeBank\TaskSystem\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Tasks extends Model {

    use SoftDeletes;

    protected $table    = 'tasks';
    protected $fillable = ['assign_to', 'folder_id', 'title', 'description', 'priority', 'due_date', 'is_completed', 'deleted_at', 'created_by', 'updated_by' ];
    protected $dates    = ['deleted_at' ];

    static function getTasksList( $request ) {

        if( '' != $request->folder_id ) {
            $arrTasks = DB::table( 'tasks' )
                    ->join( 'folders', 'folders.id', '=', 'tasks.folder_id' )
                    ->select( 'folders.name as folder_name', 'tasks.*' )
                    ->where( 'tasks.folder_id', $request->folder_id )
                    ->where( 'tasks.created_by', Auth::id() )
                    ->where( 'is_completed', 0 )
                    ->whereNull( 'tasks.deleted_at' )
                    ->orderBy( 'due_date', 'DESC' )
                    ->orderBy( 'title', 'ASC' )
                    ->get();
        }
        else {
            switch( $request->folder_name ) {
                case NULL:
                case 'General':
                    $arrTasks = DB::table( 'tasks' )
                            ->where( 'created_by', Auth::id() )
                            ->where( 'is_completed', 0 )
                            ->whereNull( 'folder_id' )
                            ->whereNull( 'deleted_at' )
                            ->orderBy( 'due_date', 'DESC' )
                            ->orderBy( 'title', 'ASC' )
                            ->get();
                    break;

                case 'Completed':
                    $arrTasks = DB::table( 'tasks' )
                            ->where( 'created_by', Auth::id() )
                            ->where( 'is_completed', 1 )
                            ->whereNull( 'deleted_at' )
                            ->orderBy( 'due_date', 'DESC' )
                            ->orderBy( 'title', 'ASC' )
                            ->get();
                    break;

                case 'Today':
                    $arrTasks = DB::table( 'tasks' )
                            ->where( 'created_by', Auth::id() )
                            ->where( 'is_completed', 0 )
                            ->where( 'due_date', date( 'Y-m-d' ) )
                            ->whereNull( 'deleted_at' )
                            ->orderBy( 'due_date', 'DESC' )
                            ->orderBy( 'title', 'ASC' )
                            ->get();
                    break;

                case 'Week':
                    $arrTasks = DB::table( 'tasks' )
                            ->where( 'created_by', Auth::id() )
                            ->where( 'is_completed', 0 )
                            ->whereBetween( 'due_date', [date( 'Y-m-d' ), date( 'Y-m-d', strtotime( "+6 day", strtotime( date( 'Y-m-d' ) ) ) ) ] )
                            ->whereNull( 'deleted_at' )
                            ->orderBy( 'due_date', 'DESC' )
                            ->orderBy( 'title', 'ASC' )
                            ->get();
                    break;


                default:
                    break;
            }
        }

        return $arrTasks;
    }

}
