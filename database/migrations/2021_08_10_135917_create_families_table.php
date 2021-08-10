<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamiliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('families', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('husband_id')->nullable();
            $table->foreign('husband_id')->references('id')->on('people')->onDelete('cascade');
            
            $table->unsignedBigInteger('wife_id')->nullable();
            $table->foreign('wife_id')->references('id')->on('people')->onDelete('cascade');
            
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
        Schema::dropIfExists('families');
    }
}
