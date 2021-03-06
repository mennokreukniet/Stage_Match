<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public function imageable() {
        $this->morphTo();
    }

    public $timestamps = false;
    public $fillable = ['name', 'file', 'url'];
    public $visible = ['name', 'url'];
}
