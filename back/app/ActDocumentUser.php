<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActDocumentUser extends Model
{
    /**
     * creador
     */
    const MANAGER = 1;

    /**
     * asistente
     */
    const ASISTANTS = 2;

    /**
     * presidente
     */
    const PRESIDENT = 3;

    /**
     * secretario
     */
    const SECRETARY = 4;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'act_document_user';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'idact_document_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'relation_type',
        'state',
        'user_identification',
        'fk_act_document',
        'external',
    ];
}
