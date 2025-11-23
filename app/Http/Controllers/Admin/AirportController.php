<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Airport;
use Illuminate\Http\Request;

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
            'location' => 'nullable|string',
        ]);

        Airport::create($data);

        return redirect()->route('adminpanel.airports.index');
    }

    public function edit(Airport $airport)
    {
        return view('adminpanel.airports.edit', compact('airport'));
    }

    public function update(Request $request, Airport $airport)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'iata_code' => 'required|string',
            'location' => 'nullable|string',
        ]);

        $airport->update($data);

        return redirect()->route('adminpanel.airports.index');
    }

    public function destroy(Airport $airport)
    {
        $airport->delete();
        return redirect()->route('adminpanel.airports.index');
    }
}
