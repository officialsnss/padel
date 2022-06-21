<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('player_id')
            ->constrained('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('club_id')
            ->constrained('clubs')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('court_id')
            ->constrained('courts')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->enum('match_type', ['1', '2'])->default(1)->comment("1=>'Public', 2=>'Private'");
            $table->enum('is_friendly', ['0', '1'])->default(1)->comment(" 0=>'game', 1=>'friendly'");
            $table->string('gender_allowed')->comment("1=>'Female', 2=>'Male'");
            $table->enum('status', ['1', '2', '3'])->default(1)->comment("1=>'Upcoming', 2=>'Played', 3=>'Cancelled'");
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
        Schema::dropIfExists('matches');
    }
}
