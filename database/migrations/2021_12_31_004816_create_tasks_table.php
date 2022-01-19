<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('task_name');
            $table->date('due_date');
            $table->mediumText('details');
            $table->integer('users_id')->unsigned();
            $table->integer('projects_id')->unsigned();
            $table->enum('status',['Plan','Doing','Review','Done'])->default('Plan');
            $table->string('attachmentFiles')->nullable();
            $table->foreign('users_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('projects_id')
                ->references('id')
                ->on('projects')
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
        Schema::dropIfExists('tasks');
    }
}
