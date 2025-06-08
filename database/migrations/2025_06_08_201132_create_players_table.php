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
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('middle_names')->nullable();
            $table->string('sur_name');
            $table->string('position');
            $table->string('footed');
            $table->boolean('injured')->default(false);
            $table->foreignId('team_id')->nullable()->constrained()->onDelete('set null'); // Player might be free agent
            $table->foreignId('country_id')->constrained()->onDelete('cascade');
            $table->unsignedInteger('overall_rating');
            $table->unsignedInteger('height');
            $table->unsignedInteger('weight');
            $table->unsignedBigInteger('value')->default(0)->nullable();
            $table->unsignedInteger('weekly_wage')->default(0);
            $table->date('date_of_birth');
            $table->date('contract_end_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
