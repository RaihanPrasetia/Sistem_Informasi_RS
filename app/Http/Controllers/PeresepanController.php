<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\Drug;
use App\Models\RegistrationDrug;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PeresepanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil data pendaftaran hari ini beserta obat-obatan yang terkait
        $registrations = Registration::whereDate('registration_date', Carbon::today())
            ->with(['patient', 'service', 'registrationDrugs.drug']) // Relasi ke obat-obatan
            ->get();

        // Ambil semua obat untuk dropdown (opsional jika diperlukan)
        $drugs = Drug::all();

        return view('peresepan.index', compact('registrations', 'drugs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        // Ambil data pendaftaran berdasarkan ID
        $registration = Registration::with(['patient', 'service'])->findOrFail($id);

        // Ambil semua obat untuk dropdown
        $drugs = Drug::all();

        return view('peresepan.create', compact('registration', 'drugs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'registration_id' => 'required|exists:registrations,id',
                'drugs' => 'required|array',
                'drugs.*.id' => 'required|exists:drugs,id',
                'drugs.*.quantity' => 'required|integer|min:1',
                'drugs.*.dosage' => 'required|string|max:255',
            ]);

            foreach ($validated['drugs'] as $drug) {
                RegistrationDrug::create([
                    'registration_id' => $validated['registration_id'],
                    'drug_id' => $drug['id'],
                    'quantity' => $drug['quantity'],
                    'dosage' => $drug['dosage'],
                ]);
            }

            return redirect()->route('peresepan.index')->with('success', 'Resep berhasil disimpan.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan resep: ' . $e->getMessage())->withInput();
        }
    }

    public function getDrugs($id)
    {
        $drugs = RegistrationDrug::where('registration_id', $id)
            ->with('drug')
            ->get()
            ->map(function ($registrationDrug) {
                return [
                    'id' => $registrationDrug->drug_id,
                    'name' => $registrationDrug->drug->name,
                    'quantity' => $registrationDrug->quantity,
                    'dosage' => $registrationDrug->dosage,
                ];
            });

        return response()->json($drugs);
    }

    public function update(Request $request,  $peresepan)
    {
        try {
            // Validasi input
            $validated = $request->validate([
                'drugs' => 'required|array',
                'drugs.*.id' => 'required|exists:drugs,id',
                'drugs.*.quantity' => 'required|integer|min:1',
                'drugs.*.dosage' => 'required|string|max:255',
            ]);

            // Hapus resep lama
            RegistrationDrug::where('registration_id',  $peresepan)->delete();

            // Tambahkan resep baru
            foreach ($validated['drugs'] as $drug) {
                RegistrationDrug::create([
                    'registration_id' =>  $peresepan,
                    'drug_id' => $drug['id'],
                    'quantity' => $drug['quantity'],
                    'dosage' => $drug['dosage'],
                ]);
            }

            return redirect()->route('peresepan.index')->with('success', 'Resep berhasil diperbarui.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui resep: ' . $e->getMessage())->withInput();
        }
    }
}
