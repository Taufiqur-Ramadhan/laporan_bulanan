<?php

namespace App\Exports;

use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class KegiatanMultipleSheetExport implements WithMultipleSheets
{
    protected $records;

    public function __construct(Collection $records)
    {
        $this->records = $records;
    }

    public function sheets(): array
    {
        $sheets = [];

        foreach ($this->records as $index => $record) {
            $sheets[] = new KegiatanSingleSheetExport($record, $index + 1);
        }

        return $sheets;
    }
}
