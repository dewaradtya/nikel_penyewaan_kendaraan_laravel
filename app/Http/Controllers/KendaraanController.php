<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KendaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kendaraan = Kendaraan::all();
        return view('kendaraan.index', [
            'kendaraan' => $kendaraan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kendaraan.create');
    }

    /**
     * Menyimpan kendaraan baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenis_kendaraan' => 'required',
            'plat_nomor' => 'required|unique:kendaraans',
            'status' => 'required'
        ]);

        $kendaraan = Kendaraan::create([
            'jenis_kendaraan' => $request->jenis_kendaraan,
            'plat_nomor' => $request->plat_nomor,
            'status' => $request->status
        ]);

        activity()
            ->causedBy(Auth::user())
            ->log('Menambahkan kendaraan baru: ' . $kendaraan->id);

        return redirect()->route('kendaraan.index')->with('success', 'Kendaraan berhasil ditambahkan');
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
        $kendaraan = Kendaraan::findOrFail($id);
        return view('kendaraan.edit', [
            'kendaraan' => $kendaraan,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'jenis_kendaraan' => 'required',
            'plat_nomor' => 'required|unique:kendaraans',
            'status' => 'required'
        ]);

        $kendaraan = Kendaraan::findOrFail($id);

        $kendaraan->jenis_kendaraan = $request->jenis_kendaraan;
        $kendaraan->plat_nomor = $request->plat_nomor;
        $kendaraan->status = $request->status;
        $kendaraan->save();

        activity()
            ->causedBy(Auth::user())
            ->log('Memperbarui kendaraan: ' . $kendaraan->jenis_kendaraan);


        return redirect()->route('kendaraan.index')->with('success', 'Kendaraan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        $kendaraan->delete();

        activity()
            ->causedBy(Auth::user())
            ->log('Menghapus kendaraan: ' . $kendaraan->jenis_kendaraan);

        return redirect()->route('kendaraan.index')->with('success', 'Data berhasil dihapus!');
    }
}
