<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenaltiesTable extends Migration
{
    /**
     * Run the migrations.
     *  'transaction_id', 'amount', 'lates_day', 'payment_date'
     * @return void
     */
    public function up()
    {
        Schema::create('penalties', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('amount');
            $table->string('borrow_date')->nullable();
            $table->string('return_date')->nullable();
            $table->string('lates_day')->nullable();
            $table->dateTime('payment_date');
            $table->longText('description');
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
        Schema::dropIfExists('penalties');
    }
}
