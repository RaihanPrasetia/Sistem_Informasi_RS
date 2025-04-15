<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'service_id',
        'registration_date',
        'notes',
        'created_by',
    ];

    protected $casts = [
        'registration_date' => 'datetime', // Cast kolom registration_date sebagai datetime
    ];

    /**
     * Relasi ke model Patient.
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Relasi ke model Service.
     */
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }
    /**
     * Relasi ke model User (staf yang membuat pendaftaran).
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Relasi ke model RegistrationDrug.
     */
    public function registrationDrugs()
    {
        return $this->hasMany(RegistrationDrug::class);
    }
}
