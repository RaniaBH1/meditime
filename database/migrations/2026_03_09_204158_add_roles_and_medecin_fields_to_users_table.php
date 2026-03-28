<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('patient')->after('password');
            $table->boolean('is_approved')->default(true)->after('role');

            $table->string('phone')->nullable()->after('is_approved');
            $table->string('speciality')->nullable()->after('phone');
            $table->string('address')->nullable()->after('speciality');
            $table->string('license_number')->nullable()->after('address');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'role',
                'is_approved',
                'phone',
                'speciality',
                'address',
                'license_number',
            ]);
        });
    }
};