<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Airport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AirportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $airports = Airport::all()->map(function ($airport) {
            return [
                'id' => $airport->id,
                'name' => $airport->name,
                'iata_code' => $airport->iata_code,
                'location' => $airport->location,
                'image' => $airport->image_url,
            ];
        });

        return view('adminpanel.airports.index', compact('airports'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'iata_code' => 'required|string|size:3|unique:airports,iata_code',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            // Handle image upload
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('airports', 'public');
                $validated['image'] = $imagePath;
            }

            $airport = Airport::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Airport created successfully!',
                'airport' => [
                    'id' => $airport->id,
                    'name' => $airport->name,
                    'iata_code' => $airport->iata_code,
                    'location' => $airport->location,
                    'image' => $airport->image_url,
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating airport: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Airport $airport)
    {
        return response()->json([
            'id' => $airport->id,
            'name' => $airport->name,
            'iata_code' => $airport->iata_code,
            'location' => $airport->location,
            'image' => $airport->image_url,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Airport $airport)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'iata_code' => 'required|string|size:3|unique:airports,iata_code,' . $airport->id,
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            // Handle image upload
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($airport->image) {
                    Storage::disk('public')->delete($airport->image);
                }
                
                $imagePath = $request->file('image')->store('airports', 'public');
                $validated['image'] = $imagePath;
            }

            $airport->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Airport updated successfully!',
                'airport' => [
                    'id' => $airport->id,
                    'name' => $airport->name,
                    'iata_code' => $airport->iata_code,
                    'location' => $airport->location,
                    'image' => $airport->image_url,
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating airport: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Airport $airport)
    {
        try {
            // Delete associated image
            if ($airport->image) {
                Storage::disk('public')->delete($airport->image);
            }

            $airport->delete();

            return response()->json([
                'success' => true,
                'message' => 'Airport deleted successfully!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting airport: ' . $e->getMessage()
            ], 500);
        }
    }
}