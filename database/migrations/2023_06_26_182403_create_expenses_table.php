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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();

            $table->string('title')->nullable();

            $table->unsignedBigInteger('liability_id')->nullable();
            $table->foreign('liability_id')->references('id')->on('liabilities');

            $table->date('date');
            $table->double('amount',15,2);

            $table->boolean('status')->default(0)->comment('1:Paid,0:Unpaid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
