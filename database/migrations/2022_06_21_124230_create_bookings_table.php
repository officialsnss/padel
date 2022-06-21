<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
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
            $table->tinyInteger('quantity')->nullable();
            $table->decimal('price', $precision = 8, $scale = 2);
            $table->tinyInteger('currency_id');
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
        Schema::dropIfExists('bookings');
    }
}
