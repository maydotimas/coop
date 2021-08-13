<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application', function (Blueprint $table) {
            $table->id();
            $table->string('status')->default('PENDING');
            $table->string('approval_date')->nullable();
            $table->integer('view')->default(0);
            $table->foreignId('approver')
                ->nullable()
                ->constrained('users','id')
                ->onDelete('cascade');
            $table->foreignId('user_id')
                ->constrained('users','id')
                ->onDelete('cascade');
            $table->foreignId('profile_id')
                ->constrained('profile','id')
                ->onDelete('cascade');
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
        Schema::dropIfExists('application');
    }
}
