<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActExternalUser extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'act_external_user';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'idact_external_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'login',
        'email',
        'password',
        'firstname',
        'secondname',
        'firstlastname',
        'secondlastname',
        'state'
    ];
}
