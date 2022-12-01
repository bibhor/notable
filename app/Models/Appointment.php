<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Doctor;
use Carbon\Carbon;

class Appointment extends Model
{
    use HasFactory;
    public $timestamps = false;

    public const INCORRECT_APPOINTMENT_INTERVAL = "Appointment interval must be of 15 min";
    public const DOCTOR_IS_BOOKED = "Doctor is booked";
    public const APPOINTMENT_DELETED = "Appointment deleted successfully";
    public const COULD_NOT_DELETE_APPOINTMENT = "Could not delete appointment";
    public const COULD_NOT_FIND_DOCTOR = "Could not find doctor";


    protected $fillable = [
        'id',
        'doctor_id',
        'first_name',
        'last_name',
        'appointment_date',
        'kind'
    ];

    public static function isValidRequest($doctor_id, $appointment_date){
        $doctor = Doctor::find($doctor_id);
        if ($doctor->isAvailable($appointment_date)) {
            //Store the new appointment
            return true;
        } else {
            return false;
        }
    }

    public static function create($appointment){

    }
}
