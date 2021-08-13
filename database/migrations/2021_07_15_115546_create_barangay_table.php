<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangay', function (Blueprint $table) {
            $table->id();
            $table->string('brgyCode')->nullable();
            $table->string('brgyDesc')->nullable();
            $table->string('regCode')->nullable();
            $table->integer('provCode')->nullable();
            $table->integer('citymunCode')->nullable();
            $table->index(['citymunCode']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barangay');
    }
}
