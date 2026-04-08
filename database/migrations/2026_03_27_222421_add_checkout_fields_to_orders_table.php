<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCheckoutFieldsToOrdersTable extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Only add missing columns (color is already added by previous migration)
            if (!Schema::hasColumn('orders', 'delivery_area')) {
                $table->string('delivery_area')->nullable()->after('quantity');
            }
            if (!Schema::hasColumn('orders', 'delivery_charge')) {
                $table->integer('delivery_charge')->default(0)->after('delivery_area');
            }
            if (!Schema::hasColumn('orders', 'total_price')) {
                $table->integer('total_price')->default(0)->after('delivery_charge');
            }
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'delivery_area',
                'delivery_charge',
                'total_price',
            ]);
        });
    }
}