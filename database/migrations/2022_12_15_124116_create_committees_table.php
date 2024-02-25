<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommitteesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('committees', function (Blueprint $table) {
            $table->id();
            $table->string('PIMS_ID')->nullable();
            $table->string('BPSA_Designation_id')->nullable();
            $table->string('Name')->nullable();
            $table->string('Officail_Designation')->nullable();
            $table->string('Mobile_Number')->nullable();
            
            $table->string('Association_Year')->nullable();
            $table->string('AddedBy')->nullable();
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
        Schema::dropIfExists('committees');
    }
}
