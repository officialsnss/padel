<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('match_request', function (Blueprint $table) {
            $table->id();
            $table->foreignId('player_id')
            ->constrained('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('user_id')
            ->constrained('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('match_id')
            ->constrained('matches')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->enum('status', ['1', '2', '3','4'])->default(1)->comment("1=>'Accepted', 2=>'Rejected', 3=>'Pending', 4=>'Not Accepted'");
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
        Schema::dropIfExists('match_request');
    }
}
