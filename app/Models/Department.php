<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes;

    protected $table = 'departments';

    protected $primaryKey = 'department_id';

    protected $fillable = [
        'department_name',
        'department_description',
        'department_status',
    ];

    protected $casts = [
        'department_status' => 'integer',
    ];
}
