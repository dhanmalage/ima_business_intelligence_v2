<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventAttendeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_attendees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fname')->nullable();
            $table->string('lname')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('post_code')->nullable();
            $table->string('how_did')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('event_id')->nullable();
            $table->decimal('ticket_price',10,2)->nullable()->default(0.00);
            $table->decimal('ticket_total',10,2)->nullable()->default(0.00);
            $table->decimal('donation',10,2)->nullable()->default(0.00);
            $table->string('reference')->nullable();
            $table->timestamp('date');
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
        Schema::dropIfExists('event_attendees');
    }
}
