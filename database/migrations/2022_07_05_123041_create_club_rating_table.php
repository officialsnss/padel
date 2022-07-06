<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClubRatingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('club_rating', function (Blueprint $table) {
            $table->id();
            $table->foreignId('club_id')
            ->constrained('clubs')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->decimal('rate',$precision = 8, $scale = 2);
            $table->string('image', 100)->nullable();
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
            Schema::dropIfExists('court_rating');
    }
}
