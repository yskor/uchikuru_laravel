<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Base\AuthController;
use App\Http\Controllers\Base\ActionController;
use App\Models\Data\ConsumableData;
use App\Models\Consumable;
use Illuminate\Support\Facades\Log;
use App\Models\Data\BaseData;


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
        
        // カテゴリデータを取得
        $consumable_category_all = ConsumableData::getConsumableCategoryAll();
        // データを取得
        $consumable_list = ConsumableData::getConsumable();
        
        $data = [
            'consumable_category_all' => $consumable_category_all,
            'consumable_list' => $consumable_list,
            'login' => $this->login,
            'category' => '全て'
        ];
        
        return self::view($request, 'master_list', $data );
    }
    
    //
    /**
     * カテゴリに絞った消耗品一覧表示
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function master_list_category($consumable_category_code, Request $request)
    {
        Log::debug(print_r($this->login, true));
        
        // カテゴリデータを全て取得
        $consumable_category_all = ConsumableData::getConsumableCategoryAll();
        // 対象のカテゴリデータを取得
        $consumable_category = ConsumableData::getConsumableCategory($consumable_category_code);
        // データを取得
        $consumable_list_category = ConsumableData::getCategoryConsumableList($consumable_category_code);
        
        // dd($consumable_list_category);
        $data = [
            'consumable_category_all' => $consumable_category_all,
            'consumable_list_category' => $consumable_list_category,
            'login' => $this->login,
            'category' => $consumable_category
        ];
        
        return self::view($request, 'master_list_category', $data );
    }
    
    /**
     * 消耗品追加
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    // public function add_master(Request $request)
    // {
    //     Log::debug(print_r($this->login, true));
        
    //     $param = $request->all();
        
    //     // データ追加
    //     Consumable::insert_consumable( $param );
        
    //     // カテゴリデータを取得
    //     $consumable_category = ConsumableData::getConsumableCategoryAll();

    //     // データを取得
    //     $consumable_list = ConsumableData::getConsumable();
        
    //     $data = [
    //         'consumable_category' => $consumable_category,
    //         'consumable_list' => $consumable_list,
    //         'login' => $this->login
    //     ];
        
    //     return self::view($request, 'master_list', $data );
    // }

    /**
     * 消耗品追加・更新
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit_master(Request $request)
    {
        Log::debug(print_r($this->login, true));
        
        $param = $request->all();
        
        // $test = [$request->imgpath]
        if ($request->post == 'add') {
            // データ追加
            // dd($param);
            Consumable::insert_consumable( $param );
        } elseif ($request->post == 'edit') {
            // データ追加
            // dd($param);
            // $image_filename=$request->image_file->getClientOriginalName(); //ファイル名取得
            // dd($param['image_file']->storeAs('tmp',$image_filename));
            // dd($request->image_file->storeAs('tmp',$image_filename));
            Consumable::update_consumable( $param );
        }
        
        // カテゴリデータを取得
        $consumable_category_all = ConsumableData::getConsumableCategoryAll();

        // データを取得
        $consumable_list = ConsumableData::getConsumable();
        
        $data = [
            'consumable_category_all' => $consumable_category_all,
            'consumable_list' => $consumable_list,
            'login' => $this->login
        ];
        
        return self::view($request, 'master_list', $data );
    }
}
