<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewFieldsInClubs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clubs', function (Blueprint $table) {
            $table->integer('indoor_courts')->after('amenities')->nullable();
            $table->integer('outdoor_courts')->after('indoor_courts')->nullable();
            $table->decimal('single_price', $precision = 8, $scale = 2)->after('outdoor_courts')->nullable();
            $table->decimal('double_price', $precision = 8, $scale = 2)->after('single_price')->nullable();
            $table->string('featured_image')->after('double_price')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clubs', function (Blueprint $table) {
            //
        });
    }
}
