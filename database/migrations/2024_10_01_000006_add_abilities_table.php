<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(){
        Schema::create('abilities', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->text('description');
            $table->unsignedTinyInteger('level');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('abilities');
    }
};