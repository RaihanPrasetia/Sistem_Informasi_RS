<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'country_id',
        'name',
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
     * Relasi belongsTo ke model Country
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Relasi hasMany ke model City
     */
    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
