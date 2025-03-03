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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('type')->nullable();
            //TODO supreem_court_bar_association

            // $table->string('memberId')->nullable();
            // $table->string('memberName')->nullable();
            // $table->string('spouseName')->nullable();
            // $table->string('fatherName')->nullable();
            // $table->string('motherName')->nullable();
            // $table->string('mobile')->nullable();
            // $table->string('email')->nullable();
            // $table->string('picture')->nullable();
            // $table->string('dateOfBirth')->nullable();
            // $table->string('nid')->nullable();
            // $table->string('bloodGroup')->nullable();
            // $table->string('maritalStatus')->nullable();
            // $table->string('religion')->nullable();
            // $table->text('presentAddress')->nullable();
            // $table->text('parmanentAddress')->nullable();
            // $table->string('chamberAddress')->nullable();
            // $table->string('status')->nullable();
            // $table->string('barDateOfJoining')->nullable();
            // $table->string('barDateOfEnrollment')->nullable();
            // $table->string('barCourtType')->nullable();
            // $table->string('starMark')->nullable();
            // $table->string('chamberStatus')->nullable();

            //TODO institute_of_engineers
            // $table->string('name')->nullable();
            // $table->text('address')->nullable();
            // $table->text('imageSrc')->nullable();
            // $table->string('email')->nullable();
            // $table->string('division')->nullable();
            // $table->string('center')->nullable();
            // $table->string('institution')->nullable();
            // $table->string('passingYear')->nullable();
            // $table->string('membershipNo')->nullable();
            // $table->string('mobile')->nullable();


            //TODO chittrong_district_bar_association
            $table->string('memberId')->nullable();
            $table->string('memberName')->nullable();
            $table->string('spouseName')->nullable();
            $table->string('fatherName')->nullable();
            $table->string('motherName')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('linNo')->nullable();
            $table->string('picture')->nullable();
            $table->string('dateOfBirth')->nullable();
            $table->string('nid')->nullable();
            $table->string('bloodGroup')->nullable();
            $table->string('maritalStatus')->nullable();
            $table->string('religion')->nullable();
            $table->text('presentAddress')->nullable();
            $table->text('parmanentAddress')->nullable();
            $table->text('chamberAddress')->nullable();
            $table->string('status')->nullable();
            $table->string('barDateOfEnrollment')->nullable();
            $table->string('barCourtType')->nullable();
            $table->string('sanadNo')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
