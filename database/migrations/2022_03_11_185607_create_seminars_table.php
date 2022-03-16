<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeminarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seminars', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('seminar_period');
            $table->tinyInteger('seminar_type');
            $table->date('seminar_date');
            $table->string('seminar_name');
            $table->string('seminar_code', 10);
            $table->foreignId('student_group_id')->constrained();
            $table->foreignId('room_id')->constrained();
            $table->foreignId('academic_id')->constrained();
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
        Schema::dropIfExists('seminars');
    }
}
