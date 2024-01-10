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
        Schema::create('advertises', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->text('body')->nullable();
            $table->integer('delay_time')->nullable();

            $table->bigInteger('position_id')->unsigned()->nullable();
            $table->foreign('position_id')->references('id')->on('positions')->nullOnDelete();
            
            $table->bigInteger('align_id')->unsigned()->nullable();
            $table->foreign('align_id')->references('id')->on('aligns')->nullOnDelete();
            
            $table->bigInteger('class_id')->unsigned()->nullable();
            $table->foreign('class_id')->references('id')->on('classes')->nullOnDelete();
            
            $table->bigInteger('website_id')->unsigned()->nullable();
            $table->foreign('website_id')->references('id')->on('websites')->nullOnDelete();
            
            $table->bigInteger('status_id')->unsigned()->nullable();
            $table->foreign('status_id')->references('id')->on('statuses')->nullOnDelete();
            
            $table->bigInteger('type_id')->unsigned()->nullable();
            $table->foreign('type_id')->references('id')->on('type_of_advertises')->nullOnDelete();
            
            $table->bigInteger('company_id')->unsigned()->nullable();
            $table->foreign('company_id')->references('id')->on('companies')->nullOnDelete();

            $table->integer('status')->nullable()->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('advertise_page', function (Blueprint $table) {
            $table->dropForeign('advertise_page_advertise_id_foreign');
        });
        Schema::dropIfExists('advertises');
    }
};
