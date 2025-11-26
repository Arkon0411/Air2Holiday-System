<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Airline;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AirlineController extends Controller
{
    public function index()
    {
        $airlines = Airline::with('user')->get();
        $airlineUsers = User::where('usertype', 'airline')->get();
        return view('adminpanel.airlines.index', compact('airlines', 'airlineUsers'));
    }

    public function create()
    {
        return view('adminpanel.airlines.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'code' => 'required|string|unique:airlines,code',
            'user_id' => 'nullable|exists:users,id',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            
            // Build a safe filename
            $extension = strtolower($image->getClientOriginalExtension() ?: $image->extension() ?: 'png');
            $filename = uniqid('airline_', true) . '.' . $extension;
            
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
                $data['logo'] = 'img/' . $filename;
            }
        }

        Airline::create($data);

        return redirect()->route('adminpanel.airlines.index')->with('success', 'Airline created successfully!');
    }

    public function edit(Airline $airline)
    {
        return response()->json([
            'id' => $airline->id,
            'name' => $airline->name,
            'code' => $airline->code,
            'user_id' => $airline->user_id,
        ]);
    }

    public function update(Request $request, Airline $airline)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'code' => 'required|string|unique:airlines,code,' . $airline->id,
            'user_id' => 'nullable|exists:users,id',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            
            // Build a safe filename
            $extension = strtolower($image->getClientOriginalExtension() ?: $image->extension() ?: 'png');
            $filename = uniqid('airline_', true) . '.' . $extension;
            
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
                // Delete old logo if it exists
                if ($airline->logo && file_exists(public_path($airline->logo))) {
                    @unlink(public_path($airline->logo));
                }
                
                $data['logo'] = 'img/' . $filename;
            }
        }

        $airline->update($data);

        return redirect()->route('adminpanel.airlines.index')->with('success', 'Airline updated successfully!');
    }

    public function destroy(Airline $airline)
    {
        // Delete logo if it exists
        if ($airline->logo && file_exists(public_path($airline->logo))) {
            @unlink(public_path($airline->logo));
        }

        $airline->delete();

        return redirect()->route('adminpanel.airlines.index');
    }
}
