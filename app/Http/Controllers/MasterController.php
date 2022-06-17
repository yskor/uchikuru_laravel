<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Base\AuthController;
use App\Http\Controllers\Base\ActionController;
use App\Models\Data\ConsumablesData;
use App\Models\Consumables;
use Illuminate\Support\Facades\Log;
use App\Models\Data\BaseData;
use App\Models\Data\Table\ConsumablesTable;
use Exception;

class MasterController extends AuthController
{

    //
    /**
     * カテゴリに絞った消耗品一覧表示
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function master_list_category($consumables_category_code, Request $request)
    {
        $wheres = [
            'consumables_category_code' => $consumables_category_code,
            'operation_type_code' => $this->login->operation_type_code,
            'unit_code' => 'N',
        ];
        
        // カテゴリデータを全て取得
        $consumables_category_list = ConsumablesData::getConsumablesCategoryList($wheres);
        // 対象のカテゴリデータを取得
        $consumables_list = ConsumablesData::getConsumablesIdList($wheres);

        $data = [
            'consumables_category_list' => $consumables_category_list,
            'consumables_list' => $consumables_list,
            'consumables_category_code' => $consumables_category_code,
            'search_name' => '',
        ];

        return self::view($request, 'master_list', $data);
    }
   
    //
    /**
     * カテゴリに絞った消耗品一覧表示
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function master_list_search($consumables_category_code, Request $request)
    {
        $search_name = $request->keyword; //検索キーワード
        $wheres = [
            'consumables_category_code' => $consumables_category_code,
            'operation_type_code' => $this->login->operation_type_code,
        ];
        
        // カテゴリデータを全て取得
        $consumables_category_list = ConsumablesData::getConsumablesCategoryList($wheres);
        // 対象の消耗品を取得
        $consumables_list = ConsumablesData::viewCategoryConsumablesSearchList($consumables_category_code, $search_name);

        $data = [
            'consumables_category_list' => $consumables_category_list,
            'consumables_list' => $consumables_list,
            'consumables_category_code' => $consumables_category_code,
            'search_name' => $search_name,
        ];

        return self::view($request, 'master_list_search', $data);
    }


    //
    /**
     * 消耗品登録画面
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function add_master($consumables_category_code, Request $request)
    {
        $wheres = [
            'consumables_category_code' => $consumables_category_code,
            'operation_type_code' => $this->login->operation_type_code,
        ];

        // カテゴリデータを全て取得
        $consumables_category_list = ConsumablesData::getConsumablesCategoryList($wheres);

        $data = [
            'consumables_category_list' => $consumables_category_list,
            'consumables_category_code' => $consumables_category_code,
            'search_name' => '',
        ];

        return self::view($request, 'master_consumables_add', $data);
    }

    //
    /**
     * 消耗品更新画面
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function update_master($consumables_code, Request $request)
    {
        Log::debug(print_r($this->login, true));
        $wheres = [
            'consumables_code' => $consumables_code,
            'operation_type_code' => $this->login->operation_type_code,
        ];
        // カテゴリデータを全て取得
        $consumables_category_list = ConsumablesData::getConsumablesCategoryList($wheres);
        // 消耗品データを取得
        $consumables = ConsumablesData::getConsumables($consumables_code);
        // 消耗品バーコードデータを取得
        $consumables_barcode_list = ConsumablesData::getConsumablesBarcodeList($consumables_code);
        $data = [
            'consumables_category_list' => $consumables_category_list,
            'consumables' => $consumables,
            'consumables_barcode_list' => $consumables_barcode_list,
            'search_name' => '',
        ];

        return self::view($request, 'master_consumables_update', $data);
    }

    //
    /**
     * 消耗品QR一覧を表示します。
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function qr_list(Request $request)
    {
        $wheres = [
            'operation_type_code' => $this->login->operation_type_code,
            'unit_code' => 'N',
        ];
        // カテゴリデータを全て取得
        $consumables_category_list = ConsumablesData::getConsumablesCategoryList($wheres);
        // 消耗品一覧用データを取得
        $consumables_list = ConsumablesData::getConsumablesIdList($wheres);
        $qr_list = array();

        foreach ($consumables_category_list as $category) {
            $qr_list[$category->consumables_category_name] = ConsumablesData::getCategoryConsumablesList($category->consumables_category_code);
        }


        $data = [
            'consumables_category_list' => $consumables_category_list,
            'consumables_list' => $consumables_list,
            'login' => $this->login,
            'qr_list' => $qr_list,
        ];

        // dd($consumables_category_all);
        // dd($qr_list);

        return self::view($request, 'qr_list', $data);
    }


    /**
     * 消耗品追加・更新・削除
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit_master($consumables_category_code, Request $request)
    {
        $param = $request->all();
        // dd($param);
        $staff_code = $this->login->staff_code;
        $wheres = [
            'operation_type_code' => $this->login->operation_type_code,
        ];
        if ($request->post == '登録する') {

            // データ追加
            Consumables::insert_consumables($param, $staff_code, $this->login->operation_type_code);
            session()->flash('add_message', '消耗品を登録しました');
            return redirect()->route('master_list_category', ['consumables_category_code' => $consumables_category_code]);

        } elseif ($request->post == '更新する') {

            // データ更新
            Consumables::update_consumables($param, $staff_code);
            session()->flash('update_message', '消耗品情報を更新しました');
            return redirect()->route('update_master', ['consumables_code' => $param['consumables_code']]);

        } elseif ($request->post == '削除する') {

            // データ削除
            Consumables::delete_consumables($param);
            session()->flash('delete_message', '消耗品を削除しました');
            return redirect()->route('master_list_category', ['consumables_category_code' => $consumables_category_code]);

        }
    }
}
