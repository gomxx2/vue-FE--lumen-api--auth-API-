<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calls', function (Blueprint $table) {
            $table->BigIncrements('id');
            $table->string('subject');
            $table->text('Description');
            $table->string('status_call');
            $table->string('status_direction');
            $table->string('Parent_type');
            $table->string('relate');
            $table->string('start_date');
            $table->string('calls_owner');
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
        //
    }
}
