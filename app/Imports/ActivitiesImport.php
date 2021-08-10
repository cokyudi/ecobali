<?php


namespace App\Imports;

use App\Models\Area;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\DB;
use DateTime;


class AreasImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        $area_names =  DB::table('areas')->pluck('area_name')->toArray();

        foreach ($rows as $row)
        {
            if ($row['area_name'] != null) {
                if (in_array($row['area_name'], $area_names )) {
                    continue;
                }
//                var_dump($row['area_name']);

                Area::create([
                    'area_name' => $row['area_name'],
                    'created_by' => 'System',
                    'created_datetime' => new DateTime(),
                ]);

                $area_names [] = $row['area_name'];
            }
        }
    }
}
