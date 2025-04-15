<?php

namespace App\Http\Controllers;

use App\Models\Drug;
use Illuminate\Http\Request;

class DrugController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 5); // Default 10 data per halaman
        $search = $request->input('search'); // Parameter pencarian

        $drugs = Drug::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                ->orWhere('type', 'like', "%{$search}%");
        })->paginate($perPage)->appends(['search' => $search, 'perPage' => $perPage]);

        return view('drug.index', compact('drugs'));
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
            'type' => 'required|string|max:50',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        // Simpan data drug ke database
        Drug::create($validated);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('drug.index')->with('success', 'Drug berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $drug = Drug::findOrFail($id);
        return response()->json($drug);
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
    public function update(Request $request, $id)
    {
        $drug = Drug::findOrFail($id);
        $drug->update($request->all());
        return redirect()->route('drug.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $drug = Drug::findOrFail($id); // Cari drug berdasarkan ID
        $drug->delete(); // Hapus drug
        return redirect()->route('drug.index')->with('success', 'Data berhasil dihapus.');
    }
}
