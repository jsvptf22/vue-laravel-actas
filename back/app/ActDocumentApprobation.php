<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActDocumentApprobation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'act_document_approbation';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'idact_document_approbation';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fk_funcionario',
        'fk_act_document',
        'action',
        'state',
    ];
}
