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
            'office_code' => 'all',
            'consumables_category_code' => 'all' //消耗品コード

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
        // 対象事業所とアシストの消耗品在庫データを取得＊バーコードが増えた時に対応できていない
        $consumables_stock_list = ConsumablesData::viewFacilityConsumablesStockList($office_code);
        
        // カテゴリデータを全て取得
        $consumables_category_all = ConsumablesData::getConsumablesCategoryAll();
        // dd($facility_stock_list, $consumables_stock_all);
        
        $data = [
            'facility_all' => $facility_all, //全ての事業所データ
            'consumables_stock_list' => $consumables_stock_list, //対象の事業所在庫
            'consumables_category_all' => $consumables_category_all, //全てのカテゴリデータ
            'login' => $this->login,
            'office_code' => $office_code, //事業所コード
            'consumables_category_code' => 'all' //消耗品コード

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
    public function facility_category_stock_list($office_code, $consumables_category_code, Request $request)
    {
        Log::debug(print_r($this->login, true));

        // 消耗品カテゴリデータを取得
        $consumables_category_all = ConsumablesData::getConsumablesCategoryAll();
        // 対象の消耗品データを取得＊バーコードが増えた時に対応できていない
        $consumables_stock_list = ConsumablesData::viewFacilityCategoryConsumablesStockList($office_code, $consumables_category_code);

        // 事業所マスタから事業所を全て参照
        $facility_all = OfficeData::viewfacilityAll();


        // カテゴリデータを全て取得
        $consumables_category_all = ConsumablesData::getConsumablesCategoryAll();
        
        $data = [
            'facility_all' => $facility_all, //全ての事業所データ
            'consumables_category_all' => $consumables_category_all,
            'consumables_stock_list' => $consumables_stock_list,
            'login' => $this->login,
            'office_code' => $office_code, //施設コード
            'consumables_category_code' => $consumables_category_code //消耗品コード
        ];
            
            return self::view($request, 'facility_stock_list_category', $data);
    }
}
