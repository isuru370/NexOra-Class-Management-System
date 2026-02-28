<?php

use App\Enums\ClassType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');

            // Student Identity
            $table->string('custom_id')->unique(); // printed student number
            $table->string('fname');
            $table->string('lname');

            // Contact
            $table->string('mobile');
            $table->string('email')->nullable();
            $table->string('whatsapp_mobile');

            // Personal Info
            $table->string('nic')->nullable();
            $table->date('bday'); // changed to date
            $table->string('gender');

            // Address
            $table->string('address1');
            $table->string('address2');
            $table->string('address3')->nullable();

            // Guardian
            $table->string('guardian_fname')->nullable();
            $table->string('guardian_lname')->nullable();
            $table->string('guardian_nic')->nullable();
            $table->string('guardian_mobile');

            // Student Status
            $table->boolean('is_active')->default(true);

            $table->boolean('permanent_qr_active')->default(false);
             $table->boolean('student_disable')->default(false);

            // Other Details
            $table->mediumText('img_url');
            $table->unsignedBigInteger('grade_id');
            $table->string('class_type')->default(ClassType::OFFLINE);
            $table->boolean('admission')->default(false);
            $table->string('student_school')->nullable();

            $table->timestamps();

            // Foreign Key
            $table->foreign('grade_id')
                  ->references('id')
                  ->on('grades')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('students');
    }
}
