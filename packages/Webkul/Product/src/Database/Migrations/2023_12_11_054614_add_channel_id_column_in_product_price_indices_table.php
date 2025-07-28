<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $table = 'product_price_indices';
        $prefix = DB::getTablePrefix();

        // Manually drop foreign keys using SQL wrapped in try-catch
        try {
            DB::statement("ALTER TABLE `{$table}` DROP FOREIGN KEY `{$prefix}product_price_indices_product_id_foreign`");
        } catch (\Throwable $e) {}

        try {
            DB::statement("ALTER TABLE `{$table}` DROP FOREIGN KEY `{$prefix}product_price_indices_customer_group_id_foreign`");
        } catch (\Throwable $e) {}

        try {
            DB::statement("ALTER TABLE `{$table}` DROP INDEX `{$prefix}product_price_indices_product_id_customer_group_id_unique`");
        } catch (\Throwable $e) {}

        // Add channel_id column if it doesn't exist
        if (!Schema::hasColumn($table, 'channel_id')) {
            Schema::table($table, function (Blueprint $table) {
                $table->integer('channel_id')->unsigned()->default(1)->after('customer_group_id');
            });
        }

        // Recreate foreign keys and unique index
        Schema::table($table, function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('customer_group_id')->references('id')->on('customer_groups')->onDelete('cascade');
            $table->foreign('channel_id')->references('id')->on('channels')->onDelete('cascade');
            $table->unique(['product_id', 'customer_group_id', 'channel_id'], 'price_indices_product_id_customer_group_id_channel_id_unique');
        });
    }

    public function down(): void
    {
        $table = 'product_price_indices';
        $prefix = DB::getTablePrefix();

        Schema::table($table, function (Blueprint $table) {
            try {
                $table->dropForeign(['product_id']);
            } catch (\Throwable $e) {}

            try {
                $table->dropForeign(['customer_group_id']);
            } catch (\Throwable $e) {}

            try {
                $table->dropForeign(['channel_id']);
            } catch (\Throwable $e) {}

            try {
                $table->dropUnique('price_indices_product_id_customer_group_id_channel_id_unique');
            } catch (\Throwable $e) {}

            try {
                $table->dropColumn('channel_id');
            } catch (\Throwable $e) {}
        });

        // Restore old foreign keys and unique index
        Schema::table($table, function (Blueprint $table) use ($prefix) {
            $table->foreign(
                'product_id',
                $prefix . 'product_price_indices_product_id_foreign'
            )->references('id')->on('products');

            $table->foreign(
                'customer_group_id',
                $prefix . 'product_price_indices_customer_group_id_foreign'
            )->references('id')->on('customer_groups');

            $table->unique(
                ['product_id', 'customer_group_id'],
                $prefix . 'product_price_indices_product_id_customer_group_id_unique'
            );
        });
    }
};
