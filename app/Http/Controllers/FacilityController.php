<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class FacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Facility::with('materials');

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('business_name', 'like', "%{$search}%")
                  ->orWhere('city', 'like', "%{$search}%")
                  ->orWhereHas('materials', function($materialQuery) use ($search) {
                      $materialQuery->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // Filter by material
        if ($request->has('material_filter') && $request->material_filter) {
            $query->whereHas('materials', function($materialQuery) use ($request) {
                $materialQuery->where('id', $request->material_filter);
            });
        }

        // Sort by last update date
        $query->orderBy('last_update_date', 'desc');

        $facilities = $query->paginate(10);
        $materials = Material::all();

        // Handle CSV export
        if ($request->has('export') && $request->export === 'csv') {
            return $this->exportCsv($query->get());
        }

        return view('facilities.index', compact('facilities', 'materials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $materials = Material::all();
        return view('facilities.create', compact('materials'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'business_name' => 'required|string|max:255',
            'last_update_date' => 'required|date',
            'street_address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'materials' => 'required|array|min:1',
            'materials.*' => 'exists:materials,id'
        ]);

        $facility = Facility::create($request->only(['business_name', 'last_update_date', 'street_address', 'city']));
        $facility->materials()->attach($request->materials);

        return redirect()->route('facilities.index')->with('success', 'Facility created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Facility $facility)
    {
        $facility->load('materials');
        return view('facilities.show', compact('facility'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Facility $facility)
    {
        $materials = Material::all();
        $facility->load('materials');
        return view('facilities.edit', compact('facility', 'materials'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Facility $facility)
    {
        $request->validate([
            'business_name' => 'required|string|max:255',
            'last_update_date' => 'required|date',
            'street_address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'materials' => 'required|array|min:1',
            'materials.*' => 'exists:materials,id'
        ]);

        $facility->update($request->only(['business_name', 'last_update_date', 'street_address', 'city']));
        $facility->materials()->sync($request->materials);

        return redirect()->route('facilities.index')->with('success', 'Facility updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Facility $facility)
    {
        $facility->delete();
        return redirect()->route('facilities.index')->with('success', 'Facility deleted successfully.');
    }

    /**
     * Export facilities to CSV
     */
    private function exportCsv($facilities)
    {
        $filename = 'facilities_' . date('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($facilities) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Business Name', 'Last Updated', 'Address', 'City', 'Materials Accepted']);

            foreach ($facilities as $facility) {
                $materials = $facility->materials->pluck('name')->implode(', ');
                fputcsv($file, [
                    $facility->business_name,
                    $facility->last_update_date->format('Y-m-d'),
                    $facility->street_address,
                    $facility->city,
                    $materials
                ]);
            }
            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }
}
