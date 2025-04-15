<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name',
        'price',
        'description',
        'doctor_id',
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

    /**
     * Relasi belongsTo ke model User (dokter)
     */
    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
    /**
     * Relasi hasMany ke model RegistrationService
     */
    public function registrationServices()
    {
        return $this->hasMany(Registration::class);
    }
}
