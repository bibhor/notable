<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function initialize()
    {
        $doctor1 = new Doctor();
        $doctor1->first_name = "duke";
        $doctor1->last_name = "johnson";
        $doctor1->save();

        $doctor2 = new Doctor();
        $doctor2->first_name = "nate";
        $doctor2->last_name = "rasco";
        $doctor2->save();

        $doctor3 = new Doctor();
        $doctor3->first_name = "Jay";
        $doctor3->last_name = "mur"; 
        $doctor3->save();
    }
}
