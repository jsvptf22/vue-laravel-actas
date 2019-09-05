<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VActUser extends Model
{
    public $incrementing = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'v_act_user';
}
