<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookmanagmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookmanagments', function (Blueprint $table) {
            $table->id();
            $table->string('book_name');
            $table->string('book_Category');
            $table->string('book_Author');
            $table->string('book_isbn');
            $table->string('book_price');
            $table->string('book_image');
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
        Schema::dropIfExists('bookmanagments');
    }
}
