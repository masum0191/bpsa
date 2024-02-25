<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('Pub_Date');
            $table->string('Category');

            $table->string('Heading')->nullable();
            $table->string('Sub_Heading')->nullable();
            $table->date('Start_Date')->nullable();
            $table->date('End_Date')->nullable();
            $table->text('Details')->nullable();
            $table->string('Cover_Photo')->nullable();
            $table->boolean('Home_Page_Placement')->nullable();
            $table->string('Document_Link')->nullable();
            $table->string('gimage')->nullable();
           
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
        Schema::dropIfExists('posts');
    }
}
