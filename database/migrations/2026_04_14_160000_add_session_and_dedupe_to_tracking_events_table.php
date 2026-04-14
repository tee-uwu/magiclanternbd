<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tracking_events', function (Blueprint $table) {
            $table->uuid('event_uuid')->nullable()->after('id');
            $table->string('session_id', 64)->nullable()->after('event_uuid');
            $table->string('page_url', 2048)->nullable()->after('session_id');
            $table->string('referrer', 2048)->nullable()->after('page_url');
            $table->timestamp('occurred_at')->nullable()->after('referrer');

            $table->index(['session_id', 'occurred_at']);
            $table->index(['event_name', 'occurred_at']);
            $table->unique('event_uuid');
        });
    }

    public function down(): void
    {
        Schema::table('tracking_events', function (Blueprint $table) {
            $table->dropUnique(['event_uuid']);
            $table->dropIndex(['session_id', 'occurred_at']);
            $table->dropIndex(['event_name', 'occurred_at']);

            $table->dropColumn(['event_uuid', 'session_id', 'page_url', 'referrer', 'occurred_at']);
        });
    }
};

