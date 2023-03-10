<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourtTimeslotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('court_timeslots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('court_id')
                  ->constrained('courts')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->date('date');
            $table->time('start_time');  
            $table->time('end_time');
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
        Schema::dropIfExists('court_timeslots');
    }
}
