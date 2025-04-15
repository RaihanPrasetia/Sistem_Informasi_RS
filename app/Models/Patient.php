<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'name',
        'nik',
        'address',
        'age',
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
            // Generate UUID untuk ID jika kosong
            if (empty($model->id)) {
                $model->id = (string) \Illuminate\Support\Str::uuid();
            }

            // Generate Patient Number jika kosong
            if (empty($model->patient_number)) {
                $lastPatient = self::orderBy('created_at', 'desc')->first();
                $lastNumber = $lastPatient ? intval(substr($lastPatient->patient_number, 1)) : 0;

                // Tambahkan 1 ke nomor terakhir dan format dengan leading zero
                $model->patient_number = 'P' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
            }
        });
    }

    public function patientRegistrations()
    {
        return $this->hasMany(Registration::class);
    }
}
