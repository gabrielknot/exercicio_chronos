<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateHobbiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hobbies', function (Blueprint $table) {
            $table->id();
            $table->string("nome");
            $table->timestamps();
        });
        
        DB::table("hobbies")->insert([
            ["nome" => "Futebol"],
            ["nome" => "Caminhada"],
            ["nome" => "Pescar"],
            ["nome" => "Ler livro"],
            ["nome" => "Cozinhar"]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hobbies');
    }
}
