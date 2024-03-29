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
        Schema::create('papers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->string('title');
            $table->string('slug');
            $table->text('abstract');
            $table->text('content')->nullable();
            $table->timestamp('published_on');
            $table->foreignId('reviewer_id')
                ->nullable();
            $table->string('authors')->nullable();
            $table->text('reference')->nullable();
            $table->string('file_path')->nullable();
            $table->foreignId('paper_status_id')
                // ->references('id')
                // ->on('paper_status')
                ->nullable();

            $table->foreignId('transaction_id')
                // ->references('id')
                // ->on('transactions')
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('papers');
    }
};
