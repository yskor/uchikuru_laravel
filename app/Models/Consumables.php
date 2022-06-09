<?php

namespace App\Models;

use App\Models\Data\BuyConsumablesData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Data\ConsumablesData;
use App\Models\Data\ShipConsumablesData;
use App\Models\Data\StockConsumablesData;
use App\Models\Data\Table\ConsumablesTable;
use Exception;
use Mockery\Generator\StringManipulation\Pass\Pass;
use phpDocumentor\Reflection\Types\Null_;
use PhpOption\None;
use PHPUnit\TextUI\XmlConfiguration\TestDirectory;

use function PHPSTORM_META\type;

class Consumables extends Model
{

    use HasFactory;


    // マスタ登録
    public static function insert_consumables($param, $staff_code)
    {
        try {
            // 最後のマスタデータの消耗品コードを取得
            $last_consumables = ConsumablesData::getLastConsumables();
            // 新たに登録する消耗品マスタのコードを作成
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
                "在庫定数" => $param['stock_constant_quantity'],
                "在庫定数単位コード" => $param['stock_constant_quantity_code'],
                "在庫補充点" => $param['stock_replenishment_point'],
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
                "在庫定数" => $param['stock_constant_quantity'],
                "在庫定数単位コード" => $param['stock_constant_quantity_code'],
                "在庫補充点" => $param['stock_replenishment_point'],
                "最終価格交渉日" => $param['last_negotiation_date'],
                "画像ファイル拡張子" => $image_filename,
                "最終更新職員コード" => $staff_code,
                "更新日時" => now()
            ];

            // 消耗品マスタを更新
            ConsumablesData::getOneConsumables($param['consumables_code'])->update($master_values);

            // 以下は更新したマスタに紐づく識別マスタを更新する処理
            $consumables = ConsumablesData::viewOneConsumables($param['consumables_code']);
            $unit_codes = ['B', 'N', 'Q'];
            foreach ($unit_codes as $code) {
                $id_values = [
                    "消耗品コード" => $consumables->consumables_code,
                    "識別コード" => $param['barcode'][$code],
                    "消耗品単位コード" => $code,
                    "登録日時" => now(),
                ];
                if ($param['barcode'][$code]) {
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
                // } else {
                //     // NULL時
                //     ConsumablesData::getConsumablesBarcodeItem($param['consumables_code'], $code)->update($id_values);
                // }
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

    // 在庫調整
    public static function stock_consumables_adjustment($office_code, $consumables_code, $stock_number, $stock_quantity)
    {
        try {
            $stock_values = [
                "個数在庫数" => $stock_number,
                "入数在庫数" => $stock_quantity,
                "更新日時" => now()
            ];
            // 在庫を更新
            ConsumablesData::getConsumablesStockData($consumables_code, $office_code)->update($stock_values);
        } catch (\Exception $e) {
            ConsumablesData::rollback();
            throw $e;
        }
    }

    // 仕入追加
    public static function insert_consumables_buy($data, $office_code, $staff_code)
    {
        try {
            $consumables_code = $data['consumables_code']; // 消耗品コード
            $consumables_barcode = $data['consumables_barcode']; //消耗品バーコード
            $buy_unit_code = $data['buy_unit_code']; //仕入単位コード（B or N or Q）
            $buy_quantity = $data['buy_quantity']; //仕入数
            $consumables_data = ConsumablesData::viewBuyConsumablesBarcode($consumables_barcode);
            $consumables_stock = ConsumablesData::viewConsumablesStockData($consumables_code, $office_code);
            dd($consumables_stock);
            BuyConsumablesData::beginTransaction();
            BuyConsumablesData::insert_buy($consumables_data, $buy_unit_code, $buy_quantity, $office_code, $staff_code);
            BuyConsumablesData::update_stock($consumables_stock, $buy_unit_code, $buy_quantity, $office_code);
            BuyConsumablesData::commit();
        } catch (\Exception $e) {
            ConsumablesData::rollback();
            throw $e;
        }
    }

    // 出荷追加
    public static function insert_consumables_ship($data)
    {
        try {
            // dd($data);
            
            // 消耗品コードから出荷元の在庫を参照

            $ship_from_stock = ConsumablesData::viewConsumablesStockData($data['consumables_code'], $data['office_code_from']);
            if ($ship_from_stock->stock_number >= $data['ship_quantity']) {
                // 在庫数が出荷数より多い時

                // 出荷テーブルを追加
                ShipConsumablesData::beginTransaction();
                ShipConsumablesData::insert_ship($data);
                // 在庫テーブルの消耗品を減らす
                ShipConsumablesData::update_stock($ship_from_stock, $data);
                ShipConsumablesData::commit();

                if($ship_from_stock->quantity == 1) {
                    session()->flash('success_message', $ship_from_stock->consumables_name .'（' . $data['ship_quantity']. '個）'. 'を出荷一覧に追加しました');
                } else {
                    session()->flash('success_message', $ship_from_stock->consumables_name .'（' . $data['ship_quantity']. '箱）'. 'を出荷一覧に追加しました');
                }
            } else {
                // 本部の在庫が不足している場合
                $shortage_quantity = $data['ship_quantity'] - $ship_from_stock->stock_number;
                session()->flash('error_message', $ship_from_stock->consumables_name . 'の本部在庫が'. $shortage_quantity . '箱不足しています。');
            }
        } catch (\Exception $e) {
            ConsumablesData::rollback();
            // throw new \Exception("本部に在庫がありません");
            throw $e;
        }
    }

    // 出荷キャンセル
    public static function cancel_consumables_ship($ship_code, $office_code)
    {
        try {
            ShipConsumablesData::beginTransaction();
            ShipConsumablesData::cancel_ship($ship_code, $office_code);
            ShipConsumablesData::commit();
        } catch (\Exception $e) {
            ConsumablesData::rollback();
            // throw new \Exception("本部に在庫がありません");
            throw $e;
        }
    }

    // 納品追加
    public static function insert_consumables_deliver($value)
    {
        // dd($value);
        $ship_code = $value['ship_code'];
        $consumables_code = $value['consumables_code'];
        $office_code = $value['office_code'];
        $deliver_number = $value['deliver_number'];
        $stock_number = $value['stock_number'];
        $staff_code = $value['staff_code'];
        // dd($ship_code,$consumables_code, $office_code, $stock_number, $staff_code);
        // 在庫テーブルから現在の在庫を参照
        $consumables_stock = ConsumablesData::viewConsumablesStockData($consumables_code, $office_code);
        // 消耗品コードからマスタデータを参照
        $consumables_data = ConsumablesData::viewOneConsumables($consumables_code);
        // dd($consumables_stock,$consumables_data->use_unit_code);
        // 出荷納品テーブルを参照
        $ship_data = ConsumablesData::viewConsumablesShipData($ship_code);
        try {

            // 出荷数と納品数が一致しない場合は本部の在庫数を調整する
            if($deliver_number != $ship_data->shipped_number) {
                $adjustment_number = $ship_data->shipped_number - $deliver_number;
                // 本部の在庫テーブルから現在の在庫を参照
                $consumables_stock = ConsumablesData::viewConsumablesStockData($consumables_code, 91);
                $stock_values = [
                    "個数在庫数" => $consumables_stock->stock_number + $adjustment_number,
                ];
                ConsumablesData::getConsumablesStockData($consumables_code, 91)->update($stock_values);
            }

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
                    "在庫補充状況コード" => NULL,
                    "更新日時" => now(),
                ];
                ConsumablesData::getConsumablesStockData($consumables_code, $office_code)->update($stock_values);
                $consumables_stock = ConsumablesData::viewConsumablesStockData($consumables_code, $office_code);
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
    public static function insert_consumables_consumption($wheres)
    {
        try {
            $consumables_code = $wheres['consumables_code'];
            $office_code = $wheres['office_code'];
            $consumption_quantity = $wheres['consumption_quantity']; //消費数量
            $consumption_unit_code = $wheres['consumption_unit_code']; //消費単位
            $staff_code = $wheres['staff_code'];

            // 消耗品コードから現在の在庫を参照
            $consumables_stock = ConsumablesData::viewConsumablesStockData($consumables_code, $office_code);
            // dd($consumables);
            if ($consumption_unit_code == "Q") {
                // 消費テーブルの追加データ
                $consumption_values = [
                    "消耗品コード" => $consumables_code,
                    "消費事業所コード" => $office_code,
                    "消費数" => $consumption_quantity,
                    "消費単位コード" => $consumption_unit_code,
                    "消費日時" => now(),
                    "消費職員コード" => $staff_code,
                ];
                // 在庫数量算出
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
            // 消費テーブルに追加
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
