<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('profile');
        Schema::create('profile', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('email_address');
            $table->string('contact_number');
            $table->string('civil_status');
            $table->string('birth_date');
            $table->string('birth_place')->nullable();
            $table->string('house_number');
            $table->string('street')->nullable();
            $table->string('barangay');
            $table->string('city');
            $table->string('province');
            $table->string('region');
            $table->string('department');
            $table->string('department_others')->nullable();
            $table->string('service_years');
            $table->string('service_status');
            $table->string('rank_unit');
            $table->string('gross_income');
            $table->string('pay_jurisdiction');
            $table->string('pay_slip_account_no');
            $table->string('membership_fee')->nullable();
            $table->string('pledge_subscription');
            $table->string('initial_capital_payment');
            $table->timestamps();

            $table->foreignId('user_id')
                ->constrained('users','id')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profile');
    }
}
