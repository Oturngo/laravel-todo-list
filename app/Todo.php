<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    // The attributes that mass assignable
    protected $fillable = ['title', 'description', 'status'];
}
