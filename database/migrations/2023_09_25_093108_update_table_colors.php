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
        Schema::table('colors', function (Blueprint $table) {
            $table->bigInteger('status_id')->unsigned()->nullable();
            $table->foreign('status_id')->references('id')->on('statuses')->nullOnDelete();
            
            $table->bigInteger('website_id')->unsigned()->nullable();
            $table->foreign('website_id')->references('id')->on('websites')->nullOnDelete();
            
            $table->bigInteger('menu_id')->unsigned()->nullable();
            $table->foreign('menu_id')->references('id')->on('type_of_menus')->nullOnDelete();
            
            $table->bigInteger('creater_id')->unsigned()->nullable();
            $table->foreign('creater_id')->references('id')->on('users')->nullOnDelete();
            
            $table->bigInteger('updater_id')->unsigned()->nullable();
            $table->foreign('updater_id')->references('id')->on('users')->nullOnDelete();

            $table->integer('status')->nullable()->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
