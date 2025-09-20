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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->date('due_date');
            $table->integer('status')->default(0);
            $table->string('attachment')->nullable();
            $table->integer('payment_status')->default(0)->comment('0: Unpaid, 1: Partially Paid, 2: Fully Paid');
            $table->decimal('total', 15, 2);
            $table->decimal('total_paid', 15, 2)->default(0);
            $table->foreignId('customer_id')->constrained('customers', 'id');
            $table->foreignId('created_by')->constrained('users', 'id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
