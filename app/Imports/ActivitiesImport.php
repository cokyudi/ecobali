<?php


namespace App\Imports;

use App\Models\Activity;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\DB;
use DateTime;


class ActivitiesImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        $programActivityMap = $this->getProgramActivityMap();
        $categoryMap = $this->getCategoryMap();
        $districtMap = $this->getDistrictMap();
        $regencyMap = $this->getRegencyMap();

        foreach ($rows as $row)
        {
            if (!$this->isNullOrEmptyString($row['program_activity'])) {
                $programActivityId = $this->getIdInArray($programActivityMap, $row['program_activity']);
                $categoryId = $this->getIdInArray($categoryMap, $row['category']);
                $districtId = $this->getIdInArray($districtMap, $row['district']);
                $regencyId = $this->getIdInArray($regencyMap, $row['regency']);

                if(!$this->isNullOrEmptyString($row['activity_date'])) {
                    $newDateString = $this->transformDate($row['activity_date']);
                    $formatDate = $newDateString->format('Y-m-d');
                } else {
                    $formatDate = null;
                }

                Activity::create([

                    'id_program_activity' => $programActivityId,
                    'activity' => $row['activity'],
                    'activity_date' => $formatDate,
                    'location' => $row['location'],
                    'id_category' => $categoryId,
                    'id_district' => $districtId,
                    'id_regency' => $regencyId,
                    'participant_number' => $row['participant_number'],

                    'created_by' => 'System',
                    'created_datetime' => new DateTime(),
                ]);

            }
        }
    }

    public function transformDate($value, $format = 'Y-m-d')
    {
        try {
            return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
        } catch (\ErrorException $e) {
            return \Carbon\Carbon::createFromFormat($format, $value);
        }
    }

    function isNullOrEmptyString($str){
        return (!isset($str) || trim($str) === '');
    }

    function isExistInArray($array, $var):bool {
        return array_key_exists($var,$array);
    }

    function getIdInArray($array, $var) {
        if ($this->isExistInArray($array, trim(strtolower($var)))) {
            return $array[trim(strtolower($var))];
        } else {
            return null;
        }
    }

    function getProgramActivityMap() {
        $activity_programs =  DB::table('activity_programs')->pluck('activity_program_name','id');
        $programActivityMap = [];

        foreach ($activity_programs as $id => $activity_program_name) {
            $programActivityMap[trim(strtolower($activity_program_name))] = $id;
        }
        return $programActivityMap;
    }

    function getCategoryMap() {
        $categories =  DB::table('categories')->pluck('category_name','id');
        $categoryMap = [];

        foreach ($categories as $id => $category_name) {
            $categoryMap[trim(strtolower($category_name))] = $id;
        }
        return $categoryMap;
    }

    function getDistrictMap() {
        $districts =  DB::table('districts')->pluck('district_name','id');
        $districtMap = [];

        foreach ($districts as $id => $district_name) {
            $districtMap[trim(strtolower($district_name))] = $id;
        }
        return $districtMap;
    }

    function getRegencyMap() {
        $regencies =  DB::table('regencies')->pluck('regency_name','id');
        $regencyMap = [];

        foreach ($regencies as $id => $regency_name) {
            $regencyMap[trim(strtolower($regency_name))] = $id;
        }
        return $regencyMap;
    }
}
