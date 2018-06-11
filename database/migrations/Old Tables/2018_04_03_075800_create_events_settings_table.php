<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_id');
            $table->string('event_name');
            $table->string('event_status')->nullable()->default('Open');
            $table->integer('imabi_attendees_complete')->nullable()->default(0);
            $table->integer('imabi_attendees_incomplete')->nullable()->default(0);
            $table->timestamps();

            $table->unique('event_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events_settings');
    }
}
