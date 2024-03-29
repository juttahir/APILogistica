<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('integration_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('integration_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('type');
            $table->string('params');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('integration_items');
    }
};
