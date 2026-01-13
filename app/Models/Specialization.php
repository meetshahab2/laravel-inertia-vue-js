<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{
    protected $table = 'specializations';

    protected $primaryKey = 'specialization_id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'specialization_name',
        'specialization_description',
        'specialization_status',
    ];

    protected $casts = [
        'specialization_status' => 'boolean',
    ];

    /**
     * 🔍 Active specializations (status = 1)
     */
    public function scopeActive($query)
    {
        return $query->where('specialization_status', 1);
    }

    /**
     * 🔍 Inactive specializations (status = 0)
     */
    public function scopeInactive($query)
    {
        return $query->where('specialization_status', 0);
    }
}
