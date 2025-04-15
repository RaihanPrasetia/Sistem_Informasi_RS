<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil semua negara untuk dropdown
        $countries = Country::all();

        // Ambil parameter pencarian dan country_id
        $countryId = $request->input('country_id');
        $search = $request->input('search');
        $perPage = $request->input('perPage', 5);

        // Query untuk mengambil data states hanya jika country_id dipilih
        $states = [];
        if ($countryId) {
            $states = \App\Models\State::where('country_id', $countryId)
                ->when($search, function ($query, $search) {
                    return $query->where('name', 'like', '%' . $search . '%');
                })
                ->paginate($perPage)
                ->appends(['search' => $search, 'perPage' => $perPage, 'country_id' => $countryId]);
        }

        // Return view dengan data countries dan states
        return view('wilayah.state', compact('countries', 'states', 'countryId'));
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
        // Validasi input
        $validated = $request->validate([
            'country_id' => 'required|exists:countries,id',
            'name' => 'required|string|max:255',
        ]);

        // Simpan data state ke database
        State::create($validated);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('state.index', ['country_id' => $request->country_id])
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
            'name' => 'required|string|max:255',
        ]);

        // Cari data state berdasarkan ID
        $state = State::findOrFail($id);

        // Update data state
        $state->update($validated);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('state.index', ['country_id' => $request->country_id])
            ->with('success', 'Provinsi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $state = State::findOrFail($id);

        // Hapus data state
        $state->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('state.index', ['country_id' => $state->country_id])
            ->with('success', 'Provinsi berhasil dihapus.');
    }
}
