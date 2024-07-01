<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{    /**
    * @return void
    */
   public function up(): void
   {
       Schema::table('posts', function (Blueprint $table) {
           $table->longText('image')->nullable()->change(); // Change the column type to text
       });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down(): void
   {
       Schema::table('posts', function (Blueprint $table) {
           $table->text('image', 255)->nullable()->change(); // Reverse the column type to string
       });
   }

};
