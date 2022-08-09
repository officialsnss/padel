<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWishlistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wishlist', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
            ->constrained('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('court_id')
            ->constrained('courts')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('bat_id')
            ->constrained('bats')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('slot_id')
            ->constrained('court_timeslots')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->tinyInteger('quantity');
            $table->decimal('price', $precision = 8, $scale = 2);
            $table->integer('currency_id'); 
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
        Schema::dropIfExists('wishlist');
    }
}
