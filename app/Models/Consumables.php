<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Data\ConsumablesData;
use App\Models\Data\Table\ConsumablesTable;
use Exception;
use Mockery\Generator\StringManipulation\Pass\Pass;
use phpDocumentor\Reflection\Types\Null_;
use PhpOption\None;
use PHPUnit\TextUI\XmlConfiguration\TestDirectory;

use function PHPSTORM_META\type;

class Consumables extends Model
{

    // テーブル (INSERT、UPDATE、DELETE 時に使う)
    const consumables_code = "VIEW_職員マスタ";

    const consumables_name = "VIEW_消耗品マスタ";
    const TABLE_CONSUMABLE_CATEGORY_MASTER = "VIEW_消耗品カテゴリマスタ";
    const TABLE_CONSUMABLE_STOCK = "VIEW_消耗品在庫テーブル";
    const TABLE_CONSUMABLE_MOVEMENT = "VIEW_消耗品変動テーブル";
    const TABLE_CONSUMABLE_MOVEMENT_STATUS_HISTORY = "VIEW_消耗品変動状態履歴テーブル";
    const TABLE_CONSUMABLE_DELIVER = "VIEW_消耗品配送中件数";


    use HasFactory;


    // マスタ登録
    public static function insert_consumables($param, $staff_code)
    {
        try {
            // 最後のマスタデータの消耗品コードを取得
            $last_consumables = ConsumablesData::getLastConsumables();
            $consumables_code = $last_consumables->consumables_code + 1;
            // 画像があるか
            try {
                $len = 8; //指定文字列
                //指定した文字で埋める
                $filename = str_pad($consumables_code, $len, 0, STR_PAD_LEFT); // => "00123"
                $image_file_extension = $param['image_file']->getClientOriginalExtension(); //拡張子取得
                $image_filename = $filename . '.' . $image_file_extension; //ファイル名取得
                $param['image_file']->storeAs('upload/consumables', $image_filename, 'public_uploads'); //ファイル保存
            } catch (Exception $e) {
                $image_filename = '00000000.png'; //デフォルト値
            }
            $master_values = [
                "消耗品名" => $param['consumables_name'],
                "個数単価" => $param['number_unit_price'],
                "個数" => $param['number'],
                "入数" => $param['quantity'],
                "消費数量" => $param['use_quantity'],
                "消費単位コード" => $param['use_unit'],
                "消耗品種別コード" => $param['consumables_category_code'],
                "最終価格交渉日" => $param['last_negotiation_date'],
                "画像ファイル拡張子" => $image_filename,
                "最終更新職員コード" => $staff_code,
                "登録日時" => now(),
                "更新日時" => now()
            ];

            // 消耗品マスタデータに登録
            ConsumablesTable::tableConsumablesMaster()->insert($master_values);
            // 作成日からマスタデータの消耗品コードを取得
            $this_consumables = ConsumablesData::getConsumablesCreateat($master_values['登録日時']);
            $unit_codes = ['B', 'N', 'Q'];
            foreach ($unit_codes as $code) {
                if ($param['barcode'][$code]) {
                    $id_values = [
                        "消耗品コード" => $this_consumables->consumables_code,
                        "識別コード" => $param['barcode'][$code],
                        "消耗品単位コード" => $code,
                        "登録日時" => now(),
                    ];
                    // 消耗品識別データに登録
                    ConsumablesTable::tableConsumablesIdMaster()->insert($id_values);
                }
            }
        } catch (\Exception $e) {
            ConsumablesData::rollback();
            throw $e;
        }
    }

    // マスタ更新
    public static function update_consumables($param, $staff_code)
    {
        // dd($param);
        try {
            // 画像判定
            try {
                $len = 8; //指定文字列
                //指定した文字で埋める
                $filename = str_pad($param['consumables_code'], $len, 0, STR_PAD_LEFT); // => "00123"
                $image_file_extension = $param['image_file']->getClientOriginalExtension(); //拡張子取得
                $image_filename = $filename . '.' . $image_file_extension; //ファイル名取得
                $param['image_file']->storeAs('upload/consumables', $image_filename, 'public_uploads'); //ファイル保存
            } catch (Exception $e) {
                // 画像データ取得
                $consumables = ConsumablesData::viewOneConsumables($param['consumables_code']);
                $image_filename = $consumables->image_file_extension;
            }

            $master_values = [
                "消耗品名" => $param['consumables_name'],
                "個数単価" => $param['number_unit_price'],
                "個数" => $param['number'],
                "入数" => $param['quantity'],
                "消費数量" => $param['use_quantity'],
                "消費単位コード" => $param['use_unit'],
                "消耗品種別コード" => $param['consumables_category_code'],
                "最終価格交渉日" => $param['last_negotiation_date'],
                "画像ファイル拡張子" => $image_filename,
                "最終更新職員コード" => $staff_code,
                "更新日時" => now()
            ];

            ConsumablesData::getOneConsumables($param['consumables_code'])->update($master_values);

            $consumables = ConsumablesData::viewOneConsumables($param['consumables_code']);
            $unit_codes = ['B', 'N', 'Q'];
            foreach ($unit_codes as $code) {
                if ($param['barcode'][$code]) {
                    $id_values = [
                        "消耗品コード" => $consumables->consumables_code,
                        "識別コード" => $param['barcode'][$code],
                        "消耗品単位コード" => $code,
                        "登録日時" => now(),
                    ];
                    // 消耗品コードと単位コードから既にあるか確認。あるは更新、無い場合は追加
                    if (ConsumablesData::viewConsumablesBarcodeItem($param['consumables_code'], $code)) {
                        // 消耗品識別データを更新
                        // dd($param['consumables_code']);
                        ConsumablesData::getConsumablesBarcodeItem($param['consumables_code'], $code)->update($id_values);
                    } else {
                        // 消耗品識別データに登録
                        ConsumablesTable::tableConsumablesIdMaster()->insert($id_values);
                    }
                }
            }
        } catch (\Exception $e) {
            ConsumablesData::rollback();
            throw $e;
        }
    }


    // マスタ削除
    public static function delete_consumables($param)
    {
        try {
            ConsumablesData::getOneConsumables($param['consumables_code'])->delete();
            ConsumablesData::getConsumablesIdItem($param['consumables_code'])->delete();
        } catch (\Exception $e) {
            ConsumablesData::rollback();
            throw $e;
        }
    }

    // 仕入追加
    public static function insert_consumables_buy($consumables_code, $office_code, $buy_number, $staff_code)
    {
        try {

            // 消耗品コードから現在の在庫を参照
            $consumables_stock = ConsumablesData::viewConsumablesStockData($consumables_code, $office_code);
            // 消耗品コードからマスタデータを参照
            $consumables_data = ConsumablesData::viewOneConsumables($consumables_code);
            // 仕入テーブルの消耗品を増やす
            $buy_values = [
                "消耗品コード" => $consumables_code,
                "仕入事業所コード" => $office_code,
                "仕入個数" => $buy_number,
                "仕入単価" => $consumables_data->number_unit_price,
                "仕入職員コード" => $staff_code,
                "作成日時" => now(),
            ];
            ConsumablesTable::tableConsumablesBuy($consumables_code)->insert($buy_values);

            // 在庫テーブルの消耗品を増やす
            $consumables_master = ConsumablesData::viewOneConsumables($consumables_code);
            // 仕入数＊入り個数
            $stock_number = $buy_number * $consumables_master->number;

            if ($consumables_stock) {
                // 在庫がある場合
                $stock_values = [
                    "個数在庫数" => $consumables_stock->stock_number + $stock_number,
                    // "更新日時" => now()
                ];
                // 在庫を更新
                ConsumablesData::getConsumablesStockData($consumables_code, $office_code)->update($stock_values);
            } else {
                // 在庫がない場合
                $stock_values = [
                    "事業所コード" => 91,
                    "消耗品コード" => $consumables_code,
                    "個数在庫数" => $stock_number,
                    // "入数在庫数" => $consumables_master->quantity,
                    "作成日時" => now(),
                    "更新日時" => now(),
                ];
                // 在庫に新たに追加
                ConsumablesTable::tableConsumablesStock()->insert($stock_values);
            }
        } catch (\Exception $e) {
            ConsumablesData::rollback();
            throw $e;
        }
    }

    // 出荷追加
    public static function insert_consumables_ship($consumables_code, $office_code_from, $ship_number, $staff_code, $office_code_to)
    {
        try {

            // 出荷テーブルを追加
            $ship_values = [
                "消耗品コード" => $consumables_code,
                "出荷元事業所コード" => $office_code_from,
                "出荷数" => $ship_number,
                "出荷職員コード" => $staff_code,
                "消耗品変動状態コード" => 'S',
                // "出荷日時" => $ship_date,
                "納品先事業所コード" => $office_code_to,
            ];
            ConsumablesTable::tableConsumablesShip()->insert($ship_values);

            // 消耗品コードから現在の在庫を参照
            $consumables_stock = ConsumablesData::viewConsumablesStockData($consumables_code, $office_code_from);
            if ($consumables_stock->stock_number - $ship_number >= 0) {
                // 在庫数が0以上の時在庫テーブルの消耗品を減らす
                $dec_values = [
                    "消耗品コード" => $consumables_code,
                    "個数在庫数" => $consumables_stock->stock_number - $ship_number,
                    "入数在庫数" => $consumables_stock->quantity,
                    "更新日時" => now(),
                ];
                ConsumablesData::getConsumablesStockData($consumables_code, $office_code_from)->update($dec_values);
            }
        } catch (\Exception $e) {
            ConsumablesData::rollback();
            // throw new \Exception("本部に在庫がありません");
            throw $e;
        }
    }

    // 納品追加
    public static function insert_consumables_deliver($ship_code, $consumables_code, $office_code, $deliver_number, $stock_number, $staff_code)
    {
        try {
            // 在庫テーブルから現在の在庫を参照
            $consumables_stock = ConsumablesData::viewConsumablesStockData($consumables_code, $office_code);
            // 消耗品コードからマスタデータを参照
            $consumables_data = ConsumablesData::viewOneConsumables($consumables_code);
            // dd($consumables_stock,$consumables_data->use_unit_code);

            // 出荷納品テーブルで更新する内容
            $deliver_values = [
                "納品数" => $deliver_number,
                "納品職員コード" => $staff_code,
                "納品日時" => now(),
                "消耗品変動状態コード" => 'D',
            ];
            // 出荷納品テーブルを更新
            ConsumablesData::getConsumablesShipData($ship_code)->update($deliver_values);

            if ($consumables_stock) {
                // 在庫テーブルに同じ消耗品がある場合
                $stock_values = [
                    "消耗品コード" => $consumables_code,
                    "個数在庫数" => $stock_number + $deliver_number,
                    "登録職員コード" => $staff_code,
                    "更新日時" => now(),
                ];
                return ConsumablesData::getConsumablesStockData($consumables_code, $office_code)->update($stock_values);
            } else {
                // 在庫テーブルに同じ消耗品がない場合
                $stock_values = [
                    "事業所コード" => $office_code,
                    "消耗品コード" => $consumables_code,
                    "個数在庫数" => $stock_number + $deliver_number,
                    "入数在庫数" => 0,
                    "登録職員コード" => $staff_code,
                    "作成日時" => now(),
                    "更新日時" => now(),
                ];
                return ConsumablesTable::tableConsumablesStock()->insert($stock_values);
            }
        } catch (\Exception $e) {
            ConsumablesData::rollback();
            throw $e;
        }
    }

    // 消費
    public static function insert_consumables_consumption($consumables_code, $office_code, $consumption_quantity, $consumption_unit_code, $staff_code)
    {
        try {
            // 消耗品コードから現在の在庫を参照
            $consumables_stock = ConsumablesData::viewConsumablesStockData($consumables_code, $office_code);
            // dd($consumables);
            if ($consumption_unit_code == "Q") {
                $consumption_values = [
                    "消耗品コード" => $consumables_code,
                    "消費事業所コード" => $office_code,
                    "消費数" => $consumption_quantity,
                    "消費単位コード" => $consumption_unit_code,
                    "消費日時" => now(),
                    "消費職員コード" => $staff_code,
                ];
                $total_stock_quantity = $consumables_stock->stock_number * $consumables_stock->quantity + $consumables_stock->stock_quantity;
                $total_stock_quantity = $total_stock_quantity - $consumption_quantity;
                $stock_number = floor($total_stock_quantity / $consumables_stock->quantity);
                $stock_quantity = ($total_stock_quantity % $consumables_stock->quantity);
                // dd($stock_number, $stock_quantity, $total_stock_quantity);
            } else {
                $consumption_values = [
                    "消耗品コード" => $consumables_code,
                    "消費事業所コード" => $office_code,
                    "消費数" => $consumption_quantity,
                    "消費単位コード" => $consumption_unit_code,
                    "消費日時" => now(),
                    "消費職員コード" => $staff_code,
                ];
                $stock_number = $consumables_stock->stock_number - $consumption_quantity;
                $stock_quantity = $consumables_stock->stock_quantity;
            }

            ConsumablesTable::tableConsumablesConsumption()->insert($consumption_values);



            // 在庫テーブルの消耗品を減らす
            $stock_values = [
                "個数在庫数" => $stock_number,
                "入数在庫数" => $stock_quantity,
                "更新日時" => now(),
            ];
            ConsumablesData::getConsumablesStockData($consumables_code, $office_code)->update($stock_values);
        } catch (\Exception $e) {
            ConsumablesData::rollback();
            throw $e;
        }
    }
}
