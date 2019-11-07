<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActDocumentApprobation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('act_document_approbation', function (Blueprint $table) {
            $table->integer('idact_document_approbation', true);
            $table->integer('fk_funcionario');
            $table->integer('fk_act_document');
            $table->integer('action')->nullable();
            $table->integer('state');
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
        Schema::dropIfExists('act_document_approbation');
    }
}
