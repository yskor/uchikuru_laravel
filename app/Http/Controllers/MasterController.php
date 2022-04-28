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
     * 消耗品一覧を表示します。
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function master_list(Request $request)
    {
        Log::debug(print_r($this->login, true));

        // 消耗品識別データを取得
        $consumables_category_all = ConsumablesData::getConsumablesCategoryAll();
        // 消耗品一覧用データを取得＊バーコードが増えた時に対応できていない
        $consumables_list = ConsumablesData::viewConsumablesIdAll();
        // dd($consumables_list);

        $data = [
            'consumables_category_all' => $consumables_category_all,
            'consumables_list' => $consumables_list,
            'login' => $this->login,
            // 'category' => '全て',
            'consumables_category_code' => 'all'
        ];

        return self::view($request, 'master_list', $data);
    }

    //
    /**
     * 消耗品一覧を表示します。
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function qr_list(Request $request)
    {
        Log::debug(print_r($this->login, true));

        // 消耗品識別データを取得
        $consumables_category_all = ConsumablesData::getConsumablesCategoryAll();
        // 消耗品一覧用データを取得＊バーコードが増えた時に対応できていない
        $consumables_list = ConsumablesData::viewConsumablesIdAll();

        $data = [
            'consumables_category_all' => $consumables_category_all,
            'consumables_list' => $consumables_list,
        ];

        return self::view($request, 'qr_list', $data);
    }

    //
    /**
     * カテゴリに絞った消耗品一覧表示
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function master_list_category($consumables_category_code, Request $request)
    {
        Log::debug(print_r($this->login, true));

        // カテゴリデータを全て取得
        $consumables_category_all = ConsumablesData::getConsumablesCategoryAll();
        // 対象のカテゴリデータを取得
        $consumables_list = ConsumablesData::getCategoryConsumablesList($consumables_category_code);

        $data = [
            'consumables_category_all' => $consumables_category_all,
            'consumables_list' => $consumables_list,
            'consumables_category_code' => $consumables_category_code
        ];

        return self::view($request, 'master_list_category', $data);
    }


    //
    /**
     * 消耗品登録画面
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function add_master(Request $request)
    {
        Log::debug(print_r($this->login, true));

        // カテゴリデータを全て取得
        $consumables_category_all = ConsumablesData::getConsumablesCategoryAll();

        $data = [
            'consumables_category_all' => $consumables_category_all,
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

        // カテゴリデータを全て取得
        $consumables_category_all = ConsumablesData::getConsumablesCategoryAll();
        // 消耗品データを取得
        $consumables = ConsumablesData::viewOneConsumables($consumables_code);
        // 消耗品バーコードデータを取得
        $consumables_barcode_list = ConsumablesData::viewConsumablesBarcodeList($consumables_code);
        $data = [
            'consumables_category_all' => $consumables_category_all,
            'consumables' => $consumables,
            'consumables_barcode_list' => $consumables_barcode_list,
        ];

        return self::view($request, 'master_consumables_update', $data);
    }

    /**
     * 消耗品追加・更新・削除
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit_master(Request $request)
    {
        Log::debug(print_r($this->login, true));

        $param = $request->all();
        $staff_code = $this->login->staff_code;
        // dd($param);

        if ($request->post == 'add') {
            // データ追加
            Consumables::insert_consumables($param, $staff_code);
        } elseif ($request->post == 'edit') {
            // データ追加
            Consumables::update_consumables($param, $staff_code);
        } elseif ($request->post == 'delete') {
            // データ追加
            Consumables::delete_consumables($param);
        }

        // 消耗品識別データを取得
        $consumables_category_all = ConsumablesData::getConsumablesCategoryAll();
        // 消耗品一覧用データを取得＊バーコードが増えた時に対応できていない
        $consumables_list = ConsumablesData::viewConsumablesIdAll();

        $data = [
            'consumables_category_all' => $consumables_category_all,
            'consumables_list' => $consumables_list,
            'consumables_category_code' => 'all'
        ];

        return self::view($request, 'master_list', $data);
    }
}
