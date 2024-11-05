<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(){
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->string('name', 20);
            $table->text('description');
            $table->unsignedTinyInteger('hp_per_level');
            $table->boolean('is_magic');
            $table->unsignedTinyInteger('available_proficiency')->nullable();
            $table->timestamps();
        });

        Schema::create('class_ability', function (Blueprint $table) {
            $table->foreignId('class_id')->constrained()->onDelete('cascade');
            $table->foreignId('ability_id')->constrained()->onDelete('cascade');
        });

        Schema::create('class_spell', function (Blueprint $table) {
            $table->foreignId('class_id')->constrained()->onDelete('cascade');
            $table->foreignId('spell_id')->constrained()->onDelete('cascade');
        });

        Schema::create('class_proficiency', function (Blueprint $table) {
            $table->foreignId('class_id')->constrained()->onDelete('cascade');
            $table->foreignId('proficiency_id')->constrained()->onDelete('cascade');
        });
    }

    public function down() {
        Schema::dropIfExists('class_proficiency');
        Schema::dropIfExists('class_ability');
        Schema::dropIfExists('class_spell');
        Schema::dropIfExists('classes');
    }
};
