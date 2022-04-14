<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Base\AuthController;
use App\Http\Controllers\Base\ActionController;
use App\Models\Data\ConsumablesData;
use App\Models\Consumables;
use App\Models\Data\OfficeData;
use App\Models\Data\Table\ConsumablesTable;
use App\Models\Data\Table\OfficeTable;
use Illuminate\Support\Facades\Log;


class StockController extends AuthController
{
    //
    /**
     * 消耗品在庫一覧を表示します。
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function stock_list(Request $request)
    {
        Log::debug(print_r($this->login, true));

        // 消耗品カテゴリデータを取得
        $consumables_category_all = ConsumablesData::getConsumablesCategoryAll();

        // 事業所マスタから事業所を全て参照
        $facility_all = OfficeData::viewfacilityAll();
        // dd($Office_all);
        // 消耗品在庫テーブルを参照
        // $consumables_stock_all = ConsumablesData::viewOfficeConsumablesStockAll();
 
        $data = [
            'facility_all' => $facility_all,
            // 'consumables_all' => $consumables_all,
            'consumables_category_all' => $consumables_category_all,
            'login' => $this->login,
            'consumables_category_code' => 'all'
        ];
        
        return self::view($request, 'stock_list', $data);
    }

    //
    /**
     * 事業所別の消耗品一覧を表示します。
     * @param int $consumables_category_code
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function facility_stock_list($office_code, Request $request)
    {
        Log::debug(print_r($this->login, true));

        // 消耗品カテゴリデータを取得
        $consumables_category_all = ConsumablesData::getConsumablesCategoryAll();
        // 事業所マスタから事業所を全て参照
        $facility_all = OfficeData::viewfacilityAll();
        // 対象の消耗品データを取得＊バーコードが増えた時に対応できていない
        $consumables_all = ConsumablesData::viewFacilityConsumablesStockList($office_code);
        
        // カテゴリデータを全て取得
        $consumables_category_all = ConsumablesData::getConsumablesCategoryAll();
        // dd($facility_stock_list, $consumables_stock_all);
        
        $data = [
            'facility_all' => $facility_all,
            'consumables_all' => $consumables_all,
            'consumables_category_all' => $consumables_category_all,
            'login' => $this->login,
            'office_code' => $office_code
        ];
        // dd($data);
        return self::view($request, 'facility_stock_list', $data);
    }
        

    //
    /**
     * 事業所の消耗品一覧を表示します。
     * @param int $consumables_category_code
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function facility_stock_list_category($consumables_category_code, Request $request)
    {
        Log::debug(print_r($this->login, true));

        // 消耗品カテゴリデータを取得
        $consumables_category_all = ConsumablesData::getConsumablesCategoryAll();
        // 対象の消耗品データを取得＊バーコードが増えた時に対応できていない
        $category_consumables_all = ConsumablesData::getCategoryConsumablesList($consumables_category_code);

        // 事業所マスタから事業所を全て参照
        $facility_all = OfficeData::viewOfficeAll();
        // dd($facility_all);
        // 消耗品在庫テーブルを参照
        $consumables_stock_all = ConsumablesData::viewFacilityConsumablesStockAll();

        $facility_stock_list = array();

        // 事業所ごとにデータを配列に格納
        // foreach ($facility_all as $facility) {
        //     $facility_stock = ConsumablesData::viewThisFacilityConsumablesStockAll($facility->facility_name);
        //     if ($facility_stock == []) {
        //         $facility_stock == "";
        //     }
        //     $facility_stock_list[$facility->facility_name] = $facility_stock;
        // }
        // $test = $facility_stock_list['高岡'];

        // カテゴリデータを全て取得
        $consumables_category_all = ConsumablesData::getConsumablesCategoryAll();
        // dd($facility_stock_list, $consumables_stock_all);
        
        $data = [
            'facility_stock_list' => $facility_stock_list,
            'facility_all' => $facility_all,
            'consumables_stock_all' => $consumables_stock_all,
            'consumables_category_all' => $consumables_category_all,
            'category_consumables_all' => $category_consumables_all,
            'login' => $this->login,
            'consumables_category_code' => $consumables_category_code
        ];
            
            return self::view($request, 'facility_stock_list_category', $data);
    }
}
