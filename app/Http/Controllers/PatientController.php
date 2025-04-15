<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\Patient;
use App\Models\State;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $countries = Country::all(); // Ambil semua negara untuk dropdown
        $perPage = $request->input('perPage', 5); // Default 10 data per halaman
        $search = $request->input('search'); // Parameter pencarian

        $patients = Patient::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                ->orWhere('type', 'like', "%{$search}%");
        })->paginate($perPage)->appends(['search' => $search, 'perPage' => $perPage]);
        return view('patient.index', compact('patients', 'countries')); // Menampilkan daftar pasien
    }


    public function getStates(Request $request)
    {
        $countryId = $request->input('country_id');
        $states = State::where('country_id', $countryId)->get();

        return response()->json($states);
    }

    public function getCities(Request $request)
    {
        $stateId = $request->input('state_id');
        $cities = City::where('state_id', $stateId)->get();

        return response()->json($cities);
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
        try {
            // Validasi input
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'nik' => 'required|numeric|digits:16|unique:patients,nik',
                'phone' => 'nullable|string|max:15',
                'gender' => 'required|in:Laki-laki,Perempuan',
                'birth_date' => 'required|date',
                'age' => 'required|integer|min:0',
                'country_id' => 'required|exists:countries,id',
                'state_id' => 'required|exists:states,id',
                'city_id' => 'required|exists:cities,id',
                'address' => 'required|string|max:500',
            ]);

            // Ambil data negara, provinsi, dan kota berdasarkan ID
            $country = Country::findOrFail($validated['country_id']);
            $state = State::findOrFail($validated['state_id']);
            $city = City::findOrFail($validated['city_id']);

            // Format alamat lengkap
            $fullAddress = "{$validated['address']}, {$city->name}, {$state->name}, {$country->name}";

            // Simpan data pasien ke database
            Patient::create([
                'name' => $validated['name'],
                'nik' => $validated['nik'],
                'phone' => $validated['phone'],
                'gender' => $validated['gender'],
                'birth_date' => $validated['birth_date'],
                'age' => $validated['age'],
                'address' => $fullAddress, // Alamat lengkap
            ]);

            // Redirect ke halaman index dengan pesan sukses
            return redirect()->route('patient.index')->with('success', 'Pasien berhasil ditambahkan.');
        } catch (\Exception $e) {
            // Redirect kembali dengan pesan error
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data pasien: ' . $e->getMessage());
        }
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
        try {
            // Validasi input
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'nik' => 'required|numeric|digits:16|unique:patients,nik,' . $id,
                'phone' => 'nullable|string|max:15',
                'gender' => 'required|in:Laki-laki,Perempuan',
                'birth_date' => 'required|date',
                'age' => 'required|integer|min:0',
                'address' => 'required|string|max:500',
            ]);

            // Ambil data negara, provinsi, dan kota berdasarkan ID


            // Cari data pasien berdasarkan ID
            $patient = Patient::findOrFail($id);

            // Update data pasien
            $patient->update([
                'name' => $validated['name'],
                'nik' => $validated['nik'],
                'phone' => $validated['phone'],
                'gender' => $validated['gender'],
                'birth_date' => $validated['birth_date'],
                'age' => $validated['age'],
                'address' => $validated['address'], // Alamat lengkap
            ]);

            // Redirect ke halaman index dengan pesan sukses
            return redirect()->route('patient.index')->with('success', 'Data pasien berhasil diperbarui.');
        } catch (\Exception $e) {
            // Redirect kembali dengan pesan error
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat memperbarui data pasien: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Cari data pasien berdasarkan ID
            $patient = Patient::findOrFail($id);

            // Hapus data pasien
            $patient->delete();

            // Redirect ke halaman index dengan pesan sukses
            return redirect()->route('patient.index')->with('success', 'Data pasien berhasil dihapus.');
        } catch (\Exception $e) {
            // Redirect kembali dengan pesan error
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data pasien: ' . $e->getMessage());
        }
    }
}
