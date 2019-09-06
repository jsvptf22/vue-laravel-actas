<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActDocumentTopic extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'act_document_topic';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'idact_document_topic';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'fk_act_document',
        'state'
    ];
}
