<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'patients';

    protected $primaryKey = 'patient_id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'patient_code',
        'patient_first_name',
        'patient_last_name',
        'patient_email',
        'patient_phone',
        'patient_blood_group',
        'patient_gender',
        'patient_dob',
        'patient_address',
        'patient_status',
    ];

    protected $casts = [
        'patient_dob' => 'date',
        'patient_status' => 'integer',
    ];
}
