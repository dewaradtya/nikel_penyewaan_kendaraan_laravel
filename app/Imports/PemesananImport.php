<?php

namespace App\Imports;

use App\Models\Pemesanan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;

class PemesananImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        $status = '';
        switch (strtolower($row['status'])) {
            case 'disetujui':
                $status = 0;
                break;
            case 'diajukan':
                $status = 1;
                break;
            case 'ditolak':
                $status = 2;
                break;
            default:
                $status = 3; // atau status default lainnya
        }

        return new Pemesanan([
            'kendaraan_id' => $row['id_kendaraan'],
            'tanggal_pemesanan' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tanggal_pemesanan']),
            'status' => $status,
        ]);
    }
}
