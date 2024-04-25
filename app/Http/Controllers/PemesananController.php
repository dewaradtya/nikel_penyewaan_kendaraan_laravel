<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pemesanan = Pemesanan::all();
        $kendaraan = Kendaraan::all();
        return view('pemesanan.index', [
            'pemesanan' => $pemesanan, 
            'kendaraan' => $kendaraan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kendaraan = Kendaraan::all();   
        return view('pemesanan.create', [
            'kendaraan' => $kendaraan
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kendaraan_id' => 'required',
            'tanggal_pemesanan' => 'required',
            'status' => 'required'
        ]);

        $pemesanan = Pemesanan::create([
            'kendaraan_id' => $request->kendaraan_id,
            'tanggal_pemesanan' => $request->tanggal_pemesanan,
            'status' => $request->status
        ]);

        activity()
            ->causedBy(Auth::user())
            ->log('Menambahkan pemesanan baru: ' . $pemesanan->id);

        return redirect()->route('pemesanan.index')->with('success', 'pemesanan berhasil ditambahkan');
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
        $pemesanan = Pemesanan::findOrFail($id);
        $kendaraan = Kendaraan::all();
        return view('pemesanan.edit', [
            'pemesanan' => $pemesanan,
            'kendaraan' => $kendaraan,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'tanggal_pemesanan' => 'required',
            'kendaraan_id' => 'required',
        ]);

        $pemesanan = Pemesanan::findOrFail($id);

        $pemesanan->tanggal_pemesanan = $request->tanggal_pemesanan;
        $pemesanan->kendaraan_id = $request->kendaraan_id;
        $pemesanan->status = $request->status;
        $pemesanan->save();

        activity()
            ->causedBy(Auth::user())
            ->log('Memperbarui pemesanan: ' . $pemesanan->id);

        return redirect()->route('pemesanan.index')->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->delete();

        activity()
            ->causedBy(Auth::user())
            ->log('Menghapus pemesanan: ' . $pemesanan->jenis);

        return redirect()->route('pemesanan.index')->with('success', 'Data berhasil dihapus!');
    }

    public function approve(Request $request, $id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->status = $request->status;
        $pemesanan->save();

        activity()
            ->causedBy(Auth::user())
            ->log('Mengubah status pemesanan: ' . $pemesanan->id . ' menjadi ' . $request->status);

        return redirect()->route('pemesanan.index')->with('success', 'Status pemesanan berhasil diperbarui');
    }
}
