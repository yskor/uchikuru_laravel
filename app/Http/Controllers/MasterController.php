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
        $consumables_list = ConsumablesData::getConsumablesIdAll();
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
     * カテゴリに絞った消耗品一覧表示
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function master_list_category($consumables_category_code, Request $request)
    {
        Log::debug(print_r($this->login, true));

        // カテゴリデータを全て取得
        $consumables_category_all = ConsumablesData::getConsumablesCategoryAll();
        // 対象のカテゴリデータを取得
        $consumables_category = ConsumablesData::getConsumablesCategory($consumables_category_code);
        // データを取得
        $consumables_list_category = ConsumablesData::getCategoryConsumablesList($consumables_category_code);
        // dd($consumables_list_category);

        // dd($consumables_list_category);
        $data = [
            'consumables_category_all' => $consumables_category_all,
            'consumables_list_category' => $consumables_list_category,
            'login' => $this->login,
            'consumables_category' => $consumables_category,
            'consumables_category_code' => $consumables_category_code
        ];

        return self::view($request, 'master_list_category', $data);
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

        if ($request->post == 'add') {
            // データ追加
            Consumables::insert_consumables($param);
        } elseif ($request->post == 'edit') {
            // データ追加
            Consumables::update_consumables($param);
        } elseif ($request->post == 'delete') {
            // データ追加
            Consumables::delete_consumables($request->consumables_code);

        }

        // 消耗品識別データを取得
        $consumables_category_all = ConsumablesData::getConsumablesCategoryAll();
        // 消耗品一覧用データを取得＊バーコードが増えた時に対応できていない
        $consumables_list = ConsumablesData::getConsumablesIdAll();

        $data = [
            'consumables_category_all' => $consumables_category_all,
            'consumables_list' => $consumables_list,
            'login' => $this->login,
            'consumables_category_code' => 'all'
        ];

        return self::view($request, 'master_list', $data);
    }
}
