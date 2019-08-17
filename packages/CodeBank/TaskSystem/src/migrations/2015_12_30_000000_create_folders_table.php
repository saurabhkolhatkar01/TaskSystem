<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFoldersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create( 'folders', function (Blueprint $table) {
            $table->increments( 'id' );
            $table->string( 'name' );
            $table->tinyInteger( 'is_archived' );
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
        Schema::drop( 'folders' );
    }

}
