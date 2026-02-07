<?php

namespace App\Http\Controllers;

use App\Models\Komisi;
use App\Models\Pendamping;
use Illuminate\Http\Request;

class PendampingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pendampings = Pendamping::with('komisi')->paginate(15);
        return view('pendamping.index', compact('pendampings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $komisis = Komisi::all();
        $pegawais = \App\Models\Pegawai::all();
        return view('pendamping.form', compact('komisis', 'pegawais'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pegawai_id' => 'required|exists:pegawais,id',
            'komisi_id' => 'required|exists:komisis,id',
            'anggota_id' => 'nullable|exists:anggotas,id',
            'nama' => 'nullable|string|max:255',
            'nip' => 'nullable|string|max:30',
            'jabatan' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:20',
        ]);

        Pendamping::create($validated);

        return redirect()->route('pendamping.index')->with('success', 'Pendamping berhasil ditambahkan.');
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
    public function edit(Pendamping $pendamping)
    {
        $komisis = Komisi::all();
        $pegawais = \App\Models\Pegawai::all();
        return view('pendamping.form', compact('pendamping', 'komisis', 'pegawais'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pendamping $pendamping)
    {
        $validated = $request->validate([
            'pegawai_id' => 'required|exists:pegawais,id',
            'komisi_id' => 'required|exists:komisis,id',
            'anggota_id' => 'nullable|exists:anggotas,id',
            'nama' => 'nullable|string|max:255',
            'nip' => 'nullable|string|max:30',
            'jabatan' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:20',
        ]);

        $pendamping->update($validated);

        return redirect()->route('pendamping.index')->with('success', 'Pendamping berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pendamping $pendamping)
    {
        $pendamping->delete();

        return redirect()->route('pendamping.index')->with('success', 'Pendamping berhasil dihapus.');
    }
}
