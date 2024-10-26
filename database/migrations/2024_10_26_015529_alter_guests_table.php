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
        Schema::table('guests', function (Blueprint $table) {
            $table-> foreignId('category_id')->after('id')->nullable()->constrained()->onDelete('set null');
            //jangan samoai datanya di hapus kalau misalnya dihapus diubah jadi null
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('guests', function (Blueprint $table) {
            $table->dropConstrainedForeignId('category_id');
            $table->dropColumn('category_id');
        });
    }
};
