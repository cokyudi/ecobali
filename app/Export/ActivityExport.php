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
