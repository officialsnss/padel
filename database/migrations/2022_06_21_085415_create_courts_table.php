<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('courts');
        Schema::create('courts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->foreignId('club_id')
                  ->constrained('clubs')
                  ->onUpdate('cascade')
                  ->onDelete('cascade'); 
            $table->enum('court_type', ['1', '2'])->default(1)->comment("1=>'Indoor', 2=>'Outdoor'");
            $table->string('court_number')->nullable();
            $table->enum('game_type', ['1', '2'])->default(1)->comment("1=>'single', 2=>'Doubles'");
            $table->decimal('single_price', $precision = 8, $scale = 2);
            $table->decimal('double_price', $precision = 8, $scale = 2);
            $table->integer('currency_id'); 
            $table->string('featured_image')->nullable();
            $table->enum('status', ['1', '2'])->default(2)->comment('1=>"Active", 2=>"Inactive"');
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
        Schema::dropIfExists('courts');
    }
}
