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


class ParticipantExport implements FromQuery, WithHeadings, WithMapping,WithColumnFormatting,ShouldAutoSize,WithStyles
{

    public function query()
    {
        $participants = DB::table('participants')
            ->leftJoin('categories', function ($join) {
                $join->on('participants.id_category', '=', 'categories.id');
            })
            ->leftJoin('transport_intensities', function ($join) {
                $join->on('participants.id_transport_intensity', '=', 'transport_intensities.id');
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
            ->leftJoin('box_resources', function ($join) {
                $join->on('participants.id_box_resource', '=', 'box_resources.id');
            })
            ->leftJoin('purchase_prices', function ($join) {
                $join->on('participants.id_purchase_price', '=', 'purchase_prices.id');
            })
            ->leftJoin('payment_methods', function ($join) {
                $join->on('participants.id_payment_method', '=', 'payment_methods.id');
            })
            ->leftJoin('banks', function ($join) {
                $join->on('participants.id_bank', '=', 'banks.id');
            })
            ->select(
                'participants.id',
                'participants.participant_name',
                'categories.category_name',
                'participants.address',
                'participants.latitude',
                'participants.langitude',
                'participants.contact_name_1',
                'participants.contact_position_1',
                'participants.contact_phone_1',
                'participants.contact_email_1',
                'participants.contact_name_2',
                'participants.contact_position_2',
                'participants.contact_phone_2',
                'participants.contact_email_2',
                'participants.service_area',
                'areas.area_name',
                'districts.district_name',
                'regencies.regency_name',
                'participants.joined_date',
                'participants.id_box_resource',
                'participants.resource_description',
                'purchase_prices.price',
                'transport_intensities.intensity',
                'payment_methods.payment_method',
                'banks.bank_name',
                'participants.bank_branch',
                'participants.bank_account_number',
                'participants.bank_account_holder_name',
            )
            ->orderBy('participants.id','DESC');
        return $participants;

    }
    /*
    public function collection()
    {
        $participants = DB::table('participants')
            ->leftJoin('categories', function ($join) {
                $join->on('participants.id_category', '=', 'categories.id');
            })
            ->leftJoin('transport_intensities', function ($join) {
                $join->on('participants.id_transport_intensity', '=', 'transport_intensities.id');
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
            ->leftJoin('box_resources', function ($join) {
                $join->on('participants.id_box_resource', '=', 'box_resources.id');
            })
            ->leftJoin('purchase_prices', function ($join) {
                $join->on('participants.id_purchase_price', '=', 'purchase_prices.id');
            })
            ->leftJoin('payment_methods', function ($join) {
                $join->on('participants.id_payment_method', '=', 'payment_methods.id');
            })
            ->leftJoin('banks', function ($join) {
                $join->on('participants.id_bank', '=', 'banks.id');
            })
            ->select(
                'participants.id',
                'participants.participant_name',
                'categories.category_name',
                'participants.address',
                'participants.latitude',
                'participants.langitude',
                'participants.contact_name_1',
                'participants.contact_position_1',
                'participants.contact_phone_1',
                'participants.contact_email_1',
                'participants.contact_name_2',
                'participants.contact_position_2',
                'participants.contact_phone_2',
                'participants.contact_email_2',
                'participants.service_area',
                'areas.area_name',
                'districts.district_name',
                'regencies.regency_name',
                'participants.joined_date',
                'participants.id_box_resource',
                'participants.resource_description',
                'purchase_prices.price',
                'transport_intensities.intensity',
                'payment_methods.payment_method',
                'banks.bank_name',
                'participants.bank_branch',
                'participants.bank_account_number',
                'participants.bank_account_holder_name',
            )
            ->where('participants.id','=','1')
            ->get();
        return $participants;
    }
    */

    public function map($participants): array
    {
        $boxResourceMap = $this->getBoxResourceMap();
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

//    public function headings() :array
//    {
//        return ["Participant ID", "Name","Join Date"];
//    }

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

    function getBoxResourceMap() {
        $boxResources =  DB::table('box_resources')->pluck('id','resource_name');
        $boxResourceMap = [];

        foreach ($boxResources as $id => $resource_name) {
            $boxResourceMap[trim(strtolower($resource_name))] = $id;
        }
        return $boxResourceMap;
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
