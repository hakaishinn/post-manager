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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->text('description')->nullable();
            $table->text('body')->nullable();
            $table->string('image')->nullable();
            $table->string('image_name')->nullable();

            $table->bigInteger('website_id')->unsigned()->nullable();
            $table->foreign('website_id')->references('id')->on('websites')->nullOnDelete();

            $table->bigInteger('company_id')->unsigned()->nullable();
            $table->foreign('company_id')->references('id')->on('companies')->nullOnDelete();

            $table->bigInteger('creater_id')->unsigned()->nullable();
            $table->foreign('creater_id')->references('id')->on('users')->nullOnDelete();

            $table->bigInteger('updater_id')->unsigned()->nullable();
            $table->foreign('updater_id')->references('id')->on('users')->nullOnDelete();
            
            $table->string('post_wp_id')->nullable();
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
        Schema::dropIfExists('posts');
    }
};
