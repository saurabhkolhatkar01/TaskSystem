<?php

namespace CodeBank\TaskSystem;

use Illuminate\Support\ServiceProvider;

class TaskServiceProvider extends ServiceProvider {

    public function register() {

        $this->app->bind( 'TaskSystem', function($app) {
            return new TaskSystem;
        } );
    }

    /**
     * Perform post-registration booting of services.
     */
    public function boot() {
        // loading the routes files
        require __DIR__ . '/Http/routes.php';

        // define the path to view files
        $this->loadViewsFrom( __DIR__ . '/views', 'task' );

        // define files which are going to be published
        $this->publishes( [
            __DIR__ . '/migrations/2015_12_30_000000_create_tasks_table.php'   => base_path( 'database/migrations/2015_12_30_000000_create_tasks_table.php' ),
            __DIR__ . '/migrations/2015_12_30_000000_create_folders_table.php' => base_path( 'database/migrations/2015_12_30_000000_create_folders_table.php' ),
        ] );
    }

}
