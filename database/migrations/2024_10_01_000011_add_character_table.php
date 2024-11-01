<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(){
        Schema::create('characters', function (Blueprint $table) {
            $table->id();
            $table->string('character_name', 40);
            $table->string('name', 40);
            $table->foreignId('class_id')->constrained()->onDelete('cascade');
            $table->foreignId('race_id')->constrained()->onDelete('cascade');
            $table->foreignId('background_id')->constrained()->onDelete('cascade');
            $table->foreignId('alignment_id')->constrained()->onDelete('cascade');
            $table->unsignedTinyInteger('level');
            $table->unsignedTinyInteger('armor_type');
            $table->unsignedTinyInteger('hit_points');
            $table->unsignedTinyInteger('plus_speed')->nullable();
            $table->string('traits', 300);
            $table->string('ideals', 300);
            $table->string('bonds', 300);
            $table->string('flaws', 300);
            $table->string('prehistory', 300);
            $table->string('inventory', 300);
            $table->string('goals', 300);
            $table->unsignedSmallInteger('age');
            $table->unsignedTinyInteger('height');
            $table->unsignedTinyInteger('weight');
            $table->string('eye_color', 30);
            $table->string('skin_color', 30);
            $table->string('hair_color', 30)->nullable();
            $table->string('notes', 500)->nullable();
            $table->timestamps();
        });

        Schema::create('character_characteristic', function (Blueprint $table) {
            $table->id();
            $table->foreignId('character_id')->constrained()->onDelete('cascade');
            $table->foreignId('characteristic_id')->constrained()->onDelete('cascade');
            $table->unsignedSmallInteger('value');
            $table->boolean('savingthrow');
        });

        Schema::create('character_language', function (Blueprint $table) {
            $table->foreignId('character_id')->constrained()->onDelete('cascade');
            $table->foreignId('language_id')->constrained()->onDelete('cascade');
        });

        Schema::create('character_proficiency', function (Blueprint $table) {
            $table->foreignId('character_id')->constrained()->onDelete('cascade');
            $table->foreignId('proficiency_id')->constrained()->onDelete('cascade');
        });

        Schema::create('character_ability', function (Blueprint $table) {
            $table->foreignId('character_id')->constrained()->onDelete('cascade');
            $table->foreignId('ability_id')->constrained()->onDelete('cascade');
        });

        Schema::create('character_spell', function (Blueprint $table) {
            $table->foreignId('character_id')->constrained()->onDelete('cascade');
            $table->foreignId('spell_id')->constrained()->onDelete('cascade');
        });

        Schema::create('character_weapon', function (Blueprint $table) {
            $table->foreignId('character_id')->constrained()->onDelete('cascade');
            $table->foreignId('weapon_id')->constrained()->onDelete('cascade');
        });
    }

    public function down() {
        Schema::dropIfExists('character_weapon');
        Schema::dropIfExists('character_characteristic');
        Schema::dropIfExists('character_language');
        Schema::dropIfExists('character_proficiency');
        Schema::dropIfExists('character_ability');
        Schema::dropIfExists('character_spell');
        Schema::dropIfExists('characters');
    }
};
