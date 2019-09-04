<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE VIEW v_act_user AS
                        (SELECT 
                            CONCAT(ids_user,'-',0) as id,
                            login,
                            email,
                            password,
                            CONCAT_WS(' ',firstname,secondname,firstlastname,secondlastname) as complete_name,
                            firstname,
                            secondname,
                            firstlastname,
                            secondlastname,
                            state,
                            create_time,
                            update_time,
                            0 as external
                        FROM s_user order by create_time asc) 
                        UNION 
                        (SELECT 
                            CONCAT(idact_external_user,'-',1) as id,
                            login,
                            email,
                            '' as password,
                            CONCAT_WS(' ',firstname,secondname,firstlastname,secondlastname) as complete_name,
                            firstname,
                            secondname,
                            firstlastname,
                            secondlastname,
                            state,
                            create_time,
                            update_time,
                            1 as external
                        FROM act_external_user order by create_time asc)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW if exists v_act_user");
    }
}
