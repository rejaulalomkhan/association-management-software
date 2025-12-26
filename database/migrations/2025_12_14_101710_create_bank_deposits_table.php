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
        Schema::create('bank_deposits', function (Blueprint $table) {
            $table->id();
            $table->enum('transaction_type', ['deposit', 'withdrawal', 'deduction', 'profit'])->default('deposit');
            $table->decimal('amount', 15, 2); // Transaction amount (always positive)
            $table->decimal('balance_after', 15, 2); // Running balance after this transaction
            $table->integer('month'); // 1-12
            $table->integer('year');
            $table->string('bank_message_screenshot'); // Required image path
            $table->string('bank_receipt')->nullable(); // Optional receipt image path
            $table->foreignId('deposited_by')->constrained('users')->onDelete('cascade');
            $table->text('notes')->nullable();
            $table->timestamps();
            
            // Indexes for better query performance
            $table->index(['year', 'month']);
            $table->index('transaction_type');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_deposits');
    }
};
