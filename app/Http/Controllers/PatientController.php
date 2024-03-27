<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Get all patients or by filters
     *
     * @param Request $request
     * @return Collection
     */
    public function index(Request $request): Collection
    {
        $age = $request->input('age');
        $diagnosis = $request->input('diagnosis');
        
        $patients = Patient::query();

        if ($age) {
            $patients->where('age', $age);
        }

        if ($diagnosis) {
            $patients->where('diagnostic', $diagnosis);
        }

        $patients = $patients->get();

        return $patients;
    }

    /**
     * Get a patient by id.
     *
     * @param $id
     * @return Patient
     */
    public function show($id): Patient
    {
        $patient = Patient::findOrFail($id);

        return $patient;
    }

    /**
     * Create a new patient.
     *
     * @param Request $request
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'gender' => 'required',
            'age' => 'required',
            'diagnostic' => 'required',
            'coordinates' => 'required'
        ]);

        $patientExist = Patient::where('firstname', $validated['firstname'])
            ->where('lastname', $validated['lastname'])
            ->where('firstname', $validated['firstname'])
            ->where('gender', $validated['gender'])
            ->where('age', $validated['age'])
            ->where('diagnostic', $validated['diagnostic'])
            ->where('coordinates', $validated['coordinates'])
            ->first();

        if ($patientExist) {
            return response()->json(['message' => 'Patient already exists'], 400);
        }

        $patient = Patient::create($validated);

        return response()->json($patient, 201);
    }

    /**
     * Delete a patient by id.
     *
     * @param Request $request
     * @param $id
     */
    public function delete($id)
    {
        $patient = Patient::findOrFail($id);
        $patient->delete();

        return response()->json(['message' => 'Patient deleted'], 200);
    }

    /**
     * Update diagnostic of a patient by id
     *
     * @param Request $request
     * @param $id
     */
    public function updateDiagnosis(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);

        $validated = $request->validate([
            'diagnostic' => 'required'
        ]);

        $patient->update([
            'diagnostic' => $validated['diagnostic']
        ]);

        return response()->json($patient, 201);
    }
}
