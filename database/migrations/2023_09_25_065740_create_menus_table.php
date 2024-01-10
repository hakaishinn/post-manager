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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('url')->nullable();
            $table->string('target')->nullable();
            $table->string('icon')->nullable();
            $table->string('class_name')->nullable();

            $table->bigInteger('status_id')->unsigned()->nullable();
            $table->foreign('status_id')->references('id')->on('statuses')->nullOnDelete();
            
            $table->bigInteger('type_id')->unsigned()->nullable();
            $table->foreign('type_id')->references('id')->on('type_of_menus')->nullOnDelete();
            
            $table->bigInteger('website_id')->unsigned()->nullable();
            $table->foreign('website_id')->references('id')->on('websites')->nullOnDelete();
            
            $table->bigInteger('parent_id')->unsigned()->nullable();
            $table->foreign('parent_id')->references('id')->on('menus')->nullOnDelete();
            
            $table->bigInteger('brand_id')->unsigned()->nullable();
            $table->foreign('brand_id')->references('id')->on('brands')->nullOnDelete();
            
            $table->bigInteger('creater_id')->unsigned()->nullable();
            $table->foreign('creater_id')->references('id')->on('users')->nullOnDelete();
            
            $table->bigInteger('updater_id')->unsigned()->nullable();
            $table->foreign('updater_id')->references('id')->on('users')->nullOnDelete();

            $table->integer('status')->nullable()->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
