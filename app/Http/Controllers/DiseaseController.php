<?php

namespace App\Http\Controllers;

use App\Models\Disease;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class DiseaseController extends Controller
{
    /**
     * Get all diseases or by filters
     *
     * @param Request $request
     * @return Collection
     */
    public function index(Request $request): Collection
    {
        $name = $request->input('name');
        $category = $request->input('category');
        $severity = $request->input('severity');

        $diseases = Disease::query();

        if ($name) {
            $diseases->where('name', $name);
        }

        if ($category) {
            $diseases->where('category', $category);
        }

        if ($severity) {
            $diseases->where('severity', $severity);
        }

        $diseases = $diseases->get();

        return $diseases;
    }

    /**
     * Get a disease by id.
     *
     * @param $id
     * @return Disease
     */
    public function show($id): Disease
    {
        $disease = Disease::findOrFail($id);

        return $disease;
    }

    /**
     * Create a new disease.
     *
     * @param Request $request
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'category' => 'required',
            'severity' => 'required',
        ]);

        $diseaseExist = Disease::where('name', $validated['name'])
            ->where('category', $validated['category'])
            ->where('severity', $validated['severity'])
            ->first();

        if ($diseaseExist) {
            return response('Disease already exists', 409);
        }

        $disease = Disease::create($validated);

        return $disease;
    }

    /**
     * Assign a disease to a patient.
     *
     * @param Request $request
     * @param $id
     */
    public function assign(Request $request, $id)
    {
        $disease = Disease::findOrFail($id);

        $disease->patients()->attach($request->input('patient_id'));

        return $disease;
    }

    /**
     * Delete a disease.
     *
     * @param $id
     */
    public function delete($id)
    {
        $disease = Disease::findOrFail($id);

        $disease->delete();

        return response('Disease deleted', 200);
    }
}
