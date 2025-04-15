<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil semua negara untuk dropdown
        $countries = Country::all();

        // Ambil parameter country_id, state_id, dan pencarian
        $countryId = $request->input('country_id');
        $stateId = $request->input('state_id');
        $search = $request->input('search');
        $perPage = $request->input('perPage', 5);

        // Ambil data states berdasarkan country_id
        $states = [];
        if ($countryId) {
            $states = State::where('country_id', $countryId)->get();
        }

        // Ambil data cities berdasarkan state_id dan pencarian
        $cities = [];
        if ($stateId) {
            $cities = City::where('state_id', $stateId)
                ->when($search, function ($query, $search) {
                    return $query->where('name', 'like', '%' . $search . '%');
                })
                ->paginate($perPage)
                ->appends(['search' => $search, 'perPage' => $perPage, 'country_id' => $countryId, 'state_id' => $stateId]);
        }

        // Return view dengan data countries, states, dan cities
        return view('wilayah.city', compact('countries', 'states', 'cities', 'countryId', 'stateId'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'country_id' => 'required|exists:countries,id',
            'state_id' => 'required|exists:states,id',
            'name' => 'required|string|max:255',
        ]);

        // Simpan data state ke database
        City::create($validated);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('city.index', ['country_id' => $request->country_id, 'state_id' => $request->state_id])
            ->with('success', 'Provinsi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $validated = $request->validate([
            'country_id' => 'required|exists:countries,id',
            'state_id' => 'required|exists:states,id',
            'name' => 'required|string|max:255',
        ]);

        // Cari data city berdasarkan ID
        $city = City::find($id);

        if (!$city) {
            return redirect()->route('city.index', ['country_id' => $request->country_id, 'state_id' => $request->state_id])
                ->with('error', 'Data kota tidak ditemukan.');
        }

        // Update data city
        $city->update($validated);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('city.index', ['country_id' => $request->country_id, 'state_id' => $request->state_id])
            ->with('success', 'Data kota berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Cari data city berdasarkan ID
        $city = City::find($id);

        if (!$city) {
            return redirect()->back()->with('error', 'Data kota tidak ditemukan.');
        }

        // Hapus data city
        $city->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('city.index', ['country_id' => $city->state->country_id, 'state_id' => $city->state_id])
            ->with('success', 'Data kota berhasil dihapus.');
    }
}
