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
        $wheres = [
            'operation_type_code' => $this->login->operation_type_code,
        ];
        // 消耗品カテゴリデータを取得
        $consumables_category_list = ConsumablesData::getConsumablesCategoryList($wheres);

        // 事業所マスタから事業所を全て参照
        $facility_list = OfficeData::getfacilityAll();
        if ($this->login->operation_type_code == 'LABO') {
            $office_code = 90;
            $consumables_category_code = 9;
        } else {
            $office_code = 91;
            $consumables_category_code = 1;
        }

        $data = [
            'facility_list' => $facility_list,
            'consumables_category_list' => $consumables_category_list,
            'office_code' => $office_code,
            'consumables_category_code' => $consumables_category_code //消耗品コード
        ];

        return self::view($request, 'stock_list', $data);
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
        $wheres = [
            'operation_type_code' => $this->login->operation_type_code,
            'office_code' => $office_code,
            'consumables_category_code' => $consumables_category_code,
        ];
        // 消耗品カテゴリデータを取得
        $consumables_category_list = ConsumablesData::getConsumablesCategoryList($wheres);
        // 対象の消耗品データを取得
        $consumables_stock_list = ConsumablesData::viewFacilityCategoryConsumablesStockList($office_code, $consumables_category_code, Null, $this->login->office_code);
        // dd($consumables_stock_list);
        // 事業所マスタから事業所を全て参照
        $facility_list = OfficeData::getfacilityAll();
        // 事業所データ
        $office_data = OfficeData::getOffice($office_code);

        $data = [
            'facility_list' => $facility_list, //全ての事業所データ
            'consumables_category_list' => $consumables_category_list,
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
        $facility_list = OfficeData::getfacilityAll();
        // 事業所データ
        $office_data = OfficeData::getOffice($office_code);

        $data = [
            'facility_list' => $facility_list, //全ての事業所データ
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
     * 在庫不足の消耗品を表示
     * @param int $consumables_category_code
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function shortage_consumables(Request $request)
    {
        $facility_list = OfficeData::getfacilityAll();
        // 在庫不足の消耗品データを取得
        $shortage_list = ConsumablesData::viewConsumablesStockShortageAll($this->login->operation_type_code);
        // dd($shortage_list);
        $data = [
            'facility_list' => $facility_list,
            'shortage_list' => $shortage_list,
            'login' => $this->login,
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
        // $facility_stock_number = $request->get('facility_stock_number'); //施設在庫個数
        // if($request->filled('facility_stock_quantity')) {
        //     $facility_stock_quantity = $request->get('facility_stock_quantity'); //施設在庫入数
        // } else {
        //     // 'facility_stock_quantity'が無ければ0個
        //     $facility_stock_quantity = 0; //施設在庫入数
        // }
        $stock_number = $request->get('stock_number'); //本部在庫個数
        $stock_quantity = 0; //施設在庫入数は0
        if ($this->login->operation_type_code == 'LABO') {
            $office_code = $office_code;
        } else {
            $office_code = 91; //LABO職員以外はアシストでのみ在庫調整可
        }

        Consumables::stock_consumables_adjustment(
            $office_code, //事業所コード
            $consumables_code, //消耗品コード
            $stock_number,
            $stock_quantity,
            $this->login->staff_code,
        );

        $consumables = ConsumablesData::getConsumables($consumables_code);
        session()->flash('success_message', $consumables->consumables_name . 'の在庫を調整しました');

        return redirect()->route('facility_category_stock_list', ['office_code' => $office_code, 'consumables_category_code' => $consumables_category_code]);
    }
}
