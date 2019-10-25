<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    protected $table = 'app';
    protected $guarded = [];
    public $timestamps = false;
}
