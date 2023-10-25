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
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->string('name');
            $table->string('address');
            $table->string('website');
            $table->string('bank_reference');
            $table->string('company_email');
            $table->string('incorporation_deed')->nullable();
            $table->string('approval_deed')->nullable();
            $table->string('siup')->nullable();
            $table->string('registration_cert')->nullable();
            $table->string('annual_spt_proof')->nullable();
            $table->string('submission_pph_ssp_proof')->nullable();
            $table->string('pkp_npwp')->nullable();
            $table->string('domicile_letter')->nullable();
            $table->string('company_profile')->nullable();
            $table->text('rejection_reason')->nullable();
            $table->enum('status', ['New', 'Verified', 'Not Verified'])
                ->default('New');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
