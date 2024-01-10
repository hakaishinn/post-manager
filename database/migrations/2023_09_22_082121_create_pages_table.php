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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->text('description')->nullable();
            $table->text('body')->nullable();
            $table->string('image')->nullable();

            $table->bigInteger('status_id')->unsigned()->nullable();
            $table->foreign('status_id')->references('id')->on('statuses')->nullOnDelete();
            
            $table->bigInteger('website_id')->unsigned()->nullable();
            $table->foreign('website_id')->references('id')->on('websites')->nullOnDelete();
            
            $table->bigInteger('creater_id')->unsigned()->nullable();
            $table->foreign('creater_id')->references('id')->on('users')->nullOnDelete();
            
            $table->bigInteger('updater_id')->unsigned()->nullable();
            $table->foreign('updater_id')->references('id')->on('users')->nullOnDelete();
            
            $table->bigInteger('company_id')->unsigned()->nullable();
            $table->foreign('company_id')->references('id')->on('companies')->nullOnDelete();

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
        Schema::table('advertise_page', function (Blueprint $table) {
            $table->dropForeign('advertise_page_page_id_foreign');
        });
        Schema::dropIfExists('pages');
    }
};
