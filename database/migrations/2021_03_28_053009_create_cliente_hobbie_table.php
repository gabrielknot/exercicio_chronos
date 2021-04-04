<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClienteHobbieTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente_hobbie', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("cliente_id");
            $table->unsignedBigInteger("hobbie_id");
            $table->timestamps();

            $table->foreign("cliente_id")->references("id")->on("clientes")->onUpdate("CASCADE")->onDelete("CASCADE");
            $table->foreign("hobbie_id")->references("id")->on("hobbies")->onUpdate("CASCADE")->onDelete("CASCADE");
        });
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes_hobbies');
    }
}
