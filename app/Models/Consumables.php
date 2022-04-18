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
    public static function insert_consumables($param)
    {
        try {
            // dd($param);
            // 最後のマスタデータの消耗品コードを取得
            $last_consumables = ConsumablesData::getLastConsumables();
            $consumables_code = $last_consumables->consumables_code + 1;
            // dd($consumables_code);
            // 複数使用可判定
            try {
                $can_use_multiple = $param['can_use_multiple'];
            } catch (Exception $e) {
                $can_use_multiple = 0;
            }
            // 入数使用判定
            try {
                $use_quantity = $param['use_quantity'];
            } catch (Exception $e) {
                $use_quantity = 0;
            }
            // 画像があるか
            try {
                $len = 8; //指定文字列
                //指定した文字で埋める
                $filename = str_pad($consumables_code, $len, 0, STR_PAD_LEFT); // => "00123"
                $image_file_extension = $param['image_file']->getClientOriginalExtension(); //拡張子取得
                $image_filename = $filename. '.' .$image_file_extension; //ファイル名取得
                $param['image_file']->storeAs('upload/consumables', $image_filename, 'public_uploads'); //ファイル保存
            } catch (Exception $e) {
                $image_filename = '00000000.png'; //デフォルト値
            }
            $master_values = [
                "消耗品名" => $param['consumables_name'],
                "個数単位" => $param['number_unit'],
                "個数単価" => $param['number_unit_price'],
                "入数" => $param['quantity'],
                "入数単位" => $param['quantity_unit'],
                "入数使用" => $use_quantity,
                "複数使用可" => $can_use_multiple,
                "消耗品種別コード" => $param['consumables_category_code'],
                "最終交渉日" => $param['last_negotiation_date'],
                "画像ファイル拡張子" => $image_filename,
                "登録日時" => now(),
                "更新日時" => now()
            ];
            
            // 消耗品マスタデータに登録
            ConsumablesTable::tableConsumablesMaster()->insert($master_values);
            // 作成日からマスタデータの消耗品コードを取得
            $this_consumables = ConsumablesData::getConsumablesCreateat($master_values['登録日時']);
            
            $id_values = [
                "消耗品コード" => $this_consumables->consumables_code,
                "識別コード" => $param['consumables_code'],
                // "登録職員コード" => $param[''],
                "登録日時" => now(),
            ];
            
            // 消耗品識別データに登録
            ConsumablesTable::tableConsumablesIdMaster()->insert($id_values);
        } catch (\Exception $e) {
            ConsumablesData::rollback();
            throw $e;
        }

    }

    // マスタ更新
    public static function update_consumables($param)
    {

        try {
            // dd($param);
            // 複数使用可判定
            try {
                $can_use_multiple = $param['can_use_multiple'];
            } catch (Exception $e) {
                $can_use_multiple = 0;
            }
            // 入数使用判定
            try {
                $use_quantity = $param['use_quantity'];
            } catch (Exception $e) {
                $use_quantity = 0;
            }
            // 最終交渉日判定
            try {
                $last_negotiation_date = $param['last_negotiation_date'];
            } catch (Exception $e) {
                $last_negotiation_date = Null;
            }
            // 画像判定
            try {
                $len = 8; //指定文字列
                //指定した文字で埋める
                $filename = str_pad($param['consumables_code'], $len, 0, STR_PAD_LEFT); // => "00123"
                $image_file_extension = $param['image_file']->getClientOriginalExtension(); //拡張子取得
                $image_filename = $filename. '.' .$image_file_extension; //ファイル名取得
                $param['image_file']->storeAs('upload/consumables', $image_filename, 'public_uploads'); //ファイル保存
            } catch (Exception $e) {
                // 画像データ取得
                $consumables = ConsumablesData::viewOneConsumables($param['consumables_code']);
                $image_filename = $consumables->image_file_extension;
            }

            // 対象マスタのバーコードを全て取得
            $consumables_id_all = ConsumablesData::getConsumablesId($param['consumables_code']);

            // 識別コードが複数ある場合はバーコードを配列に格納
            $master_values = [
                // "消耗品コード" => $param['consumables_code'],
                "消耗品名" => $param['consumables_name'],
                "個数単位" => $param['number_unit'],
                "個数単価" => $param['number_unit_price'],
                "入数" => $param['quantity'],
                "入数単位" => $param['quantity_unit'],
                "入数使用" => $use_quantity,
                "複数使用可" => $can_use_multiple,
                "消耗品種別コード" => $param['consumables_category_code'],
                "最終交渉日" => $last_negotiation_date,
                "画像ファイル拡張子" => $image_filename,
                "更新日時" => now()
            ];
            ConsumablesData::getOneConsumables($param['consumables_code'])->update($master_values);

        } catch (\Exception $e) {
            ConsumablesData::rollback();
            throw $e;
        }
    }


    // マスタ削除
    public static function delete_consumables($consumables_code)
    {
        try {
            return ConsumablesData::getOneConsumables($consumables_code)->delete();
        } catch (\Exception $e) {
            ConsumablesData::rollback();
            throw $e;
        }
    }

    // 仕入追加
    public static function insert_consumables_buy($buy_quantity, $consumables_code)
    {
        try {

            // 消耗品コードから現在の在庫を参照
            $consumables_stock = ConsumablesData::viewConsumablesStockData($consumables_code);
            // 仕入テーブルの消耗品を１増やす
            $buy_values = [
                "消耗品コード" => $consumables_code,
                "仕入個数" => $buy_quantity,
                "作成日時" => now(),
            ];
            ConsumablesTable::tableConsumablesBuy($consumables_code)->insert($buy_values);
            // 在庫テーブルの消耗品を１増やす
            if ($consumables_stock) {
                // 在庫がある場合
                $stock_values = [
                    "個数在庫数" => $consumables_stock->stock_number + $buy_quantity,
                    "更新日時" => now()
                ];
                // 在庫を更新
                ConsumablesData::getConsumablesStockData($consumables_code)->update($stock_values);
            } else {
                // 在庫がない場合
                // 消耗品コードからマスタデータを参照
                $consumables_master = ConsumablesData::viewOneConsumables($consumables_code);
                $stock_values = [
                    "事業所コード" => 91,
                    "消耗品コード" => $consumables_code,
                    "個数在庫数" => $buy_quantity,
                    "入数在庫数" => $consumables_master->quantity,
                    "作成日時" => now(),
                    "更新日時" => now(),
                ];
                // 在庫に新たに追加
                ConsumablesData::getConsumablesStockData($consumables_code)->insert($stock_values);
            }
        } catch (\Exception $e) {
            ConsumablesData::rollback();
            throw $e;
        }
    }

    // 出荷追加
    public static function insert_consumables_ship($ship_quantity, $consumables_code, $ship_office)
    {
        try {

            // 出荷テーブルの消耗品を１増やす
            $ship_values = [
                "消耗品コード" => $consumables_code,
                "出荷個数" => $ship_quantity,
                "出荷先コード" => $ship_office,
                "作成日時" => now(),
            ];
            ConsumablesTable::tableConsumablesShip($consumables_code)->insert($ship_values);
        } catch (\Exception $e) {
            ConsumablesData::rollback();
            throw $e;
        }
    }


}
