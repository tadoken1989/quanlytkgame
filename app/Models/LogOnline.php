<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogOnline extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'log_user_online';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    protected $fillable = ['time', 'day','count'];

}
