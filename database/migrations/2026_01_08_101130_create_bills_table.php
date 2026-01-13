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
        Schema::create('bills', function (Blueprint $table) {
            $table->id('bill_id');

            $table->string('bill_no', 20)->unique();

            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('visit_id');

            $table->decimal('total_amount', 10, 2);
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('tax', 10, 2)->default(0);
            $table->decimal('net_amount', 10, 2);

            $table->string('bill_status', 20)
                  ->comment('unpaid, paid, partial')->default('unpaid');

            $table->timestamps();

            $table->foreign('visit_id')
                  ->references('visit_id')
                  ->on('visits')
                  ->onDelete('cascade');

            $table->foreign('patient_id')
                  ->references('patient_id')
                  ->on('patients')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
