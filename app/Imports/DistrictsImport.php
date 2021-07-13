<?php


namespace App\Imports;

use App\Models\LocationDistrict;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\DB;
use DateTime;


class DistrictsImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        $district_name =  DB::table('location_districts')->pluck('district_name')->toArray();

        foreach ($rows as $row)
        {
            if ($row['district_name'] != null) {
                if (in_array($row['district_name'], $district_name )) {
                    continue;
                }

                LocationDistrict::create([
                    'district_name' => $row['district_name'],
                    'created_by' => 'System',
                    'created_datetime' => new DateTime(),
                ]);

                $district_name [] = $row['district_name'];
            }
        }
    }
}
