<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /**
     * List of fillable column
     */
    protected $fillable = ['value'];

    public $timestamps = false;
}
