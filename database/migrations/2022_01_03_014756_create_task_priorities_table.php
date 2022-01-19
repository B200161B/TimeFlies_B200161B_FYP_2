<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskPrioritiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_priorities', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('complexity_lvl',['low','medium','high','extreme']);
            $table->enum('important_lvl',['not important','somewhat important','important','very important','extremely important']);
            $table->enum('urgency_lvl',['low','medium','high','extreme']);
            $table->integer('duration_h');
            $table->integer('duration_m');
            $table->integer('tasks_id')->unsigned();
            $table->foreign('tasks_id')
                ->references('id')
                ->on('tasks')
                ->onDelete('cascade');
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
        Schema::dropIfExists('task_priorities');
    }
}
