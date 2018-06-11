<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImaEventDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ima_event_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ima_admin_event_id')->unsigned()->nullable();
            $table->string('group');
            $table->integer('web_ref_id');
            $table->string('reg_id');
            $table->string('pay_method');
            $table->date('reg_date');
            $table->string('pay_status');
            $table->string('pay_type');
            $table->string('transaction_id');
            $table->float('price', 8, 2);
            $table->string('coupon_code');
            $table->integer('attendees');
            $table->float('amount_paid', 8, 2);
            $table->date('date_paid');
            $table->string('event_name');
            $table->string('price_option');
            $table->date('event_date');
            $table->time('event_time');
            $table->string('web_check_in');
            $table->integer('tickets_scanned');
            $table->date('check_in_date');
            $table->string('seat_tag');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->integer('created_by');
            $table->timestamps();

            $table->foreign('ima_admin_event_id')->references('id')->on('ima_events');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ima_event_details');
    }
}
