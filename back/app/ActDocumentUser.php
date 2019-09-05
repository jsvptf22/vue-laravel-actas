<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActDocumentUser extends Model
{
    const MANAGER = 1;
    const ASISTANTS = 2;

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
    ];
}
