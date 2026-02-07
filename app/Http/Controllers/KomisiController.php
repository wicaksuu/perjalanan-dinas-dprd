<?php

namespace App\Http\Controllers;

use App\Models\Komisi;
use Illuminate\Http\Request;

class KomisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $komisis = Komisi::withCount(['anggotas', 'pendampings'])->get();
        return view('komisi.index', compact('komisis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('komisi.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255|unique:komisis',
            'keterangan' => 'required|string|max:255',
        ]);

        Komisi::create($validated);

        return redirect()->route('komisi.index')->with('success', 'Komisi berhasil ditambahkan.');
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
    public function edit(Komisi $komisi)
    {
        return view('komisi.form', compact('komisi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Komisi $komisi)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255|unique:komisis,nama,' . $komisi->id,
            'keterangan' => 'required|string|max:255',
        ]);

        $komisi->update($validated);

        return redirect()->route('komisi.index')->with('success', 'Komisi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Komisi $komisi)
    {
        if ($komisi->anggotas()->exists() || $komisi->kegiatanDinas()->exists()) {
            return back()->with('error', 'Komisi tidak dapat dihapus karena masih memiliki anggota atau kegiatan terkait.');
        }

        $komisi->delete();

        return redirect()->route('komisi.index')->with('success', 'Komisi berhasil dihapus.');
    }
}
