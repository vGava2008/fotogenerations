<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Langs extends Model
{
    protected $table = 'languages';
    protected $fillable = [
        'name','locale',
    ];
}