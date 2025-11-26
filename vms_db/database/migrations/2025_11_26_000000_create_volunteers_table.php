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
        Schema::create('volunteers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('mobile');
            $table->string('facebook_name')->nullable();
            $table->date('birthdate');
            $table->text('address');
            $table->string('education');
            $table->text('training')->nullable();
            $table->text('skills')->nullable();
            $table->text('classes')->nullable();
            $table->text('availability');
            $table->string('volunteer_area');
            $table->enum('lifegroup', ['yes', 'no']);
            $table->string('emergency_name');
            $table->string('emergency_relation');
            $table->string('emergency_phone');
            $table->string('emergency_email')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('volunteers');
    }
};
