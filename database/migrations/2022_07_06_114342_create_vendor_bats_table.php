<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorBatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_bats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('club_id')
            ->constrained('clubs')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('currency_id')
            ->constrained('currencies')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->string('price');
            $table->string('description');
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
