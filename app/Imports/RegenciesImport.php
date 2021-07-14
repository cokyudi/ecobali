<?php


namespace App\Imports;

use App\Models\Regency;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\DB;
use DateTime;


class RegenciesImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        $regency_name =  DB::table('regencies')->pluck('regency_name')->toArray();

        foreach ($rows as $row)
        {
            if ($row['regency_name'] != null) {
                if (in_array($row['regency_name'], $regency_name )) {
                    continue;
                }

                Regency::create([
                    'regency_name' => $row['regency_name'],
                    'created_by' => 'System',
                    'created_datetime' => new DateTime(),
                ]);

                $regency_name [] = $row['regency_name'];
            }
        }
    }
}
