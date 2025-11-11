<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProductImage extends Model
{
    protected $fillable = ['product_id', 'path'];

    protected $appends = ['url'];

    public function getUrlAttribute()
    {
        return Storage::url($this->path);
    }
}