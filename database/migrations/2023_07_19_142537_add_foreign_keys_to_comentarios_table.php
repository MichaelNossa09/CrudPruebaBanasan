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
        Schema::table('comentarios', function (Blueprint $table) {
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_publicacion');

            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_publicacion')->references('id')->on('publicaciones');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comentarios', function (Blueprint $table) {
            $table->dropForeign(['id_user']);
            $table->dropForeign(['id_publicacion']);

            $table->dropColumn('id_user');
            $table->dropColumn('id_publicacion');
        });
    }
};
