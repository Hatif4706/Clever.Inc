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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assign_pic_am')->nullable();
            $table->string('name');
            $table->string('job');
            $table->string('user_company');
            $table->string('pic_company');
            $table->string('pic_company_phone_number');
            $table->string('contract_number');
            $table->date('contract_date');
            $table->bigInteger('contract_rate');
            $table->bigInteger('vendor_deal');
            $table->string('tor_vendor_doc')->nullable();
            $table->string('boq_final_vendor')->nullable();
            $table->string('evaluation_project_doc')->nullable();
            $table->string('ba_reconciliation_doc')->nullable();
            $table->string('bast_doc')->nullable();
            $table->enum('tor_doc_status', ['Available', 'Not Available'])->default('Not Available');
            $table->enum('po_doc_status', ['Available', 'Not Available'])->default('Not Available');
            $table->enum('payment_status', ['Done', 'Not Available'])->default('Not Available');
            $table->enum('status', [
                'New Project',
                'Tender on Process',
                'Need Evaluation',
                'Need PO & SPK',
                'Need Closing',
                'Payment Updated',
                'Completed',
            ])->default('New Project');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
