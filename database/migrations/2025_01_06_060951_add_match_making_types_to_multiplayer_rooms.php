<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('multiplayer_rooms', function (Blueprint $table) {
            DB::statement("ALTER TABLE `multiplayer_rooms` MODIFY `type` ENUM(
                'playlists',
                'head_to_head',
                'team_versus',
                'mm'
            ) NOT NULL");
            DB::statement("ALTER TABLE `multiplayer_rooms` MODIFY `queue_mode` ENUM(
                'host_only',
                'all_players',
                'all_players_round_robin',
                'mm'
            ) NOT NULL DEFAULT 'host_only'");
            DB::statement("ALTER TABLE `multiplayer_rooms` MODIFY `category` ENUM(
                'normal',
                'spotlight',
                'featured_artist',
                'daily_challenge',
                'mm'
            ) NOT NULL DEFAULT 'normal'");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('multiplayer_rooms', function (Blueprint $table) {
            DB::statement("ALTER TABLE `multiplayer_rooms` MODIFY `type` ENUM(
                'playlists',
                'head_to_head',
                'team_versus'
            ) NOT NULL");
            DB::statement("ALTER TABLE `multiplayer_rooms` MODIFY `queue_mode` ENUM(
                'host_only',
                'all_players',
                'all_players_round_robin'
            ) NOT NULL DEFAULT 'host_only'");
            DB::statement("ALTER TABLE `multiplayer_rooms` MODIFY `category` ENUM(
                'normal',
                'spotlight',
                'featured_artist',
                'daily_challenge'
            ) NOT NULL DEFAULT 'normal'");
        });
    }
};
