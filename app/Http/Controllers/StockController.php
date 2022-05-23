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
use PhpOption\None;

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
        $consumables_category_all = ConsumablesData::viewConsumablesCategoryAll();

        // 事業所マスタから事業所を全て参照
        $facility_all = OfficeData::viewfacilityAll();
        // dd($Office_all);
        // 消耗品在庫テーブルを参照
        // $consumables_stock_all = ConsumablesData::viewOfficeConsumablesStockAll();

        $data = [
            'facility_all' => $facility_all,
            // 'consumables_all' => $consumables_all,
            'consumables_category_all' => $consumables_category_all,
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
        $consumables_category_all = ConsumablesData::viewConsumablesCategoryAll();
        // 事業所マスタから事業所を全て参照
        $facility_all = OfficeData::viewfacilityAll();
        // 対象事業所とアシストの消耗品在庫データを取得
        $consumables_stock_list = ConsumablesData::viewFacilityConsumablesStockList($office_code);
        // 事業所データ
        $office_data = OfficeData::getOffice($office_code);

        $data = [
            'facility_all' => $facility_all, //全ての事業所データ
            'consumables_stock_list' => $consumables_stock_list, //対象の事業所在庫
            'consumables_category_all' => $consumables_category_all, //全てのカテゴリデータ
            'office_code' => $office_code, //事業所コード
            'office_data' => $office_data, //事業所データ
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
        $consumables_category_all = ConsumablesData::viewConsumablesCategoryAll();
        // 対象の消耗品データを取得
        $consumables_stock_list = ConsumablesData::viewFacilityCategoryConsumablesStockList($office_code, $consumables_category_code, Null);

        // 事業所マスタから事業所を全て参照
        $facility_all = OfficeData::viewfacilityAll();
        // 事業所データ
        $office_data = OfficeData::getOffice($office_code);

        $data = [
            'facility_all' => $facility_all, //全ての事業所データ
            'consumables_category_all' => $consumables_category_all,
            'consumables_stock_list' => $consumables_stock_list,
            'office_code' => $office_code, //施設コード
            'office_data' => $office_data, //事業所データ
            'consumables_category_code' => $consumables_category_code, //消耗品コード
            'search_name' => '',
        ];

        return self::view($request, 'facility_stock_list_category', $data);
    }

    //
    /**
     * 事業所の消耗品検索結果を表示します。
     * @param int $consumables_category_code
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function facility_category_stock_list_search($office_code, $consumables_category_code, Request $request)
    {
        Log::debug(print_r($this->login, true));
        $search_name = $request->keyword;

        // 消耗品カテゴリデータを参照
        $consumables_category_all = ConsumablesData::viewConsumablesCategoryAll();
        // キーワードに一致するの消耗品データを参照
        $consumables_stock_list = ConsumablesData::viewConsumablesStockSearchData($consumables_category_code, $office_code, $search_name);

        // 事業所マスタから事業所を全て参照
        $facility_all = OfficeData::viewfacilityAll();
        // 事業所データ
        $office_data = OfficeData::getOffice($office_code);

        $data = [
            'facility_all' => $facility_all, //全ての事業所データ
            'consumables_category_all' => $consumables_category_all,
            'consumables_stock_list' => $consumables_stock_list,
            'office_code' => $office_code, //施設コード
            'office_data' => $office_data, //事業所データ
            'consumables_category_code' => $consumables_category_code, //消耗品種別コード
            'search_name' => $search_name,
        ];

        return self::view($request, 'facility_stock_list_category_search', $data);
    }

    //
    /**
     * 事業所の消耗品一覧を表示します。
     * @param int $consumables_category_code
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function stock_list_mobile($office_code, $consumables_category_code, Request $request)
    {
        Log::debug(print_r($this->login, true));

        // 消耗品カテゴリデータを取得
        $consumables_category_all = ConsumablesData::viewConsumablesCategoryAll();
        // 対象の消耗品データを取得
        $consumables_stock_list = ConsumablesData::viewFacilityCategoryConsumablesStockList($office_code, $consumables_category_code, Null);

        // 事業所データ
        $office_data = OfficeData::getOffice($office_code);

        $data = [
            'consumables_category_all' => $consumables_category_all,
            'consumables_stock_list' => $consumables_stock_list,
            'office_code' => $office_code, //施設コード
            'office_data' => $office_data, //事業所データ
            'consumables_category_code' => $consumables_category_code //消耗品コード
        ];

        return self::view($request, 'stock_list_mobile', $data);
    }

    //
    /**
     * 在庫不足の消耗品を表示
     * @param int $consumables_category_code
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function shortage_consumables($office_code, $consumables_category_code, $consumables_code, Request $request)
    {
        // 消耗品カテゴリデータを取得
        $consumables_category_all = ConsumablesData::viewConsumablesCategoryAll();
        // 対象の消耗品データを取得
        $shortage_consumables = ConsumablesData::viewFacilityCategoryConsumablesStockList($office_code, $consumables_code, $consumables_code);

        // 事業所マスタから事業所を全て参照
        $facility_all = OfficeData::viewfacilityAll();
        // 事業所データ
        $office_data = OfficeData::getOffice($office_code);

        $data = [
            'consumables_category_all' => $consumables_category_all,
            'facility_all' => $facility_all,
            'shortage_consumables' => $shortage_consumables,
            'office_code' => $office_code, //施設コード
            'office_data' => $office_data, //事業所データ
            'consumables_category_code' => $consumables_category_code, //消耗品カテゴリコード
            'consumables_code' => $consumables_code, //消耗品コード
        ];

        return self::view($request, 'shortage_consumables', $data);
    }

    //
    /**
     * 在庫調整
     * @param int $consumables_category_code
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function stock_adjustment($office_code, $consumables_category_code, $consumables_code, Request $request)
    {
        $facility_stock_number = $request->get('facility_stock_number'); //施設在庫個数
        if($request->filled('facility_stock_quantity')) {
            $facility_stock_quantity = $request->get('facility_stock_quantity'); //施設在庫入数
        } else {
            // 'facility_stock_quantity'が無ければ0個
            $facility_stock_quantity = 0; //施設在庫入数
        }
        $stock_number = $request->get('stock_number'); //本部在庫個数
        $stock_quantity = 0; //施設在庫入数は0
        $head_office_code = 91; //当面はアシスト固定

        // 在庫調整（施設）
        Consumables::stock_consumables_adjustment(
            $office_code, //事業所コード
            $consumables_code, //消耗品コード
            $facility_stock_number,
            $facility_stock_quantity,
        );
        
        // 本部（施設）
        Consumables::stock_consumables_adjustment(
            $head_office_code, //アシスト事業所コード
            $consumables_code, //消耗品コード
            $stock_number,
            $stock_quantity,
        );

        // 消耗品カテゴリデータを取得
        $consumables_category_all = ConsumablesData::viewConsumablesCategoryAll();
        // 対象の消耗品データを取得
        $consumables_stock_list = ConsumablesData::viewFacilityCategoryConsumablesStockList($office_code, $consumables_category_code, Null);
        // 事業所マスタから事業所を全て参照
        $facility_all = OfficeData::viewfacilityAll();
        // 事業所データ
        $office_data = OfficeData::getOffice($office_code);

        $data = [
            'consumables_category_all' => $consumables_category_all,
            'facility_all' => $facility_all,
            'consumables_stock_list' => $consumables_stock_list,
            'office_code' => $office_code, //施設コード
            'office_data' => $office_data, //事業所データ
            'consumables_category_code' => $consumables_category_code, //消耗品カテゴリコード
            'consumables_code' => $consumables_code, //消耗品コード
            'search_name' => '',
        ];

        $consumables = ConsumablesData::viewOneConsumables($consumables_code);
        session()->flash('message', $consumables->consumables_name . 'の在庫を調整しました');

        return self::view($request, 'facility_stock_list_category', $data);
    }
}
