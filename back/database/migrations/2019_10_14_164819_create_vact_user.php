<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVactUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("create or replace VIEW v_act_user AS 
            (select 
                concat(funcionario.idfuncionario,'-0') AS id,
                funcionario.login AS usuario,
                funcionario.email AS correo,
                concat(funcionario.nombres,' ',funcionario.apellidos) AS nombre_completo,
                funcionario.estado AS estado,
                0 AS externo 
            from funcionario)
            union 
            (select 
                concat(tercero.idtercero,'-1') AS id,
                '' AS usuario,
                tercero.correo AS correo,
                tercero.nombre as nombre_completo,
                tercero.estado AS estado,
                1 AS externo 
            from tercero)
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW v_act_user");
    }
}
