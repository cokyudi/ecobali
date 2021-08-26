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
use Carbon\Carbon;


class SalesExport implements FromQuery, WithHeadings, WithMapping,WithColumnFormatting,ShouldAutoSize,WithStyles
{

    public function query()
    {
        $sales = DB::table('sales')
            ->leftJoin('papermills', function ($join) {
                $join->on('sales.id_papermill', '=', 'papermills.id');
            })
            ->select(
                'sales.sale_date',
                'sales.collected_d_min_1',
                'sales.delivered_to_papermill',
                'sales.weighing_scale_gap_eco',
                'sales.weighing_scale_gap_eco_percent',
                'papermills.papermill_name',
                'sales.received_at_papermill',
                'sales.weighing_scale_gap_papermill',
                'sales.weighing_scale_gap_papermill_percent',
                'sales.moisture_content_and_contaminant',
                'sales.moisture_content_and_contaminant_percent',
                'sales.deduction',
                'sales.deduction_percent',
                'sales.total_weight_accepted',
            )
            ->orderBy('sales.sale_date','DESC');
        return $sales;

    }

    public function map($sales): array
    {
        return [
            Date::stringToExcel($sales->sale_date),
            strtoupper(date('(m) M', strtotime($sales->sale_date))),
            'Q'.ceil(date("n", strtotime($sales->sale_date))/3),
            date('Y', strtotime($sales->sale_date)),
            $sales->collected_d_min_1,
            $sales->delivered_to_papermill,
            $sales->weighing_scale_gap_eco,
            $sales->weighing_scale_gap_eco_percent,
            $sales->papermill_name,
            $sales->received_at_papermill,
            $sales->weighing_scale_gap_papermill,
            $sales->weighing_scale_gap_papermill_percent,
            $sales->moisture_content_and_contaminant,
            $sales->moisture_content_and_contaminant_percent,
            $sales->deduction,
            $sales->deduction_percent,
            $sales->total_weight_accepted,
        ];
    }

    public function headings() :array
    {
        return ["Date", "Month", "Quartal","Year", "Collected D-1 Sell (Kg)", "Delivered to Papermill (Kg)","Weighing scale Gap ecoBali (Kg)", "Weighing scale Gap ecoBali (%)", "Papermill","Received at Papermill (Kg)", "Weighing scale Gap papermill (Kg)", "Weighing scale Gap papermill (%)"
            ,"Moisture Content and Contaminant (Kg)", "Moisture Content and Contaminant  (%)", "Total Gap / Deduction (Kg)","Total Gap / Deduction (%)", "Total Weight Accepted (Kg)"];
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
