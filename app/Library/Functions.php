<?php

namespace App\Library;

use App\Models\Data\ConsumablesData;

class Functions
{
    public static function image_file($consumables_code)
    {
        // Consumables_codeに紐づく消耗品に拡張子があるか
        $consumables = ConsumablesData::viewOneConsumables($consumables_code);
        // dd($consumables);
        if ($consumables) {
            $len = 8; //指定文字列
            //指定した文字で埋める
            $filename = str_pad($consumables_code, $len, 0, STR_PAD_LEFT); // "0埋め"
            $image_file_extension = $consumables->image_file_extension; //拡張子取得
            $image_filename = $filename. '.' .$image_file_extension; //ファイル名作成
        } else {
            $image_filename = '00000000.png'; //デフォルト値
        }
        // ファイル名を返す
        return $image_filename;
    }
}