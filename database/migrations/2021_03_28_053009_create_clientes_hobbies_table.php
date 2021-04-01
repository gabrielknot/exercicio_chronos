<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesHobbiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes_hobbies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("cliente");
            $table->unsignedBigInteger("hobbie");
            $table->timestamps();

            $table->foreign("cliente")->references("id")->on("clientes")->onUpdate("CASCADE")->onDelete("CASCADE");
            $table->foreign("hobbie")->references("id")->on("hobbies")->onUpdate("CASCADE")->onDelete("CASCADE");
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
