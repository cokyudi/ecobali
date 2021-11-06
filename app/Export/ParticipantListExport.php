<?php

namespace App\Export;

use App\Models\Participant;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class ParticipantListExport implements FromQuery, WithHeadings, WithMapping,WithColumnFormatting,ShouldAutoSize,WithStyles
{

    public $status;
    public $idParticipant;
    public $idCategory;
    public $idDistrict;
    public $idRegency;
    public $startDates;
    public $endDates;

    public function __construct($request) {
        $this->status = $request->status;
        $this->idParticipant = $request->idParticipant;
        $this->idDistrict = $request->idDistrict;
        $this->idRegency = $request->idRegency;
        $this->idCategory = $request->idCategory;
        $this->startDates = $request->startDates;
        $this->endDates = $request->endDates;
    }

    public function query()
    {
        $participants = DB::table('participants')
            ->leftJoin('categories', function ($join) {
                $join->on('participants.id_category', '=', 'categories.id');
            })
            ->leftJoin('areas', function ($join) {
                $join->on('participants.id_area', '=', 'areas.id');
            })
            ->leftJoin('districts', function ($join) {
                $join->on('participants.id_district', '=', 'districts.id');
            })
            ->leftJoin('regencies', function ($join) {
                $join->on('participants.id_regency', '=', 'regencies.id');
            })
            ->leftJoin('collections', function ($join) {
                $join->on('participants.id', '=', 'collections.id_participant');
            })
            ->select(
                'participants.id',
                'participants.participant_name',
                DB::raw('DATE_FORMAT(participants.joined_date, "%d/%m/%Y") joined_date'),
                'categories.category_name',
                'regencies.regency_name',
                DB::raw('ROUND(SUM(collections.quantity),1) qty'),
                DB::raw('ROUND(AVG(collections.quantity),1) avg'),
                DB::raw('DATE_FORMAT(MAX(collect_date), "%d/%m/%Y") lastSubmit'),
                DB::raw('CASE WHEN MAX(collect_date) >= CURDATE() - INTERVAL 3 MONTH THEN "ACTIVE" ELSE "INACTIVE" END status'),
            )
            ->groupBy('id','participant_name','joined_date','category_name','regency_name')
            ->orderBy('participant_name','ASC');

        if (isset($request->idCategory) && count($request->idCategory) != 0) {
            $participants = $participants->whereIn('categories.id', $request->idCategory);
        }

        if (isset($request->idArea) && count($request->idArea) != 0) {
            $participants = $participants->whereIn('areas.id', $request->idArea);
        }

        if (isset($request->idDistrict) && count($request->idDistrict) != 0) {
            $participants = $participants->whereIn('districts.id', $request->idDistrict);
        }

        if (isset($request->idRegency) && count($request->idRegency) != 0) {
            $participants = $participants->whereIn('regencies.id', $request->idRegency);
        }

        if (isset($request->idStatus) && $request->idStatus > 0) {
            if($request->idStatus == 1) {
                $participants = $participants->having('status', '=',"ACTIVE");
            } else {
                $participants = $participants->having('status', '=','INACTIVE');
            }
        }

        if($request->startDates == '2021-01-01' && $request->endDates == date("Y-m-d")) {

        } else {
            $participants = $participants->whereBetween('collections.collect_date', [$request->startDates,$request->endDates]);
        }

        return $participants;

    }

    public function map($participants): array
    {
        return [
            $participants->id,
            $participants->participant_name,
            $participants->category_name,
            $participants->address,
            $participants->latitude,
            $participants->langitude,
            $participants->contact_name_1,
            $participants->contact_position_1,
            $participants->contact_phone_1,
            $participants->contact_email_1,
            $participants->contact_name_2,
            $participants->contact_position_2,
            $participants->contact_phone_2,
            $participants->contact_email_2,
            $participants->service_area,
            $participants->area_name,
            $participants->district_name,
            $participants->regency_name,
            Date::stringToExcel($participants->joined_date),
            $this->getListIdInArray($boxResourceMap, $participants->id_box_resource),
            $participants->resource_description,
            $participants->price,
            $participants->intensity,
            $participants->payment_method,
            $participants->bank_name,
            $participants->bank_branch,
            $participants->bank_account_number,
            $participants->bank_account_holder_name,
        ];
    }


    public function headings() :array
    {
        return ["Participant ID", "Name", "Category","Address", "LATITUDE X", "LANGITUDE Y","PIC 1", "Position 1", "Contact 1","Email 1", "PIC 2", "Position 2"
            ,"Contact 2", "Email 2", "Service Data","Area", "District", "Regency","Start Join","Source", "Source Detail", "Price","Intensity", "Payment System", "Bank", "Branch"
            , "Account Number", "Account Holder Name"];
    }

    function isExistInArray($array, $var):bool {
        return array_key_exists($var,$array);
    }

    function getListIdInArray($array, $var) {
        $sources = explode(",", $var);
        $idList = "";

        foreach ($sources as $source) {
            if ($this->isExistInArray($array, strtolower(trim($source)))) {
                $idList .= "," . $array[strtolower(trim($source))];
            }
        }

        return substr($idList,1);

    }

    function getPotentialData($date1, $date2){
        $potentialMap = [];

        $potentialTable = DB::table('participants')
            ->leftJoin('categories', function ($join) {
                $join->on('participants.id_category', '=', 'categories.id');
            })
            ->leftJoin('potentials', function ($join) {
                $join->on('participants.id_category', '=', 'categories.id');
            })
            ->select(
                DB::raw("participants.id potential_par_id"),
                DB::raw("potentials.potential_low potential_low"),
                DB::raw("potentials.potential_medium potential_medium"),
                DB::raw("potentials.potential_high potential_high"),
            );


        $dataPengangkutan = DB::table('participants')
            ->leftJoin('collections', function ($join) {
                $join->on('participants.id', '=', 'collections.id_participant');
            })
            ->leftJoinSub($potentialTable, 'potential', function ($join) {
                $join->on('participants.id', '=', 'potential.potential_par_id');
            })
            ->select(
                'participants.id as pengangkutan_par_id',
                DB::raw("COUNT(DISTINCT(MONTH(collections.collect_date))) jumlah_pengangkutan"),
                DB::raw("sum(collections.quantity) sum"),
                DB::raw("(TIMESTAMPDIFF(MONTH, '$date1', '$date2') +1) diff"),
                DB::raw("NVL(sum(collections.quantity) / (TIMESTAMPDIFF(MONTH, '$date1', '$date2') +1),0) as rata_rata"),
                DB::raw("potential.potential_low potential_low"),
                DB::raw("potential.potential_medium potential_medium"),
                DB::raw("potential.potential_high potential_high"),
            )
            ->groupBy('pengangkutan_par_id');

        $potential = DB::table('participants')
            ->joinSub($dataPengangkutan, 'pengangkutan', function ($join) {
                $join->on('participants.id', '=', 'pengangkutan.pengangkutan_par_id');
            })
            ->select(
                DB::raw("participants.id potential_par_id"),
                DB::raw("CASE WHEN rata_rata <= potential_low THEN 'LOW' WHEN rata_rata > potential_low AND rata_rata <= potential_high THEN 'MEDIUM' WHEN rata_rata > potential_high THEN 'HIGH' ELSE 'NOT_SET' END as potential_ind"),
            )
            ->orderBy('participants.id','ASC')->get();


        foreach ($potential as $pt ) {
            $potentialMap[$pt->potential_par_id] = $pt->potential_ind;
        }

        return $potentialMap;
    }


    public function columnFormats(): array
    {
        return [
            'S' => NumberFormat::FORMAT_DATE_DDMMYYYY
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }
}
