<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Airline;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AirlineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $airlines = Airline::with('user')->get()->map(function ($airline) {
            return [
                'id' => $airline->id,
                'name' => $airline->name,
                'code' => $airline->code,
                'logo' => $airline->logo_url,
                'user_id' => $airline->user_id,
                'user_email' => $airline->user->email ?? null,
            ];
        });

        return view('adminpanel.airlines.index', compact('airlines'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|size:2|unique:airlines,code',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'user_id' => 'nullable|exists:users,id',
        ]);

        try {
            // Handle logo upload
            if ($request->hasFile('logo')) {
                $logoPath = $request->file('logo')->store('airlines', 'public');
                $validated['logo'] = $logoPath;
            } else {
                $validated['logo'] = 'img/loginsplash.jpeg';
            }

            $airline = Airline::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Airline created successfully!',
                'airline' => [
                    'id' => $airline->id,
                    'name' => $airline->name,
                    'code' => $airline->code,
                    'logo' => $airline->logo_url,
                    'user_id' => $airline->user_id,
                    'user_email' => $airline->user->email ?? null,
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating airline: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Airline $airline)
    {
        return response()->json([
            'id' => $airline->id,
            'name' => $airline->name,
            'code' => $airline->code,
            'logo' => $airline->logo_url,
            'user_id' => $airline->user_id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Airline $airline)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => ['required', 'string', 'size:2', Rule::unique('airlines', 'code')->ignore($airline->id)],
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'user_id' => 'nullable|exists:users,id',
        ]);

        try {
            // Handle logo upload
            if ($request->hasFile('logo')) {
                // Delete old logo if exists and not default
                if ($airline->logo && $airline->logo !== 'img/loginsplash.jpeg') {
                    Storage::disk('public')->delete($airline->logo);
                }
                
                $logoPath = $request->file('logo')->store('airlines', 'public');
                $validated['logo'] = $logoPath;
            }

            $airline->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Airline updated successfully!',
                'airline' => [
                    'id' => $airline->id,
                    'name' => $airline->name,
                    'code' => $airline->code,
                    'logo' => $airline->logo_url,
                    'user_id' => $airline->user_id,
                    'user_email' => $airline->user->email ?? null,
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating airline: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Airline $airline)
    {
        try {
            // Delete associated logo if not default
            if ($airline->logo && $airline->logo !== 'img/loginsplash.jpeg') {
                Storage::disk('public')->delete($airline->logo);
            }

            $airline->delete();

            return response()->json([
                'success' => true,
                'message' => 'Airline deleted successfully!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting airline: ' . $e->getMessage()
            ], 500);
        }
    }
}
