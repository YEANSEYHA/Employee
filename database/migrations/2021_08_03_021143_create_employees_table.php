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
            $table->string('email')->unique();
            $table->string('phone',15);
            $table->string('birth_date');
            $table->string('address');
            $table->boolean('active')->default(0);
            $table->string('role')->nullable();
            $table->string('gender', 10);
            $table->integer('department_id')->nullable();
            //$table->foreign('department_id')->references('id')->on('department')->onDelete('cascade');
            $table->integer('related_user_id')->nullable();
            $table->integer('associated_roles_id')->nullable();
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
