<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAutoStartDurationToMultiplayerRooms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('multiplayer_rooms', function (Blueprint $table) {
            $table->unsignedSmallInteger('auto_start_duration')->after('queue_mode')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('multiplayer_rooms', function (Blueprint $table) {
            $table->dropColumn('auto_start_duration');
        });
    }
}
