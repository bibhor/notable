<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\Validator;

use App\Models\Appointment;
use App\Models\Doctor;
use Carbon\Carbon;

class AppointmentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($doctor_id, $date)
    {
        $doctor = Doctor::find($doctor_id);
        if($doctor)
        {
            return $doctor->appointments()->whereDate('appointment_date', '=', $date)->get()->toJson();
        } else {
            return response()->json(Appointment::COULD_NOT_FIND_DOCTOR);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
                    'doctor_id' => 'required|exists:doctors,id',
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'appointment_date' => 'required',
                    'kind' => 'in:new_patient,follow_up',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $validated = $validator->validated();

        $appointment_date =  Carbon::parse($validated['appointment_date']);
        $appointment_min = $appointment_date->format("i");

        if($appointment_min % 15 > 0) {
            return response()->json(Appointment::INCORRECT_APPOINTMENT_INTERVAL);
        }

        if(Appointment::isValidRequest($validated['doctor_id'], $appointment_date)){
            $appointment = new Appointment($validated);
            $appointment->save();
        } else {
            return response()->json(Appointment::DOCTOR_IS_BOOKED);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $validator = Validator::make($request->all(), [
                    'appointment_id' => 'required|exists:appointments,id',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $validated = $validator->validated();
        
        if(Appointment::find($validated['appointment_id'])->delete()) {
            return response()->json(Appointment::APPOINTMENT_DELETED);
        } else {
            return response()->json(Appointment::COULD_NOT_DELETE_APPOINTMENT);
        }
        
    }
}
