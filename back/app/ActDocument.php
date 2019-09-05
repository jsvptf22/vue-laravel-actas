<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActDocument extends Model
{
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'act_document';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'idact_document';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'identificator',
        'subject'
    ];
}
