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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->text('description')->nullable();
            $table->text('body')->nullable();
            $table->string('image')->nullable();
            $table->string('status_name')->nullable();
            $table->integer('status_code')->nullable();
            $table->integer('status')->nullable()->default(1);
            $table->string('publish')->nullable();
            $table->string('cate_wp_id')->nullable();

            $table->bigInteger('company_id')->unsigned()->nullable();
            $table->foreign('company_id')->references('id')->on('companies')->nullOnDelete();
            
            $table->bigInteger('creater_id')->unsigned()->nullable();
            $table->foreign('creater_id')->references('id')->on('users')->nullOnDelete();
            
            $table->bigInteger('updater_id')->unsigned()->nullable();
            $table->foreign('updater_id')->references('id')->on('users')->nullOnDelete();
            
            $table->bigInteger('parent_id')->unsigned()->nullable();
            $table->foreign('parent_id')->references('id')->on('categories')->nullOnDelete();
            
            $table->bigInteger('website_id')->unsigned()->nullable();
            $table->foreign('website_id')->references('id')->on('websites')->nullOnDelete();
            
            $table->bigInteger('display_home_id')->unsigned()->nullable();
            $table->foreign('display_home_id')->references('id')->on('display_homes')->nullOnDelete();
            
            $table->bigInteger('color_id')->unsigned()->nullable();
            $table->foreign('color_id')->references('id')->on('colors')->nullOnDelete();

            $table->text('meta')->nullable();
            $table->text('yoast-seo')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
