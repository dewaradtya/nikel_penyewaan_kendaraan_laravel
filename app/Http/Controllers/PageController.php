<?php

namespace App\Http\Controllers;

use App\Exports\AllDataExport;
use App\Exports\PemesananExport;
use App\Models\Pemesanan;
use Spatie\Activitylog\Models\Activity;
use App\Exports\UsersExport;
use App\Imports\PemesananImport;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function dashboard()
    {
        $dataKendaraan = Pemesanan::where('pemesanans.status', 0) // Status disetujui
            ->join('kendaraans', 'pemesanans.kendaraan_id', '=', 'kendaraans.id')
            ->select('kendaraans.jenis_kendaraan')
            ->selectRaw('COUNT(*) as jumlah')
            ->groupBy('kendaraans.jenis_kendaraan') // Corrected column name
            ->get();
    
        $jenis = [];
        $jumlah = [];
    
        foreach ($dataKendaraan as $kendaraan) {
            $jenis[] = $kendaraan->jenis_kendaraan;
            $jumlah[] = $kendaraan->jumlah;
        }
    
        return view('admin.page.dashboard', [
            'dataGrafik' => json_encode([
                'jenis' => $jenis,
                'jumlah' => $jumlah,
            ])
        ]);
    }    


    public function aktivitas()
    {
        $activities = Activity::all();

        return view('admin.page.aktivitas', [
            'activities' => $activities,
        ]);
    }

    public function deleteAll()
    {
        Activity::truncate();

        return redirect()->route('admin.page.aktivitas')->with('success', 'Semua aktivitas telah dihapus.');
    }

    public function export() 
    {
        return Excel::download(new PemesananExport, 'Pemesanan.xlsx');
    }

    public function exportAll()
    {
        return Excel::download(new AllDataExport, 'all_data.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        Excel::import(new PemesananImport, $request->file('file'));

        return redirect()->back()->with('success', 'Data pemesanan berhasil diimport');
    }
}
