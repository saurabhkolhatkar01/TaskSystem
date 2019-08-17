<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create( 'tasks', function (Blueprint $table) {
            $table->increments( 'id' );
            $table->integer( 'assign_to' )->nullable();
            $table->integer( 'folder_id' )->nullable();
            $table->string( 'title' );
            $table->text( 'description' )->nullable();
            $table->tinyInteger( 'priority' );
            $table->date( 'due_date' )->nullable();
            $table->tinyInteger( 'is_completed' );
            $table->softDeletes();
            $table->integer( 'created_by' );
            $table->integer( 'updated_by' );
            $table->timestamps();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop( 'tasks' );
    }

}
