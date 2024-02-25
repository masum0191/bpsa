<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formers', function (Blueprint $table) {
            $table->id();
            $table->string('Session')->nullable();
            $table->string('President_Name')->nullable();
            $table->string('President_Image')->nullable();
            $table->string('President_Designation')->nullable();
            $table->string('Secretary_Image')->nullable();
            $table->string('Secretary_Designation')->nullable();
            $table->string('Secretary_Name')->nullable();
            $table->boolean('status')->nullable();
            
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
        Schema::dropIfExists('formers');
    }
}
