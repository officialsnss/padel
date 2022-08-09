<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayersDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
            ->constrained('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->string('player_type', 100)->nullable();
            $table->date('dob')->nullable();
            $table->string('instagram_url', 100)->nullable();
            $table->string('snapchat', 100)->nullable();
            $table->string('whataap_no', 100)->nullable();
            $table->bigInteger('match_played')->nullable();
            $table->bigInteger('match_won')->nullable();
            $table->bigInteger('match_loose')->nullable();
            $table->bigInteger('followers')->nullable();
            $table->bigInteger('following')->nullable();
            $table->bigInteger('levels')->nullable();
            $table->string('court_side')->nullable();
            $table->string('best_shot')->nullable();
            $table->enum('gender', ['1', '2'])->default(2)->comment('1=>"Female", 2=>"Male", 3=>"Other"');
            $table->enum('status', ['1', '2'])->default(1)->comment('1=>"Active", 2=>"Inactive"');
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
        Schema::dropIfExists('players_details');
    }
}
