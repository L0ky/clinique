<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Disease;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Room;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->doctorFactory();
        $this->diseaseFactory();
        $this->roomFactory();
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

    public function diseaseFactory(): void
    {
        Disease::factory(10)->create();
    }

    public function roomFactory(): void
    {
        Room::factory(10)->create();
    }
}
