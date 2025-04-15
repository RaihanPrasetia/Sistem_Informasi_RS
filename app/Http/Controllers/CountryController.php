<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil semua negara
        $perPage = $request->input('perPage', 5);
        $search = $request->input('search'); // Parameter pencarian

        $countries = Country::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%");
        })->paginate($perPage)->appends(['search' => $search, 'perPage' => $perPage]);
        return view('wilayah.country', compact('countries'));
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
            'name' => 'required|string|max:255',
        ]);

        // Ubah huruf awal menjadi huruf besar
        $validated['name'] = ucwords(strtolower($validated['name']));

        // Simpan data ke database
        Country::create($validated);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('country.index')->with('success', 'Negara berhasil ditambahkan.');
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

        // Ubah huruf awal menjadi huruf besar
        $validated['name'] = ucwords(strtolower($validated['name']));

        // Cari data country berdasarkan ID
        $country = Country::findOrFail($id);

        // Update data country
        $country->update($validated);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('country.index')->with('success', 'Data negara berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $country = Country::findOrFail($id); // Cari drug berdasarkan ID
        $country->delete(); // Hapus drug
        return redirect()->route('country.index')->with('success', 'Data berhasil dihapus.');
    }
}
