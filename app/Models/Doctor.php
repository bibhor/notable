<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Appointment;

class Doctor extends Model
{
    public const MAX_NUM_APPOINTMENTS = 3;

    use HasFactory;
    protected $fillable = [
        'id',
        'first_name',
        'last_name',
    ];


    public function isAvailable($requested_date)
    {
        return $this->appointments()->whereDate('appointment_date', '=', $requested_date)->get()->count() < self::MAX_NUM_APPOINTMENTS;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    /**
     * Get the subject type
     */
    public function calendar()
    {
        return $this->hasOne(Calendar::class);
    }
}
