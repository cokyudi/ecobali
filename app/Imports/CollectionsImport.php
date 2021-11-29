<?php


namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use DateTime;
use Illuminate\Support\Facades\DB;
use App\Models\Collection as CollectionModel;
use Illuminate\Support\Facades\Log;


class CollectionsImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        $participantMap = $this->getParticipantMap();

        foreach ($rows as $row)
        {
            if (!$this->isNullOrEmptyString($row['participant_name'])) {
                $participantId = $this->getIdInArray($participantMap, $row['participant_name']);
                if(!$this->isNullOrEmptyString($row['collect_date'])) {
                    $newDateString = $this->transformDate($row['collect_date']);
                    $formatDate = $newDateString->format('Y-m-d');
                } else {
                    $formatDate = null;
                }

                CollectionModel::create([
                    'id_participant' => $participantId,
                    'quantity' => $row['quantity'],
                    'collect_date' => $formatDate,
                    'created_by' => 'System',
                    'created_datetime' => new DateTime(),
                ]);

            }
        }
    }

    function isNullOrEmptyString($str){
        return (!isset($str) || trim($str) === '');
    }

    function getParticipantMap() {
        $participants =  DB::table('participants')->pluck('participant_name','id');
        $participantMap = [];

        foreach ($participants as $id => $participant_name) {
            $participantMap[trim(strtolower($participant_name))] = $id;
        }
        return $participantMap;
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

    public function transformDate($value, $format = 'Y-m-d')
    {
        try {
            return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
        } catch (\ErrorException $e) {
            return \Carbon\Carbon::createFromFormat($format, $value);
        }
    }
}
