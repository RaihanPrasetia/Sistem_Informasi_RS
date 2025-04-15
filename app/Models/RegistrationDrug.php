<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrationDrug extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_id',
        'drug_id',
        'quantity',
        'dosage',
    ];

    /**
     * Relasi ke model Registration.
     */
    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }

    /**
     * Relasi ke model Drug.
     */
    public function drug()
    {
        return $this->belongsTo(Drug::class);
    }
}
