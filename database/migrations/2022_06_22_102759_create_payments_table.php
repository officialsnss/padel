<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
            ->constrained('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('booking_id')
            ->constrained('bookings')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->decimal('price', $precision = 8, $scale = 2);
            $table->enum('payment_method',['1' , '2'])->default(2)->comment("1='Instant', 2=>'Later'");
            $table->decimal('advance_price', $precision = 8, $scale = 2)->comment("In case of later payment");
            $table->string('transaction_id');
            $table->enum('payment_status',['1' , '2', '3', '4'])->default(2)->comment("	1='Completed',2=>'Pending', 3=>'Cancellation',4=>'Refunded'");
            $table->foreignId('coupons_id')
            ->constrained('coupons')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->decimal('total_amount', $precision = 8, $scale = 2);
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
        Schema::dropIfExists('payments');
    }
}

