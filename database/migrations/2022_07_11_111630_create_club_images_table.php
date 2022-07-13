<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClubImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('club_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('club_id')
            ->constrained('clubs')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->string('image', 100);
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
        Schema::table('club_images', function (Blueprint $table) {
            //
        });
    }
}
