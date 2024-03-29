<?php

namespace App\Export;

use App\Models\Participant;
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


class CollectionExport implements FromQuery, WithHeadings, WithMapping,WithColumnFormatting,ShouldAutoSize,WithStyles
{
    public $categoryMap;
    public $categoryMapYear;
    public $startDates;
    public $endDates;
    public $idCategory;
    public $idDistrict;
    public $idParticipant;
    public $idRegency;

    public function __construct($request){
        $this->categoryMap = $this->getTargetMap();
        $this->categoryMapYear = $this->getTargetMapYearly();

        $this->startDates = $request->startDates;
        $this->endDates = $request->endDates;
        $this->idCategory = $request->idCategory;
        $this->idDistrict = $request->idDistrict;
        $this->idParticipant = $request->idParticipant;
        $this->idRegency = $request->idRegency;

    }

    public function query()
    {
        $collections = DB::table('collections')
            ->leftJoin('participants', function ($join) {
                $join->on('collections.id_participant', '=', 'participants.id');
            })
            ->leftJoin('categories', function ($join) {
                $join->on('participants.id_category', '=', 'categories.id');
            })
            ->leftJoin('districts', function ($join) {
                $join->on('participants.id_district', '=', 'districts.id');
            })
            ->leftJoin('regencies', function ($join) {
                $join->on('participants.id_regency', '=', 'regencies.id');
            })
            ->select(
                'collections.collect_date',
                DB::raw('FLOOR((DAYOFMONTH(collections.collect_date) - 1) / 7) + 1 week_of_month'),
                'participants.id as id_participant',
                'participants.participant_name',
                'categories.id as id_category',
                'categories.category_name',
                'regencies.id as regency_id',
                'regencies.regency_name',
                'districts.id as district_id',
                'districts.district_name',
                'collections.quantity',
            )
            ->orderBy('collections.id','ASC');


        if (isset($this->idCategory) && count($this->idCategory) != 0) {
            $collections = $collections->whereIn('id_category', $this->idCategory);
        }

        if (isset($this->idParticipant) && count($this->idParticipant) != 0) {
            $collections = $collections->whereIn('id_participant', $this->idParticipant);
        }

        if (isset($this->idDistrict) && count($this->idDistrict) != 0) {
            $collections = $collections->whereIn('district_id', $this->idDistrict);
        }

        if (isset($this->idRegency) && count($this->idRegency) != 0) {
            $collections = $collections->whereIn('regency_id', $this->idRegency);
        }

        if (isset($this->startDates) && isset($this->endDates)) {
            $collections = $collections->whereBetween('collect_date', [$this->startDates,$this->endDates]);
        }

        return $collections;

    }

    public function map($collections): array
    {
        return [
            Date::stringToExcel($collections->collect_date),
            $collections->week_of_month,
            'Q'.ceil(date("n", strtotime($collections->collect_date))/3),
            date('d', strtotime($collections->collect_date)),
            strtoupper(date('(m) M', strtotime($collections->collect_date))),
            date('Y', strtotime($collections->collect_date)),

            $collections->participant_name,
            $collections->category_name,
            $collections->regency_name,
            $collections->district_name,
            $collections->quantity,
            $this->getMonthlyTargetForAllCategory(date('m', strtotime($collections->collect_date)),date('Y', strtotime($collections->collect_date)),$collections->id_category,$this->categoryMap),
            $this->getYearlyTargetForAllCategory(date('Y', strtotime($collections->collect_date)),$collections->id_category,$this->categoryMapYear),

        ];
    }

    function getTargetMap(){
        $categories = DB::table('categories')
            ->leftJoin('category_details', function ($join) {
                $join->on('categories.id', '=', 'category_details.category_id');
            })
            ->select(
                'categories.id',
                'categories.category_name',
                'category_details.year',
                'category_details.semester_1_target',
                'category_details.semester_2_target',
            )
            ->get();

        $categoryMap = [];
        foreach ($categories as $category) {
            $categoryMap[$category->year.'-'.$category->id] = array(
                "semester_1_target"=>round($category->semester_1_target/6,1),
                "semester_2_target"=>round($category->semester_2_target/6,1),
            );

        }

        return $categoryMap;
    }

     function getMonthlyTargetForAllCategory($month, $year, $categoryId, $categoryMap ) {
        $totalTarget = 0;

        if ($month < 7) {
            $totalTarget += $categoryMap[$year."-".$categoryId]['semester_1_target'];
        } else {
            $totalTarget += $categoryMap[$year."-".$categoryId]['semester_2_target'];
        }

        return round($totalTarget,1);
    }

    function getTargetMapYearly(){
        $categories = DB::table('categories')
            ->leftJoin('category_details', function ($join) {
                $join->on('categories.id', '=', 'category_details.category_id');
            })
            ->select(
                'categories.id',
                'categories.category_name',
                'category_details.year',
                'category_details.semester_1_target',
                'category_details.semester_2_target',
            )
            ->get();

        $categoryMapYear = [];
        foreach ($categories as $category) {
            $categoryMapYear[$category->year.'-'.$category->id] = array(
                "target"=>round($category->semester_1_target,1)+round($category->semester_2_target,1),
            );

        }

        return $categoryMapYear;
    }

    function getYearlyTargetForAllCategory($year, $categoryId, $categoryMapYear ) {
        $totalTarget = 0;
        $totalTarget += $categoryMapYear[$year."-".$categoryId]['target'];

        return round($totalTarget,1);
    }

    public function headings() :array
    {
        return ["Date", "Week","Quartal", "Date","Month", "Year", "Participant", "Category","Regency", "District", "∑ KMK (Kg)","Monthly Target", "Yearly Target"];
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
