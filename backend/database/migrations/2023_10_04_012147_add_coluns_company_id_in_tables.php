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
        Schema::table('users', function (Blueprint $table) {
            $table->string('company_id')->end();
        });

        Schema::table('employees', function (Blueprint $table) {
            $table->string('company_id')->end();
        });
        
        Schema::table('itens', function (Blueprint $table) {
            $table->string('company_id')->end();
        });
        
        Schema::table('withdraw_epi', function (Blueprint $table) {
            $table->string('company_id')->end();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('company_id');
        });
        
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn('company_id');
        });

        Schema::table('itens', function (Blueprint $table) {
            $table->dropColumn('company_id');
        });

        Schema::table('withdraw_epi', function (Blueprint $table) {
            $table->dropColumn('company_id');
        });
    }
};
