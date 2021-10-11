<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_clients')->constrained('clients')->onDelete('cascade');;
            $table->string('reference');
            $table->string('destinateur');
            $table->integer('telephone');
            $table->string('ville');
            $table->double('prix', 8, 2);
            $table->string('etat');
            $table->string('produit');
            $table->string('status');
            $table->string('commentaire');
            $table->string('options');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('colis');
    }
}
