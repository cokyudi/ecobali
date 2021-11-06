<?php

namespace App\Export;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
use Carbon\Carbon;


class ActivityExport implements FromQuery, WithHeadings, WithMapping,WithColumnFormatting,ShouldAutoSize,WithStyles
{
    public $startDates;
    public $endDates;
    public $idCategory;
    public $idDistrict;
    public $idProgram;
    public $idRegency;

    public function __construct($request){
        $this->startDates = $request->startDates;
        $this->endDates = $request->endDates;
        $this->idCategory = $request->idCategory;
        $this->idDistrict = $request->idDistrict;
        $this->idProgram = $request->idProgram;
        $this->idRegency = $request->idRegency;

    }

    public function query()
    {
        $activities = DB::table('activities')
            ->leftJoin('activity_programs', function ($join) {
                $join->on('activities.id_program_activity', '=', 'activity_programs.id');
            })
            ->leftJoin('categories', function ($join) {
                $join->on('activities.id_category', '=', 'categories.id');
            })
            ->leftJoin('districts', function ($join) {
                $join->on('activities.id_district', '=', 'districts.id');
            })
            ->leftJoin('regencies', function ($join) {
                $join->on('activities.id_regency', '=', 'regencies.id');
            })
            ->select(
                'activities.activity_date',
                'activity_programs.activity_program_name',
                'activities.activity',
                'activities.location',
                'categories.category_name',
                'regencies.regency_name',
                'districts.district_name',
                'activities.participant_number',
            )
            ->orderBy('activities.id','ASC');

        if (isset($this->idCategory) && count($this->idCategory) != 0) {
            $activities = $activities->whereIn('activities.id_category', $this->idCategory);
        }

        if (isset($this->idProgram) && count($this->idProgram) != 0) {
            $activities = $activities->whereIn('activities.id_program_activity', $this->idProgram);
        }

        if (isset($this->idDistrict) && count($this->idDistrict) != 0) {
            $activities = $activities->whereIn('activities.id_district', $this->idDistrict);
        }

        if (isset($this->idRegency) && count($this->idRegency) != 0) {
            $activities = $activities->whereIn('activities.id_regency', $this->idRegency);
        }

        if (isset($this->startDates) && isset($this->endDates)) {
            $activities = $activities->whereBetween('activities.activity_date', [$this->startDates,$this->endDates]);
        }
        
        return $activities;

    }

    public function map($activities): array
    {

        return [
            Date::stringToExcel($activities->activity_date),
            strtoupper(date('(m) M', strtotime($activities->activity_date))),
            date('Y', strtotime($activities->activity_date)),
            $activities->activity_program_name,
            $activities->activity,
            $activities->location,
            $activities->category_name,
            $activities->regency_name,
            $activities->district_name,
            $activities->participant_number,
        ];
    }


    public function headings() :array
    {
        return ["Date", "Month", "Year", "Program", "Activity", "Location", "Category","Regency", "District", "Participant Number"];
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_DATE_DDMMYYYY
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
