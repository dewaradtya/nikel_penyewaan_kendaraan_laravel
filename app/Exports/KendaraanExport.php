<?php

namespace App\Exports;

use App\Models\Kendaraan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class KendaraanExport implements FromCollection, WithHeadings, WithTitle
{
    public function collection()
    {
        return Kendaraan::all();
    }

    public function headings(): array
    {
        return ['ID', 'Jenis Kendaraan', 'Plat Nomor', 'Status','Created At', 'Updated At'];
    }

    public function title(): string
    {
        return 'Kendaraan';
    }
}

