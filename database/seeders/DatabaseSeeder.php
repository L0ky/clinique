<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->doctorFactory();
        $this->patientFactory();
    }

    public function doctorFactory(): void
    {
        Doctor::factory(2)->cardiologists()->create();
        Doctor::factory(2)->dermatologists()->create();
    }

    public function patientFactory(): void
    {
        Patient::factory(10)->create();
    }
}
