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
            $table->enum('notification',['0' , '1'])->default(0)->comment("0=>'off', 1 =>'on'")->after('remember_token');
            $table->enum('status',['1' , '2'])->default(1)->comment("1=>'Active', 2 =>'Deactive'")->after('remember_token');
            $table->string('country')->after('remember_token')->nullable();
            $table->bigInteger('zip_code')->after('remember_token')->nullable();
            $table->integer('city_id')->after('remember_token')->nullable();
            $table->integer('region_id')->after('remember_token')->nullable();
            $table->string('address')->after('remember_token')->nullable();
            $table->string('profile_pic')->after('remember_token')->nullable();
            $table->string('phone')->after('remember_token')->nullable();
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
