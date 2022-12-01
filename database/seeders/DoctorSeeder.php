<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Doctor;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        array_map(
            function ($doctor) {
                Doctor::factory()->create($doctor);
            },
            json_decode(file_get_contents(__DIR__ . "/doctor.json"), true)
        );
        //print_r(json_decode(file_get_contents(__DIR__ . "/doctor.json"), true));
        //exit;

    }
}
