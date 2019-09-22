<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class activity extends Model
{
    public const TYPE = ['checkbox', 'number'];

    protected $fillable = [
        'name', 'type', 'value',
    ];
}
