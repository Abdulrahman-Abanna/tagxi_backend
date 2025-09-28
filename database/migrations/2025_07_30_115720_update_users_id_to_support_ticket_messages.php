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
        Schema::table('support_ticket_messages', function (Blueprint $table) {
             $table->dropForeign(['user_id']);

            // Make the column nullable

            // Re-add the foreign key constraint
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('support_ticket_messages', function (Blueprint $table) {
             $table->dropForeign(['user_id']);

            // Make the column nullable
            $table->unsignedInteger('user_id')->nullable()->change();

            // Re-add the foreign key constraint
            $table->foreign('user_id')->references('users_id')->on('support_tickets');
        });
    }
};
