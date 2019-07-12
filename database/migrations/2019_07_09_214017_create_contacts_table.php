<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('photo');
            $table->string('fname', 255);
            $table->string('mname', 255);
            $table->string('lname', 255);
            $table->string('email', 320);
            $table->integer('mobile');
            $table->string('landline');
            $table->text('notes');
            $table->enum('type', ['private', 'public']);
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
        Schema::dropIfExists('contacts');
    }
}
