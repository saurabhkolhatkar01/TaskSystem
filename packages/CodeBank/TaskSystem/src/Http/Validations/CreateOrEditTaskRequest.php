<?php

/**
 *  This Class is used to validate Scheduled Reports data
 *
 * @name        CreateScheduledReportRequest
 * @version
 * @category    Scheduled Report validation module
 * @link
 */

namespace CodeBank\TaskSystem\Http\Validations;

use App\Http\Requests\Request;
use Carbon\Carbon;

class CreateOrEditTaskRequest extends Request {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {

        return [
            'task_title' => 'required',
            'due_date'   => 'date|date_format:d-m-Y|after:today',
        ];
    }

    /**
     * Array of messages
     *
     * @return array
     */
    public function messages() {
        return [
            'due_date.date'        => 'The due date is not a valid date',
            'due_date.date_format' => ' The due date does not match the format dd/mm/yyyy',
            'due_date.after'       => ' The due date must be a date after today.',
        ];
    }

}
