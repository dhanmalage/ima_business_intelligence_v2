<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImaEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ima_events', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('source_id');
            $table->string('group')->nullable();
            $table->string('event_name');
            $table->date('event_date');
            $table->time('event_time')->nullable();
            $table->float('price_total', 8, 2)->nullable();
            $table->integer('attendees_total')->nullable();
            $table->integer('attendees_total_complete')->nullable();
            $table->integer('tickets_total')->nullable();
            $table->float('amount_paid_total', 8, 2)->nullable();
            $table->string('status')->nullable();
            $table->integer('created_by');
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
        Schema::dropIfExists('ima_events');
    }
}
