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

class CreateOrEditFolderRequest extends Request {

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
            'folder_name' => 'required',
        ];
    }

    /**
     * Array of messages
     *
     * @return array
     */
    public function messages() {
        return [
            'folder_name.required' => 'Folder name required.',
        ];
    }

}
