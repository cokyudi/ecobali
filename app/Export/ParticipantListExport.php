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

    public $idStatus;
    public $idContinuity;
    public $idPotential;
    public $idParticipant;
    public $idCategory;
    public $idDistrict;
    public $idRegency;
    public $startDates;
    public $endDates;

    public function __construct($request) {
        $this->idStatus = $request->idStatus;
        $this->idContinuity = $request->idContinuity;
        $this->idPotential = $request->idPotential;
        $this->idParticipant = $request->idParticipant;
        $this->idDistrict = $request->idDistrict;
        $this->idRegency = $request->idRegency;
        $this->idCategory = $request->idCategory;
        $this->startDates = $request->startDates;
        $this->endDates = $request->endDates;
    }

    public function query()
    {
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
                DB::raw("NVL(sum(collections.quantity) / (TIMESTAMPDIFF(MONTH, '$this->startDates', '$this->endDates') +1),0) as rata_rata"),
                DB::raw("potential.potential_low potential_low"),
                DB::raw("potential.potential_medium potential_medium"),
                DB::raw("potential.potential_high potential_high"),
            )
            ->groupBy('pengangkutan_par_id');

        $collection_continuity = DB::table('collections')
            ->whereBetween('collections.collect_date', [$this->startDates, $this->endDates])
            ->select(
                "collections.id_participant",
                DB::raw('COUNT(DISTINCT (MONTH(collect_date))) month_count'),
            )
            ->groupBy('id_participant')
            ->orderByRaw("CONVERT(id_participant, SIGNED) asc");


        $continuity = DB::table('participants')
            ->leftJoinSub($collection_continuity, 'con', function ($join) {
                $join->on('participants.id', '=', 'con.id_participant');
            })
            ->select(
                "participants.id as participant_id_continuity",
                DB::raw("NVL((con.month_count / (TIMESTAMPDIFF(MONTH, '$this->startDates', '$this->endDates') +1))*100,0) as persen")
            )
            ->orderBy("participant_id_continuity","ASC");

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
            ->leftJoinSub($continuity, 'continuity', function ($join) {
                $join->on('participants.id', '=', 'continuity.participant_id_continuity');
            })
            ->leftJoinSub($dataPengangkutan, 'pengangkutan', function ($join) {
                $join->on('participants.id', '=', 'pengangkutan.pengangkutan_par_id');
            })
            ->select(
                'participants.id',
                'participants.participant_name',
                'districts.district_name',
                'regencies.regency_name',
                'categories.category_name',
                DB::raw('CASE WHEN MAX(collect_date) >= CURDATE() - INTERVAL 3 MONTH THEN "Active" ELSE "Inactive" END status'),
                DB::raw('ROUND(SUM(collections.quantity),1) qty'),
                DB::raw('COUNT(collections.id) col_freq'),
                DB::raw('COUNT(DISTINCT (MONTH(collect_date))) month_freq'),
                DB::raw("CASE WHEN continuity.persen <= 0 THEN 'None' WHEN continuity.persen > 0 AND continuity.persen <= 50 THEN 'Less Stable' WHEN continuity.persen > 50 AND continuity.persen < 100 THEN 'Medium' WHEN continuity.persen = 100 THEN 'Stable' ELSE 'No Data' END as continuity_ind"),
                DB::raw("CASE WHEN rata_rata <= potential_low THEN 'Low' WHEN rata_rata > potential_low AND rata_rata <= potential_high THEN 'Medium' WHEN rata_rata > potential_high THEN 'High' ELSE 'Not Set' END as potential_ind"),
                DB::raw('DATE_FORMAT(MAX(collect_date), "%d/%m/%Y") lastSubmit'),
                DB::raw('DATE_FORMAT(participants.joined_date, "%d/%m/%Y") joined_date'),
            )
            ->groupBy('id','participant_name','joined_date','category_name','regency_name','rata_rata','potential_low','potential_high','district_name')
            ->orderBy('participant_name','ASC');

        if (isset($this->idCategory) && count($this->idCategory) != 0) {
            $participants = $participants->whereIn('categories.id', $this->idCategory);
        }

        if (isset($this->idParticipant) && count($this->idParticipant) != 0) {
            $participants = $participants->whereIn('participants.id', $this->idParticipant);
        }

        if (isset($this->idArea) && count($this->idArea) != 0) {
            $participants = $participants->whereIn('areas.id', $this->idArea);
        }

        if (isset($this->idDistrict) && count($this->idDistrict) != 0) {
            $participants = $participants->whereIn('districts.id', $this->idDistrict);
        }

        if (isset($this->idRegency) && count($this->idRegency) != 0) {
            $participants = $participants->whereIn('regencies.id', $this->idRegency);
        }

        if (isset($this->idStatus) && $this->idStatus > 0) {
            if($this->idStatus == 1) {
                $participants = $participants->having('status', '=',"ACTIVE");
            } else {
                $participants = $participants->having('status', '=','INACTIVE');
            }
        }

        if (isset($this->idContinuity) && $this->idContinuity > 0) {
            if($this->idContinuity == 1) {
                $participants = $participants->having('continuity_ind', '=',"NONE");
            } else if ($this->idContinuity == 2){
                $participants = $participants->having('continuity_ind', '=','LESS_STABLE');
            } else if ($this->idContinuity == 3){
                $participants = $participants->having('continuity_ind', '=','MEDIUM');
            } else if ($this->idContinuity == 4){
                $participants = $participants->having('continuity_ind', '=','STABLE');
            }
        }

        if (isset($this->idPotential) && $this->idPotential > 0) {
            if($this->idPotential == 1) {
                $participants = $participants->having('potential_ind', '=',"LOW");
            } else if ($this->idPotential == 2){
                $participants = $participants->having('potential_ind', '=','MEDIUM');
            } else if ($this->idPotential == 3) {
                $participants = $participants->having('potential_ind', '=', 'HIGH');
            }
        }

        if($this->startDates == '2021-01-01' && $this->endDates == date("Y-m-d")) {

        } else {
            $participants = $participants->whereBetween('collections.collect_date', [$this->startDates,$this->endDates]);
        }

        return $participants;

    }

    public function map($participants): array
    {
        return [
            $participants->id,
            $participants->participant_name,
            $participants->district_name,
            $participants->regency_name,
            $participants->category_name,
            $participants->status,
            $participants->qty,
            $participants->col_freq,
            $participants->month_freq,
            $participants->qty > 0 ? number_format($participants->qty/$participants->col_freq, 1, '.', ""): '',
            $participants->qty > 0 ? number_format($participants->qty/$participants->month_freq, 1, '.', ""): '',
            $participants->continuity_ind,
            $participants->potential_ind,
            $participants->lastSubmit,
            $participants->joined_date,
        ];
    }


    public function headings() :array
    {
        return ["Participant ID", "Name", "District","Regency", "Category", "Status","Total UBC (Kg)", "Collection Frequently (Times)", "Collection Frequently (Month)","Average per Collection (Kg/Collection)",
            "Average per Month (Kg/Month)", "Collection Continuity","Potential", "Last Submit", "Joined Date"];
    }

    public function columnFormats(): array
    {
        return [
            'N' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'O' => NumberFormat::FORMAT_DATE_DDMMYYYY
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
