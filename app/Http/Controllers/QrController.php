<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Base\AuthController;
use App\Http\Controllers\Base\ActionController;
use App\Models\Data\ConsumablesData;
use App\Models\Consumables;
use Illuminate\Support\Facades\Log;
use App\Models\Data\BaseData;
use App\Models\Data\OfficeData;
use App\Models\Data\Table\ConsumablesTable;
use Exception;

class QrController extends AuthController
{


    /**
     * 施設QRコード一覧
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function facility_qr_list(Request $request)
    {
        Log::debug(print_r($this->login, true));
        $facility_list = OfficeData::viewFacilityAll();

        $data = [
            'facility_list' => $facility_list,
        ];

        return self::view($request, 'facility_qr_list', $data);
    }
}
