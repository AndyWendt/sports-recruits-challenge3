<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class BaseMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared(file_get_contents(\Illuminate\Support\Facades\App::basePath('dynamic_data_seed.sql')));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        collect(DB::select('SHOW TABLES'))
            ->map(fn($object) => Arr::first((array) $object))
            ->filter(fn($table) => $table != 'migrations')
            ->each(fn($table) => Schema::drop($table));
    }
}
