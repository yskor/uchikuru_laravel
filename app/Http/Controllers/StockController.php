<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Base\AuthController;
use App\Http\Controllers\Base\ActionController;
use App\Models\Data\ConsumablesData;
use App\Models\Consumables;
use App\Models\Data\OfficeData;
use App\Models\Data\Table\OfficeTable;
use Illuminate\Support\Facades\Log;


class StockController extends AuthController
{
    //
    /**
     * 事業所の消耗品一覧を表示します。
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function office_stock_list(Request $request)
    {
        Log::debug(print_r($this->login, true));

        // 在庫データを取得
        $office_stock_list = ConsumablesData::getOfficeConsumablesStock();
        // dd($consumables_list);

        $data = ['office_stock_list' => $office_stock_list, 'login' => $this->login];

        return self::view($request, 'office_stock_list', $data);
    }

    /**
     * 施設の消耗品一覧を表示します。
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function facility_stock_list(Request $request)
    {
        Log::debug(print_r($this->login, true));

        // データを取得
        $facility_stock_list = ConsumablesData::getFacilityConsumablesStock();
        // dd($consumables_list);

        $data = ['facility_stock_list' => $facility_stock_list, 'login' => $this->login];

        return self::view($request, 'facility_stock_list', $data);
    }
}
