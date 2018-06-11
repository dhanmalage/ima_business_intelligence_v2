<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_id');
            $table->string('event_name');
            $table->date('event_date');
            $table->time('event_start_time')->nullable();
            $table->time('event_end_time')->nullable();
            $table->integer('attendees_total')->nullable();
            $table->float('paid_total', 10, 2)->nullable();
            $table->string('event_status')->nullable();
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
        Schema::dropIfExists('events');
    }
}
