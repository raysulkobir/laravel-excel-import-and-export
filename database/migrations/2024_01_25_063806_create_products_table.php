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
            // $table->string('memberId')->nullable();
            // $table->string('memberName')->nullable();
            // $table->string('spouseName')->nullable();
            // $table->string('fatherName')->nullable();
            // $table->string('motherName')->nullable();
            // $table->string('mobile')->nullable();
            // $table->string('email')->nullable();
            // $table->string('linNo')->nullable();
            // $table->string('picture')->nullable();
            // $table->string('dateOfBirth')->nullable();
            // $table->string('nid')->nullable();
            // $table->string('bloodGroup')->nullable();
            // $table->string('maritalStatus')->nullable();
            // $table->string('religion')->nullable();
            // $table->text('presentAddress')->nullable();
            // $table->text('parmanentAddress')->nullable();
            // $table->text('chamberAddress')->nullable();
            // $table->string('status')->nullable();
            // $table->string('barDateOfEnrollment')->nullable();
            // $table->string('barCourtType')->nullable();
            // $table->string('sanadNo')->nullable();

            //TODO bangladesh_Association_of_Publicly_Listed_Companies
            // $table->string('web-scraper-order')->nullable();
            // $table->string('web-scraper-start-url')->nullable();
            // $table->string('cid')->nullable();
            // $table->string('company_name')->nullable();
            // $table->string('address')->nullable();
            // $table->string('phone')->nullable();
            // $table->string('link')->nullable();
            // $table->string('link-href')->nullable();
            // $table->string('contact_person')->nullable();
            // $table->string('designation')->nullable();
            // $table->string('phone1')->nullable();
            // $table->string('mobile')->nullable();
            // $table->string('fax')->nullable();
            // $table->string('emails')->nullable();
            // $table->string('website')->nullable();

            //TODO Bangladesh_college_of_physician_and_surgeons

            // $table->string('subject')->nullable();
            // $table->string('fellow_id')->nullable();
            // $table->string('year_of_fellowship')->nullable();
            // $table->string('name')->nullable();
            // $table->string('institute')->nullable();

            //TODO dhaka_university_accounting_alumni
            // $table->string('web-scraper-orde')->nullable();
            // $table->string('web-scraper-start-url')->nullable();
            // $table->string('image-src')->nullable();
            // $table->string('name')->nullable();
            // $table->string('id_no')->nullable();
            // $table->string('batch')->nullable();
            // $table->string('designation')->nullable();
            // $table->string('orgnization')->nullable();
            // $table->string('link')->nullable();
            // $table->string('link-href')->nullable();
            // $table->string('name1')->nullable();
            // $table->string('designation1')->nullable();
            // $table->string('organization1')->nullable();
            // $table->string('address')->nullable();
            // $table->string('telephone_office')->nullable();
            // $table->string('telephone_res')->nullable();
            // $table->string('mobile')->nullable();
            // $table->string('email')->nullable();
            // $table->string('date_of_birth')->nullable();
            // $table->string('no_of_children')->nullable();
            // $table->string('spouse_name')->nullable();
            // $table->string('blood_group')->nullable();


            //TODO economist_association
            // $table->string('web-scraper-order')->nullable();
            // $table->string('web-scraper-start-url')->nullable();
            // $table->string('photo-src')->nullable();
            // $table->string('name')->nullable();
            // $table->string('occupation')->nullable();
            // $table->string('contact')->nullable();
            // $table->string('link')->nullable();
            // $table->string('link-href')->nullable();
            // $table->string('Membership Number')->nullable();
            // $table->string('Name1')->nullable();
            // $table->string('Blood Group')->nullable();
            // $table->text('Mailing Address')->nullable();
            // $table->string('Mobile Number')->nullable();
            // $table->string('E-mail ID')->nullable();
            // $table->string('Education')->nullable();

            // bma_members


            // $table->string('member_id')->nullable();
            // $table->string('division_name')->nullable();
            // $table->string('branch_name')->nullable();
            // $table->string('member_name')->nullable();
            // $table->string('membership_number')->nullable();
            // $table->string('mobile')->nullable();
            // $table->string('member_status')->nullable();
            // $table->string('member_photo')->nullable();


            //TODO Amena_Nurse_Leads
            $table->string('created_time')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('full_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('gender')->nullable();

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
