<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name_kh');
            $table->string('name_latin');
            $table->string('email');
            $table->integer('phone');
            $table->string('birth_date');
            $table->string('address');

            $table->boolean('active');
            
            $table->string('gender');

            $table->string('department');
            $table->string('related_user');
            $table->string('associated_roles');


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
        Schema::dropIfExists('employees');
    }
}
