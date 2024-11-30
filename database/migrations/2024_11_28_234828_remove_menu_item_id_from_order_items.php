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
        // Drop foreign key constraint first
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropForeign(['menu_item_id']); // Drop the foreign key constraint
        });

        // Now, drop the column
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropColumn('menu_item_id'); // Drop the column from the table
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            //
        });
    }
};
