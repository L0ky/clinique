<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use PhpParser\Comment\Doc;

class DoctorController extends Controller
{
    /**
     * Get all doctors or by filters
     *
     * @param Request $request
     * @return Collection
     */
    public function index(Request $request): Collection
    {
        $speciality = $request->input('speciality');
        $coordinates = $request->input('coordinates');

        $doctors = Doctor::query();

        if ($speciality) {
            $doctors->where('speciality', $speciality);
        }

        if ($coordinates) {
            $doctors->where('coordinates', $coordinates);
        }

        $doctors = $doctors->get();

        return $doctors;
    }

    /**
     * Get a doctor by id.
     *
     * @param $id
     * @return Doctor
     */
    public function show($id): Doctor
    {
        $doctor = Doctor::findOrFail($id);

        return $doctor;
    }

    /**
     * Store a new doctor.
     *
     * @param Request $request
     */
    public function store(Request $request): Response
    {
        $validated = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'speciality' => 'required',
            'coordinates' => 'required',
        ]);

        $doctorExist = Doctor::where('firstname', $validated['firstname'])
            ->where('lastname', $validated['lastname'])
            ->where('speciality', $validated['speciality'])
            ->where('coordinates', $validated['coordinates'])
            ->first();

        if ($doctorExist) {
            return response('Doctor already exists', 409);
        }
            
        $doctor = Doctor::create($validated);

        return response($doctor, 201);
    }

    /**
     * Update a doctor by id.
     *
     * @param Request $request
     * @param $id
     * @return Doctor
     */
    public function update(Request $request, int $id): Response
    {
        $doctor = Doctor::findOrFail($id);

        $validated = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'speciality' => 'required',
            'coordinates' => 'required',
        ]);

        $doctor->update([
            'firstname' => $validated['firstname'],
            'lastname' => $validated['lastname'],
            'speciality' => $validated['speciality'],
            'coordinates' => $validated['coordinates'],
        ]);

        return response($doctor, 201);
    }

    /**
     * Delete a doctor by id.
     *
     * @param $id
     * @return Response
     */
    public function delete(int $id): Response
    {
        $doctor = Doctor::findOrFail($id);

        $doctor->delete();

        return response('Doctor deleted', 200);
    }
}
