<?php


namespace App\Imports;

use App\Models\Participant;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\DB;
use DateTime;
use Illuminate\Support\Facades\Log;

class ParticipantsImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {

        $categoryMap = $this->getCategoryMap();
        $transportMap = $this->getTransportMap();
        $areaMap = $this->getAreaMap();
        $districtMap = $this->getDistrictMap();
        $regencyMap = $this->getRegencyMap();
        $boxResourceMap = $this->getBoxResourceMap();
        $purchasePriceMap = $this->getPurchasePriceMap();
        $paymentMethodMap = $this->getPaymentMethodMap();
        $bankMap = $this->getBankMap();

        foreach ($rows as $row)
        {
            if (!$this->isNullOrEmptyString($row['participant'])) {
                $categoryId = $this->getIdInArray($categoryMap, $row['category']);
                $transportId = $this->getIdInArray($transportMap, $row['intensity']);
                $areaId = $this->getIdInArray($areaMap, $row['area']);
                $districtId = $this->getIdInArray($districtMap, $row['district']);
                $regencyId = $this->getIdInArray($regencyMap, $row['regency']);
                $boxResourceId = $this->getListIdInArray($boxResourceMap, $row['source']);
                $purchasePriceId = $this->getIdInArray($purchasePriceMap, $row['price']);
                $paymentMethodId = $this->getIdInArray($paymentMethodMap, $row['payment_system']);
                $bankId = $this->getIdInArray($bankMap, $row['bank']);

                if(!$this->isNullOrEmptyString($row['start_join'])) {
                    $newDateString = $this->transformDate($row['start_join']);
                    $formatDate = $newDateString->format('Y-m-d');
                } else {
                    $formatDate = null;
                }

                Participant::create([
                    'participant_name' => $row['participant'],
                    'id_category' => $categoryId,
                    'contact_name_1' => $row['pic_1'],
                    'contact_position_1' => $row['position_1'],
                    'contact_phone_1' => $row['contact_1'],
                    'contact_email_1' => $row['email_1'],
                    'contact_name_2' => $row['pic_2'],
                    'contact_position_2' => $row['position_2'],
                    'contact_phone_2' => $row['contact_2'],
                    'contact_email_2' => $row['email_2'],
                    'joined_date' => $formatDate,
                    'id_transport_intensity' => $transportId,

                    'address' => $row['address'],
                    'latitude' => $row['latitude_x'],
                    'langitude' => $row['langitude_y'],
                    'service_area' => $row['service_area_detail'],
                    'id_area' => $areaId,
                    'id_district' => $districtId,
                    'id_regency' => $regencyId,

                    'id_box_resource' => $boxResourceId,
                    'resource_description' => $row['source_detail'],
                    'id_purchase_price' => $purchasePriceId,

                    'id_payment_method' => $paymentMethodId,
                    'id_bank' => $bankId,
                    'bank_branch' => $row['branch'],
                    'bank_account_number' => $row['account_number'],
                    'bank_account_holder_name' => $row['account_holder_name'],

                    'notes' => $row['notes'],

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

    function getCategoryMap() {
        $categories =  DB::table('categories')->pluck('category_name','id');
        $categoryMap = [];

        foreach ($categories as $id => $category_name) {
            $categoryMap[trim(strtolower($category_name))] = $id;
        }
        return $categoryMap;
    }

    function getTransportMap() {
        $transports =  DB::table('transport_intensities')->pluck('intensity','id');
        $transportMap = [];

        foreach ($transports as $id => $intensity) {
            $transportMap[trim(strtolower($intensity))] = $id;
        }
        return $transportMap;
    }

    function getAreaMap() {
        $areas =  DB::table('areas')->pluck('area_name','id');
        $areaMap = [];

        foreach ($areas as $id => $area_name) {
            $areaMap[trim(strtolower($area_name))] = $id;
        }
        return $areaMap;
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

    function getBoxResourceMap() {
        $boxResources =  DB::table('box_resources')->pluck('resource_name','id');
        $boxResourceMap = [];

        foreach ($boxResources as $id => $resource_name) {
            $boxResourceMap[trim(strtolower($resource_name))] = $id;
        }
        return $boxResourceMap;
    }

    function getPurchasePriceMap() {
        $purchasePrices =  DB::table('purchase_prices')->pluck('price','id');
        $purchasePriceMap = [];

        foreach ($purchasePrices as $id => $price) {
            $purchasePriceMap[trim(strtolower($price))] = $id;
        }
        return $purchasePriceMap;
    }

    function getPaymentMethodMap() {
        $paymentMethods =  DB::table('payment_methods')->pluck('payment_method','id');
        $paymentMethodMap = [];

        foreach ($paymentMethods as $id => $payment_method) {
            $paymentMethodMap[trim(strtolower($payment_method))] = $id;
        }
        return $paymentMethodMap;
    }

    function getBankMap() {
        $banks =  DB::table('banks')->pluck('bank_name','id');
        $bankMap = [];

        foreach ($banks as $id => $bank_name) {
            $bankMap[trim(strtolower($bank_name))] = $id;
        }
        return $bankMap;
    }


}
