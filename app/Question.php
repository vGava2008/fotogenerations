<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    // Mass assigned
    protected $fillable = ['id', 'title', 'text_info', 'language_id', 'published', 'created_by', 'modified_by', 'updated_at', 'created_at',];
}
