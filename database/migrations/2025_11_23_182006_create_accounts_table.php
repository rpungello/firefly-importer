<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();

            $table->string('name')->unique();
            $table->unsignedInteger('firefly_id')->unique();
            $table->string('account_number')->nullable();
            $table->boolean('credit_card')->default(false);
            $table->string('filetype');
            $table->boolean('headers')->default(true);

            $table->timestamps();
            $table->softDeletes();

            $table->index('created_at');
            $table->index('updated_at');
            $table->index('deleted_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
