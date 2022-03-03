<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servers', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('game_id');
            $table->string('address')->nullable()->index();
            $table->unsignedInteger('port')->index()->nullable();
            $table->unsignedInteger('query_port')->index()->nullable();
            $table->string('title')->index();
            $table->unsignedInteger('current_player_count')->default('0');
            $table->unsignedInteger('max_player_count')->default('0');
            $table->timestamp('last_queried')->nullable()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servers');
    }
}
