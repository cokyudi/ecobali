<?php


namespace App\Imports;

use App\Models\LocationSubdistrict;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\DB;
use DateTime;


class SubDistrictsImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        $district_name =  DB::table('location_subdistricts')->pluck('subdistrict_name')->toArray();

        foreach ($rows as $row)
        {
            if ($row['subdistrict_name'] != null) {
                if (in_array($row['subdistrict_name'], $district_name )) {
                    continue;
                }

                LocationSubdistrict::create([
                    'subdistrict_name' => $row['subdistrict_name'],
                    'created_by' => 'System',
                    'created_datetime' => new DateTime(),
                ]);

                $district_name [] = $row['subdistrict_name'];
            }
        }
    }
}
