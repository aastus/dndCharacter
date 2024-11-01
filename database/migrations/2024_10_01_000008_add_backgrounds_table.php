<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(){
        Schema::create('backgrounds', function (Blueprint $table) {
            $table->id();
            $table->string('name', 30);
            $table->text('description');
            $table->timestamps();
        });

        Schema::create('background_proficiency', function (Blueprint $table) {
            $table->foreignId('background_id')->constrained()->onDelete('cascade');
            $table->foreignId('proficiency_id')->constrained()->onDelete('cascade');
        });
    }

    public function down() {
        Schema::dropIfExists('background_proficiency');
        Schema::dropIfExists('backgrounds');
    }
};