<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Airport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AirportController extends Controller
{
    public function index()
    {
        $airports = Airport::all();
        return view('adminpanel.airports.index', compact('airports'));
    }

    public function create()
    {
        return view('adminpanel.airports.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'iata_code' => 'required|string',
            'location' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            
            // Build a safe filename
            $extension = strtolower($image->getClientOriginalExtension() ?: $image->extension() ?: 'png');
            $filename = uniqid('airport_', true) . '.' . $extension;
            
            $destinationDir = public_path('img');
            
            // Ensure destination directory exists and is writable
            if (!is_dir($destinationDir)) {
                @mkdir($destinationDir, 0755, true);
            }
            
            $moved = false;
            
            try {
                // Try the built-in move() first
                $image->move($destinationDir, $filename);
                $moved = true;
            } catch (\Throwable $e) {
                // Fall back to copying the temporary uploaded file if move() fails
                $tempPath = $image->getRealPath() ?: $image->getPathname();
                
                if ($tempPath && is_file($tempPath)) {
                    $destPath = $destinationDir . DIRECTORY_SEPARATOR . $filename;
                    @copy($tempPath, $destPath);
                    $moved = is_file($destPath);
                }
            }
            
            if ($moved) {
                $data['image'] = 'img/' . $filename;
            } else {
                $data['image'] = 'img/loginsplash.jpeg';
            }
        } else {
            $data['image'] = 'img/loginsplash.jpeg';
        }

        Airport::create($data);

        return redirect()->route('adminpanel.airports.index')->with('success', 'Airport created successfully!');
    }

    public function edit(Airport $airport)
    {
        return response()->json([
            'id' => $airport->id,
            'name' => $airport->name,
            'iata_code' => $airport->iata_code,
            'location' => $airport->location,
        ]);
    }

    public function update(Request $request, Airport $airport)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'iata_code' => 'required|string',
            'location' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            
            // Build a safe filename
            $extension = strtolower($image->getClientOriginalExtension() ?: $image->extension() ?: 'png');
            $filename = uniqid('airport_', true) . '.' . $extension;
            
            $destinationDir = public_path('img');
            
            // Ensure destination directory exists and is writable
            if (!is_dir($destinationDir)) {
                @mkdir($destinationDir, 0755, true);
            }
            
            $moved = false;
            
            try {
                // Try the built-in move() first
                $image->move($destinationDir, $filename);
                $moved = true;
            } catch (\Throwable $e) {
                // Fall back to copying the temporary uploaded file if move() fails
                $tempPath = $image->getRealPath() ?: $image->getPathname();
                
                if ($tempPath && is_file($tempPath)) {
                    $destPath = $destinationDir . DIRECTORY_SEPARATOR . $filename;
                    @copy($tempPath, $destPath);
                    $moved = is_file($destPath);
                }
            }
            
            if ($moved) {
                // Delete old image if it's not the default
                if ($airport->image && $airport->image !== 'img/loginsplash.jpeg' && file_exists(public_path($airport->image))) {
                    @unlink(public_path($airport->image));
                }
                
                $data['image'] = 'img/' . $filename;
            }
        }

        $airport->update($data);

        return redirect()->route('adminpanel.airports.index')->with('success', 'Airport updated successfully!');
    }

    public function destroy(Airport $airport)
    {
        // Delete image if it's not the default
        if ($airport->image && $airport->image !== 'img/loginsplash.jpeg' && file_exists(public_path($airport->image))) {
            unlink(public_path($airport->image));
        }

        $airport->delete();
        return redirect()->route('adminpanel.airports.index');
    }
}
