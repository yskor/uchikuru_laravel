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

class TestController extends AuthController
{

    /**
     * テスト
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function test(Request $request)
    {
        Log::debug(print_r($this->login, true));
        $consumables_category_all = ConsumablesData::getConsumablesCategoryAll();
        $consumables_list = ConsumablesData::viewConsumablesIdAll();

        foreach ( $consumables_list as $consumables) {

            $len = 8; //指定文字列
            //指定した文字で埋める
            $filename = str_pad($consumables->consumables_code, $len, 0, STR_PAD_LEFT); // => "00123"
            $image_filename = $filename . '.jpg'; //ファイル名取得
            
            $master_values = [
                "画像ファイル拡張子" => $image_filename,
            ];
            ConsumablesData::getOneConsumables($consumables->consumables_code)->update($master_values);
        };

        $data = [
            'consumables_category_all' => $consumables_category_all,
            'consumables_list' => $consumables_list,
            'login' => $this->login,
            // 'category' => '全て',
            'consumables_category_code' => 'all'
        ];

        return self::view($request, 'master_list', $data);
    }
}
