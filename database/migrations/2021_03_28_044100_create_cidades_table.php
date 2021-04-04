<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateCidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cidades', function (Blueprint $table) {
            $table->id();
            $table->string("nome");
            $table->unsignedBigInteger("estado_id");
            $table->timestamps();

            $table->foreign("estado_id")->references("id")->on("estados")->onUpdate("CASCADE")->onDelete("CASCADE");
        });

        DB::table("cidades")->insert([
            ["nome" => "Campina Grande", "estado_id" => 1],
            ["nome" => "Esperança", "estado_id" => 1],
            ["nome" => "João Pessoa", "estado_id" => 1],
            ["nome" => "Cajazeiras", "estado_id" => 1],
            ["nome" => "Recife", "estado_id" => 2],
            ["nome" => "Olinda", "estado_id" => 2],
            ["nome" => "Arcoverde", "estado_id" => 2],
            ["nome" => "Rio de Janeiro", "estado_id" => 3],
            ["nome" => "Niterói", "estado_id" => 3],
            ["nome" => "Petrópolis", "estado_id" => 3],
            ["nome" => "Florianópolis", "estado_id" => 3],
            ["nome" => "Rio Branco", "estado_id" => 4],
            ["nome" => "Porto Walter", "estado_id" => 4],
            ["nome" => "Porto Acre", "estado_id" => 4],
            ["nome" => "Cruzeiro do Sul", "estado_id" => 4],
            ["nome" => "Florianópolis", "estado_id" => 5],
            ["nome" => "Blumenau", "estado_id" => 5],
            ["nome" => "Joinville", "estado_id" => 5],
            ["nome" => "Chapecó", "estado_id" => 5],
           
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cidades');
    }
}
