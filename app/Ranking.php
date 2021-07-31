<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ranking extends Model
{
    const UPDATED_AT = null;
    protected $fillable = ['user_id', 'ranking'];
}
