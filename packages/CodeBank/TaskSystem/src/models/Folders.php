<?php

namespace CodeBank\TaskSystem\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Folders extends Model {

    use SoftDeletes;

    protected $table    = 'folders';
    protected $fillable = [ 'name', 'is_archived', 'deleted_at', 'created_by', 'updated_by' ];
    protected $dates = ['deleted_at' ];

}
