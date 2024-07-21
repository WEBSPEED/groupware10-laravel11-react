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
        Schema::create('site_menus', function (Blueprint $table) {
            $table->id();

            $table->string('code')->unique();
            $table->string('title');
            $table->string('stitle')->nullable();
            $table->string('url');
            $table->boolean('used')->default(true);
            $table->boolean('show_used')->default(true);
            $table->boolean('left_title')->default(true);
            $table->boolean('global_bar')->default(true);
            $table->boolean('content_div')->default(false);
            $table->boolean('content_title')->default(false);
            $table->boolean('menu_toggle')->default(false);
            $table->boolean('show_toggle')->default(false);
            $table->tinyInteger('level_check')->default('1');
            $table->tinyInteger('local_level')->default('0');
            $table->tinyInteger('user_level')->default('0');
            $table->string('icon')->nullable();
            $table->json('left_menus')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_menus');
    }
};
