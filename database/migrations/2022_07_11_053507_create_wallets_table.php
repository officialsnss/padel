<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->foreignId('booking_id')
                  ->constrained('bookings')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->foreignId('currency_id')
                  ->constrained('currencies')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->integer('amount');
            $table->enum('status', ['1', '2'])->comment("'1'=> 'Refund', '2' => 'Booking'");
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
        Schema::table('wallets', function (Blueprint $table) {
            //
        });
    }
}
