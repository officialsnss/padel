<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clubs', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->text('description');
            $table->integer('bat_id')->nullable();
            $table->decimal('service_charge', $precision = 8, $scale = 2); 
            $table->integer('currency_id');  
            $table->string('address')->nullable();
            $table->tinyInteger('region_id')->nullable();
            $table->tinyInteger('city_id')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('country')->nullable();
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
        Schema::dropIfExists('clubs');
    }
}
