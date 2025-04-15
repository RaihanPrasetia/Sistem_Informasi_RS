<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\Patient;
use App\Models\Service;
use App\Models\Registration;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            // Ambil semua pasien dan layanan untuk dropdown
            $patients = Patient::all();
            $services = Service::all();
            $countries = Country::all(); // Ambil semua negara untuk dropdown

            // Ambil parameter pencarian dan jumlah data per halaman
            $search = $request->input('search');
            $perPage = $request->input('perPage', 10); // Default 10 data per halaman

            // Ambil data pendaftaran hari ini dengan pencarian
            $registrations = Registration::whereDate('registration_date', Carbon::today())
                ->when($search, function ($query, $search) {
                    $query->whereHas('patient', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    })->orWhereHas('patient', function ($q) use ($search) {
                        $q->where('patient_number', 'like', "%{$search}%");
                    })->orWhereHas('service', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
                })
                ->with(['patient', 'service'])
                ->paginate($perPage);

            return view('register.index', compact('patients', 'services', 'registrations', 'search', 'perPage', 'countries'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat data: ' . $e->getMessage());
        }
    }

    public function addPatient(Request $request)
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
            return redirect()->route('register.index')->with('success', 'Pasien berhasil ditambahkan.');
        } catch (\Exception $e) {
            // Redirect kembali dengan pesan error
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data pasien: ' . $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Pastikan pengguna sudah login
            $user = Auth::user();
            if (!$user) {
                return redirect()->back()->with('error', 'Anda harus login untuk melakukan pendaftaran.');
            }

            // Validasi input
            $validated = $request->validate([
                'patient_id' => 'required|exists:patients,id',
                'service_id' => 'required|exists:services,id',
                'notes' => 'nullable|string|max:500',
            ]);

            // Simpan data pendaftaran ke database
            Registration::create([
                'patient_id' => $validated['patient_id'],
                'service_id' => $validated['service_id'],
                'registration_date' => now(), // Tanggal pendaftaran saat ini
                'notes' => $validated['notes'],
                'created_by' => $user->id, // ID pengguna yang membuat pendaftaran
            ]);

            return redirect()->route('register.index')->with('success', 'Pendaftaran berhasil dilakukan.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat melakukan pendaftaran: ' . $e->getMessage());
        }
    }
}
