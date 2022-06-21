<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable();
            $table->string('profile_pic')->nullable();
            $table->string('address')->nullable();
            $table->integer('region_id')->nullable();
            $table->integer('city_id')->nullable();
            $table->bigInteger('zip_code')->nullable();
            $table->string('country')->nullable();
            $table->enum('notification',['0' , '1'])->default(0)->comment("0=>'off', 1 =>'on'");
            $table->enum('status',['1' , '2'])->default(1)->comment("1=>'Active', 2 =>'Deactive'");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            Schema::dropIfExists('users');
        });
    }
}
