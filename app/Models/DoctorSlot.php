<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DoctorSlot extends Model
{
    use SoftDeletes;

    protected $table = 'doctor_slots';

    protected $primaryKey = 'slot_id';

    protected $fillable = [
        'doctor_id',
        'day_of_week',
        'start_time',
        'end_time',
        'slot_duration',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'day_of_week' => 'integer',
    ];

    /**
     * Relationship: DoctorSlot belongs to Doctor
     */
    public function doctor()
    {
        // $this->belongsTo(Doctor::class, 'doctor_id', 'doctor_id');
    }

    /**
     * Scope: Only active slots
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
