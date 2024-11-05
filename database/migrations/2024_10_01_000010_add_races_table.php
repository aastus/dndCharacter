<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(){
        Schema::create('races', function (Blueprint $table) {
            $table->id();
            $table->string('name', 30);
            $table->text('description');
            $table->string('suggested_names', 200)->nullable();
            $table->unsignedTinyInteger('move_speed');
            $table->unsignedTinyInteger('available_proficiency')->nullable();
            $table->timestamps();
        });


        Schema::create('race_ability', function (Blueprint $table) {
            $table->foreignId('race_id')->constrained()->onDelete('cascade');
            $table->foreignId('ability_id')->constrained()->onDelete('cascade');
        });

        Schema::create('race_language', function (Blueprint $table) {
            $table->foreignId('race_id')->constrained()->onDelete('cascade');
            $table->foreignId('language_id')->constrained()->onDelete('cascade');
        });

        Schema::create('race_characteristic', function (Blueprint $table) {
            $table->foreignId('race_id')->constrained()->onDelete('cascade');
            $table->foreignId('characteristic_id')->constrained()->onDelete('cascade');
            $table->unsignedTinyInteger('value');
        });

        Schema::create('race_proficiency', function (Blueprint $table) {
            $table->foreignId('race_id')->constrained()->onDelete('cascade');
            $table->foreignId('proficiency_id')->constrained()->onDelete('cascade');
        });
    }

    public function down() {
        Schema::dropIfExists('race_proficiency');
        Schema::dropIfExists('race_ability');
        Schema::dropIfExists('race_language');
        Schema::dropIfExists('race_characteristic');
        Schema::dropIfExists('races');
    }
};
