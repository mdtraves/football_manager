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
        Schema::create('managers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('middle_names')->nullable();
            $table->string('sur_name');
            $table->date('date_of_birth');

            $table->foreignId('team_id')->nullable()->uniqueconstrained()->onDelete('set null'); // Player might be free agent
            $table->foreignId('country_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->unique()->constrained()->onDelete('cascade');
            $table->unsignedInteger('height');
            $table->unsignedInteger('weight');
            $table->unsignedInteger('weekly_wage')->default(0);
            $table->date('contract_end_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('managers');
    }
};
