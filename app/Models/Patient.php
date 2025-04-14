<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'name',
        'nik',
        'address',
        'patient_number',
        'birth_date',
        'gender',
        'phone',
    ];

    protected $keyType = 'string'; // UUID adalah string
    public $incrementing = false; // Non-incremental ID

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) \Illuminate\Support\Str::uuid(); // Generate UUID
            }
        });
    }

    public function patientRegistrations()
    {
        return $this->hasMany(Registration::class);
    }
}
