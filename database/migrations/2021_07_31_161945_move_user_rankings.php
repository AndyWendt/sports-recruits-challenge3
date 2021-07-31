<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MoveUserRankings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Use query builder here instead of a model since
        // inevitably a delta develops over time between the
        // model definition and the database at this point in time
        // resulting in errors when one attempts to run the migrations

        $users = DB::table('users')
            ->select('id as user_id', 'ranking')
            ->whereNotNull('ranking')
            ->get()
            ->map(fn($user) => (array) $user);

        DB::table('rankings')->insert($users->toArray());
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $rankings = DB::table('rankings')
            ->select('user_id', 'ranking')
            ->get();

        // I wish I had laravel 8's upsert capabilities here...
        $rankings
            ->each(fn($ranking) => DB::table('users')
                ->where(['id' => $ranking->user_id])
                ->update(['ranking' => $ranking->ranking])
            );
    }
}
