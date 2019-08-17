<?php

/**
 * This controller have all task related methods
 *
 * @name        TaskSystemController
 * @version
 * @category    Task System Module
 * @Updated     02 Feb 2016
 * @link
 */

namespace CodeBank\TaskSystem\Http\Controllers;

use App\Http\Controllers\Controller;
use CodeBank\TaskSystem\models\Tasks;
use Illuminate\Support\Facades\Auth;
use CodeBank\TaskSystem\Http\Validations\CreateOrEditFolderRequest;
use CodeBank\TaskSystem\Http\Validations\CreateOrEditTaskRequest;
use CodeBank\TaskSystem\models\Folders;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TaskSystemController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware( 'auth' );
    }

    /**
     *  This function will list all tasks for login user
     *
     * @name    getTasksList
     * @access	public
     * @param
     * @return
     */
    public static function index( Request $request ) {

        $arrFoldersList = self::getFoldersList( $request );
        $arrTasksList   = self::getTasksList( $request );

        return view( 'task::view' )->with( 'arrFoldersList', $arrFoldersList )->with( 'arrTasksList', $arrTasksList );
    }

    /**
     *  This function will create or update folder
     *
     * @name    updateOrCreateFolder
     * @access	public
     * @param   obj $request request object to validate
     * @return
     */
    public static function updateOrCreateFolder( CreateOrEditFolderRequest $request ) {

        $intCreatedBy = Auth::id();

        if( isset( $request->id ) && '' != $request->id ) {
            $intCreatedBy = $request->created_by;
        }

        $arrFolders = array(
            'name'       => $request->folder_name,
            'updated_by' => Auth::id(),
            'created_by' => $intCreatedBy,
        );

        Folders::updateOrCreate( ['id' => $request->id ], $arrFolders );

        if( $request->ajax() ) {
            return response()->json( ['success' => true ] );
        }
        else {
            return redirect()->route( 'tasks' );
        }
    }

    /**
     *  This function will soft delete folder
     *
     * @name    removeFolder
     * @access	public
     * @param   obj $request request object to validate
     * @return
     */
    public static function removeFolder( Request $request ) {
        $objFolder = Folders::find( $request->id );
        $objFolder->delete();

        if( $request->ajax() ) {
            return response()->json( ['success' => true ] );
        }
        else {
            return redirect()->route( 'tasks' );
        }
    }

    /**
     *  This function will create or update folder
     *
     * @name    removeFolder
     * @access	public
     * @param   obj $request request object to validate
     * @return
     */
    public static function archiveFolder( Request $request ) {
        $objFolder = Folders::find( $request->id );

        $objFolder->is_archived = 1;
        $objFolder->update();

        if( $request->ajax() ) {
            return response()->json( ['success' => true ] );
        }
        else {
            return redirect()->route( 'tasks' );
        }
    }

    /**
     *  This function will get folders list
     *
     * @name    getFolders
     * @access	public
     * @param   obj $request request object to validate
     * @return
     */
    public static function getFoldersList( Request $request ) {

        $arrFoldersList = Folders::where( [
                    'created_by'  => Auth::id(),
                    'deleted_at'  => NULL,
                    'is_archived' => 0 ] )->get();

        if( $request->ajax() ) {
            $strHtml = view( 'task::folder-lists' )->with( 'arrFoldersList', $arrFoldersList )->render();
            return response()->json( ['success' => true, 'html' => $strHtml ] );
        }
        else {
            return view( 'task::folder-lists' )->with( 'arrFoldersList', $arrFoldersList )->render();
        }
    }

    /**
     *  This function will create or update task
     *
     * @name    updateOrCreateTask
     * @access	public
     * @param   obj $request request object to validate
     * @return
     */
    public static function updateOrCreateTask( CreateOrEditTaskRequest $request ) {

        $intCreatedBy = Auth::id();

        if( isset( $request->id ) && '' != $request->id ) {
            $intCreatedBy = $request->created_by;
        }

        $arrTasks = array(
            'assign_to'   => $request->assign_to,
            'folder_id'   => ('' != $request->folder_id) ? $request->folder_id : NULL,
            'title'       => $request->task_title,
            'description' => $request->description,
            'due_date'    => ('' != $request->due_date) ? Carbon::createFromFormat( 'd-m-Y', $request->due_date ) : NULL,
            'updated_by'  => Auth::id(),
            'created_by'  => $intCreatedBy,
        );

        Tasks::updateOrCreate( ['id' => $request->id ], $arrTasks );

        if( $request->ajax() ) {
            return response()->json( ['success' => true ] );
        }
        else {
            return redirect()->route( 'tasks' );
        }
    }

    /**
     *  This function will get Tasks list
     *
     * @name    getTasksList
     * @access	public
     * @param   obj $request request object to validate
     * @return
     */
    public static function getTasksList( Request $request ) {

        $arrTasksList = Tasks::getTasksList( $request );

        if( $request->ajax() ) {
            $strHtml = view( 'task::task-lists' )->with( 'arrTasksList', $arrTasksList )->render();
            return response()->json( ['success' => true, 'html' => $strHtml ] );
        }
        else {
            return view( 'task::task-lists' )->with( 'arrTasksList', $arrTasksList )->render();
        }
    }

    /**
     *  This function will soft deletes task
     *
     * @name    removeTask
     * @access	public
     * @param   obj $request request object to validate
     * @return
     */
    public static function removeTask( Request $request ) {
        $objTask = Tasks::where( ['id' => $request->id, 'is_completed' => 0 ] );
        $objTask->delete();

        if( $request->ajax() ) {
            return response()->json( ['success' => true ] );
        }
        else {
            return redirect()->route( 'tasks' );
        }
    }

    /**
     *  This function mark task as complete
     *
     * @name    completeTask
     * @access	public
     * @param   obj $request request object to validate
     * @return
     */
    public static function completeTask( Request $request ) {
        $objTask = Tasks::find( $request->id );

        $objTask->is_completed = 1;

        $objTask->update();

        if( $request->ajax() ) {
            return response()->json( ['success' => true ] );
        }
        else {
            return redirect()->route( 'tasks' );
        }
    }

}
