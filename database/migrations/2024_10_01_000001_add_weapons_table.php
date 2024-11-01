<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('weapons', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->text('description');
            $table->unsignedSmallInteger('cost');
            $table->unsignedTinyInteger('damage');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('weapons');
    }
};