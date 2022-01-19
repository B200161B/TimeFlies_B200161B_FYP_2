<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkspaceProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workspace_projects', function (Blueprint $table) {
            $table->integer('workspaces_id')->unsigned();
            $table->integer('projects_id')->unsigned();
            $table->foreign('workspaces_id')
                ->references('id')
                ->on('workspaces')
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
        Schema::dropIfExists('workspace_projects');
    }
}
