<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('websites', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->text('body')->nullable();
            $table->string('domain')->nullable();
            $table->integer('status_code')->nullable();
            $table->string('status_name')->nullable();
            
            $table->bigInteger('technology_id')->unsigned()->nullable();
            $table->foreign('technology_id')->references('id')->on('technologies')->nullOnDelete();
            
            $table->bigInteger('manager_id')->unsigned()->nullable();
            $table->foreign('manager_id')->references('id')->on('users')->nullOnDelete();
            
            $table->bigInteger('company_id')->unsigned()->nullable();
            $table->foreign('company_id')->references('id')->on('companies')->nullOnDelete();
            
            $table->bigInteger('creater_id')->unsigned()->nullable();
            $table->foreign('creater_id')->references('id')->on('users')->nullOnDelete();
            
            $table->bigInteger('updater_id')->unsigned()->nullable();
            $table->foreign('updater_id')->references('id')->on('users')->nullOnDelete();
            
            $table->bigInteger('analytic_id')->unsigned()->nullable();
            $table->foreign('analytic_id')->references('id')->on('analytics')->nullOnDelete();
            
            $table->string('analytic_code')->nullable();

            $table->bigInteger('team_id')->unsigned()->nullable();
            $table->foreign('team_id')->references('id')->on('teams')->nullOnDelete();
            
            $table->bigInteger('traffic_id')->unsigned()->nullable();
            $table->foreign('traffic_id')->references('id')->on('traffic')->nullOnDelete();
            
            $table->bigInteger('department_id')->unsigned()->nullable();
            $table->foreign('department_id')->references('id')->on('departments')->nullOnDelete();
            
            $table->bigInteger('server_id')->unsigned()->nullable();
            $table->foreign('server_id')->references('id')->on('servers')->nullOnDelete();
           
            $table->bigInteger('setting_id')->unsigned()->nullable();
            $table->foreign('setting_id')->references('id')->on('settings')->nullOnDelete();

            $table->text('meta')->nullable();
            $table->text('yoast-seo')->nullable();
            $table->integer('status')->nullable()->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('websites');
    }
};
