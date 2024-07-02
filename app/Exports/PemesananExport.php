<?php

namespace App\Exports;

use App\Models\Pemesanan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class PemesananExport implements FromCollection, WithHeadings, WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $pemesanans = Pemesanan::with('kendaraan')->get();

        return $pemesanans->map(function ($pemesanan) {
            $status = '';
            switch ($pemesanan->status) {
                case 0:
                    $status = 'Disetujui';
                    break;
                case 1:
                    $status = 'Diajukan';
                    break;
                case 2:
                    $status = 'Ditolak';
                    break;
                default:
                    $status = 'Tidak Valid';
            }

            return [
                'No.' => $pemesanan->id,
                'Nama Kendaraan' => $pemesanan->kendaraan->id,
                'Tanggal Pemesanan' => $pemesanan->tanggal_pemesanan,
                'Status' => $status,
            ];
        });
    }

    /**
    * @return array
    */
    public function headings(): array
    {
        return [
            'No.', 'Id Kendaraan', 'Tanggal Pemesanan', 'Status'
        ];
    }

    public function title(): string
    {
        return 'Pemesanan';
    }
}
