<?php

namespace App\Models\Data;

use App\Models\Consumables;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Data\Table\ConsumablesTable;
use App\Models\Data\Table\OfficeTable;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use PDO;
use phpDocumentor\Reflection\Types\This;

/**
 * 入居者データクラス
 * @author Kodo Hori
 *
 */
class ConsumablesData extends BaseData
{
    use HasFactory;

    /**
     *　消耗品の一覧を取得します。
     */
    public static function getConsumables()
    {
        return ConsumablesTable::viewConsumablesMaster()->get();
    }

    /**
     * 消耗品種別マスタから全てのカテゴリデータを取得します。

     */
    public static function getConsumablesCategoryAll()
    {
        return ConsumablesTable::viewConsumablesCategoryMaster()->get();
    }

    /**
     * 消耗品識別マスタから全てのデータを取得します。

     */
    public static function viewConsumablesIdAll()
    {
        return ConsumablesTable::viewConsumablesIdMaster()->where('unit_code', '=', 'N')->get();
    }

    // マスタ一覧表示画面用
    public static function getConsumablesAll()
    {
        // データを取得
        $consumables_list = ConsumablesData::getConsumables();

        // 消耗品コードから該当するバーコードを取得し、配列として$consumables_listに格納
        foreach ($consumables_list as $data) {
            $consumables_id_all = ConsumablesData::getConsumablesId($data->consumables_code);
            $data->consumables_barcode = $consumables_id_all;
        }

        // dd($consumables_list);

        return $consumables_id_all;
    }


    /**
     * 指定された消耗品カテゴリコードからカテゴリの情報を取得します。

     */
    public static function getConsumablesCategory($consumables_category_code)
    {
        return ConsumablesTable::viewConsumablesCategoryMaster()->where('consumables_category_code', '=', $consumables_category_code)->first();
    }

    /**
     * 指定された消耗品コードから消耗品を取得します。
     * @param string $consumables_code
     */
    public static function getConsumablesIdItem($consumables_code)
    {
        return ConsumablesTable::tableConsumablesIdMaster()->where('消耗品コード', '=', $consumables_code);
    }

    /**
     * 指定された消耗品コードとバーコードから消耗品を取得します。
     * @param int $consumables_code
     * @param int $unit_code
     */
    public static function getConsumablesBarcodeItem($consumables_code, $unit_code)
    {
        return ConsumablesTable::tableConsumablesIdMaster()
                ->where('消耗品コード', '=', $consumables_code)
                ->where('消耗品単位コード', '=', $unit_code);
    }

    /**
     * 指定された消耗品コードと消耗品単位コードから消耗品を取得します。
     * @param string $consumables_code
     * @param int $unit_code
     */
    public static function viewConsumablesBarcodeItem($consumables_code, $unit_code)
    {
        return ConsumablesTable::viewConsumablesIdMasterOnly()
                ->where('consumables_code', '=', $consumables_code)
                ->where('unit_code', '=', $unit_code)->first();
    }

    /**
     * 指定された消耗品コードから消耗品識別バーコードを全て取得します。
     * @param string $consumables_code
     */
    public static function getConsumablesId($consumables_code)
    {
        return self::getConsumablesIdItem($consumables_code)->select('consumables_barcode')->get();
    }

    /**
     * 指定された消耗品カテゴリコードから消耗品の一覧を取得します。
     * @param string $consumables_category_code
     * @return unknown
     */
    public static function getCategoryConsumablesList($consumables_category_code)
    {
        return ConsumablesTable::viewConsumablesIdMaster()
                ->where('consumables_category_code', '=', $consumables_category_code)
                ->where('unit_code', '=', 'N')
                ->get();
    }

    /**
     *　最後のから消耗品を取得します。
     */
    public static function getLastConsumables()
    {
        return ConsumablesTable::viewConsumablesMaster()->latest()->first();
    }
    /**
     *　作成日時から消耗品を取得します。
     * @param string $created_at
     */
    public static function getConsumablesCreateat($created_at)
    {
        return ConsumablesTable::viewConsumablesMaster()->where('created_at', '=', $created_at)->first();
    }

    /**
     *　消耗品コードから消耗品を取得します。
     * @param string $consumables_code
     */
    public static function getOneConsumables($consumables_code)
    {
        return ConsumablesTable::tableConsumablesMaster()->where('消耗品コード', '=', $consumables_code);
    }

    /**
     *　消耗品コードから消耗品を参照します。
     * @param string $consumables_code
     */
    public static function viewOneConsumables($consumables_code)
    {
        return ConsumablesTable::viewConsumablesMaster()->where('consumables_code', '=', $consumables_code)->first();
    }

    /**
     *　消耗品バーコードから消耗品を参照します。
     * @param string $consumables_code
     */
    public static function viewConsumablesBarcode($consumables_barcode)
    {
        return ConsumablesTable::viewConsumablesIdMaster()->where('consumables_barcode', '=', $consumables_barcode)->first();
    }

    /**
     *　消耗品バーコード（段ボール）から消耗品を参照します。
     * @param string $consumables_code
     */
    public static function viewBuyConsumablesBarcode($consumables_barcode)
    {
        return ConsumablesTable::viewConsumablesIdMaster()
            ->where('consumables_barcode', '=', $consumables_barcode)
            ->where('unit_code', '=', 'B')->first();
    }

    /**
     *　消耗品コードからバーコードリストを参照します。
     * @param string $consumables_code
     */
    public static function viewConsumablesBarcodeList($consumables_code)
    {
        $barcode_B = ConsumablesTable::viewConsumablesIdMasterOnly()
                    ->where('consumables_code', '=', $consumables_code)
                    ->where('unit_code', '=', 'B')->value('consumables_barcode');
        $barcode_N = ConsumablesTable::viewConsumablesIdMasterOnly()
                    ->where('consumables_code', '=', $consumables_code)
                    ->where('unit_code', '=', 'N')->value('consumables_barcode');
        $barcode_Q = ConsumablesTable::viewConsumablesIdMasterOnly()
                    ->where('consumables_code', '=', $consumables_code)
                    ->where('unit_code', '=', 'Q')->value('consumables_barcode');

        $barcodes = [
            'barcode_B' => $barcode_B,
            'barcode_N' => $barcode_N,
            'barcode_Q' => $barcode_Q
        ];
        // dd($barcodes);
        
        return $barcodes;
    
    }

    /**
     *　消耗品在庫テーブルから全てのデータを取得します。
     */
    public static function getConsumablesStockAll()
    {
        return ConsumablesTable::tableConsumablesStock()->get();
    }

    /**
     *　消耗品在庫テーブルから全てのデータを参照します。
     */
    public static function viewOfficeConsumablesStockAll()
    {
        return ConsumablesTable::viewOfficeConsumablesStock()->get();
    }

    /**
     *　消耗品在庫テーブルから対象施設のデータを参照します。
     * @param int $office_code
     */
    public static function viewThisOfficeConsumablesStockAll($office_name)
    {
        return ConsumablesTable::viewOfficeConsumablesStock()->where('office_name', '=', $office_name)->get();
    }

    /**
     * 指定された消耗品カテゴリコードから消耗品の一覧を取得します。
     * @param int $consumables_category_code
     * @return unknown
     */
    public static function getCategoryConsumablesstockList($consumables_category_code)
    {
        return ConsumablesTable::viewOfficeConsumablesStock()->where('consumables_category_code', '=', $consumables_category_code)->get();
    }

    /**
     * 指定された事業所コードから消耗品在庫の一覧を取得します。
     * @param int $consumables_category_code
     * @return unknown
     */
    public static function viewFacilityConsumablesStockList($office_code)
    {
        return DB::select("SELECT *
                        FROM dbo.VIEW_消耗品識別マスタ AS m
                        LEFT JOIN 
						(SELECT dbo.VIEW_消耗品在庫テーブルのみ.consumables_code,
						        dbo.VIEW_消耗品在庫テーブルのみ.stock_number as f_stock_number,
								dbo.VIEW_消耗品在庫テーブルのみ.stock_quantity as f_stock_quantity  FROM dbo.VIEW_消耗品在庫テーブルのみ WHERE dbo.VIEW_消耗品在庫テーブルのみ.office_code = $office_code) AS s
                        ON s.consumables_code = m.consumables_code
						LEFT JOIN
						(SELECT dbo.VIEW_消耗品在庫テーブルのみ.consumables_code,
						        dbo.VIEW_消耗品在庫テーブルのみ.stock_number as stock_number,
								dbo.VIEW_消耗品在庫テーブルのみ.stock_quantity as stock_quantity  FROM dbo.VIEW_消耗品在庫テーブルのみ WHERE dbo.VIEW_消耗品在庫テーブルのみ.office_code = 91) AS a
                        ON a.consumables_code = m.consumables_code WHERE m.unit_code = 'N'");
    }

    /**
     * 指定された消耗品カテゴリコードから消耗品の一覧を取得します。
     * @param int $office_code
     * @param int $consumables_category_code
     * @return unknown
     */
    public static function viewFacilityCategoryConsumablesStockList($office_code, $consumables_category_code)
    {
        return DB::select("SELECT *
                        FROM dbo.VIEW_消耗品識別マスタ AS m
                        LEFT JOIN 
						(SELECT dbo.VIEW_消耗品在庫テーブルのみ.consumables_code,
						        dbo.VIEW_消耗品在庫テーブルのみ.stock_number as f_stock_number,
								dbo.VIEW_消耗品在庫テーブルのみ.stock_quantity as f_stock_quantity  FROM dbo.VIEW_消耗品在庫テーブルのみ WHERE dbo.VIEW_消耗品在庫テーブルのみ.office_code = $office_code) AS s
                        ON s.consumables_code = m.consumables_code
						LEFT JOIN
						(SELECT dbo.VIEW_消耗品在庫テーブルのみ.consumables_code,
						        dbo.VIEW_消耗品在庫テーブルのみ.stock_number as stock_number,
								dbo.VIEW_消耗品在庫テーブルのみ.stock_quantity as stock_quantity  FROM dbo.VIEW_消耗品在庫テーブルのみ WHERE dbo.VIEW_消耗品在庫テーブルのみ.office_code = 91) AS a
                        ON a.consumables_code = m.consumables_code  Where m.consumables_category_code = $consumables_category_code and m.unit_code = 'N' ");
    }


    /**
     * 消耗品コードから消耗品を参照します。
     * @param int $consumables_category_code
     * @return unknown
     */
    public static function viewConsumablesStockData($consumables_code, $office_code)
    {
        return ConsumablesTable::viewOfficeConsumablesStock()
            ->where('consumables_code', '=', $consumables_code)
            ->where('office_code', '=', $office_code)->first();
    }

    /**
     * 消耗品コードから消耗品を取得します。
     * @param int $consumables_category_code
     * @return unknown
     */
    public static function getConsumablesStockData($consumables_code, $office_code)
    {
        return ConsumablesTable::tableConsumablesStock()
            ->where('消耗品コード', '=', $consumables_code)
            ->where('事業所コード', '=', $office_code);
    }


    // 消耗品仕入テーブル
    public static function getConsumablesBuyAll()
    {
        return ConsumablesTable::tableConsumablesBuy()->get();
    }

    // 消耗品仕入テーブル
    public static function viewConsumablesBuyAll()
    {
        return ConsumablesTable::viewConsumablesBuy()->orderBy('created_at', 'desc')->get();
    }

    // 消耗品カテゴリコードから消耗品データを取得
    /**
     * @param int $consumables_buy_code
     */
    public static function viewConsumablesCategoryBuyAll($consumables_category_code)
    {
        return ConsumablesTable::viewConsumablesBuy()
            ->where('consumables_category_code', '=', $consumables_category_code)->orderBy('created_at', 'desc')->get();
    }

    // 消耗品仕入コードから消耗品データを取得
    /**
     * @param int $consumables_buy_code
     */
    public static function viewConsumablesBuyData($consumables_buy_data)
    {
        return ConsumablesTable::viewConsumablesBuy()->where('consumable_barcode', '=', $consumables_buy_data)->get();
    }

    /**
     * 出荷先事業所コードから消耗品出荷一覧を取得します。
     * @param int $office_code_to
     * @return unknown
     */
    public static function viewFacilityConsumablesShipList($office_code_to)
    {
        return ConsumablesTable::viewConsumablesShip()
            ->where('office_code_to', '=', $office_code_to)
            ->where('status_code', '=', 'S')->get();
    }

    /**
     * 事業所コードから未納品の消耗品一覧を取得します。
     * @param int $office_code
     * @param int $consumables_category_code
     * @return unknown
     */
    public static function viewFacilityCategoryConsumablesDeliverList($office_code, $status_code)
    {
        return DB::select("SELECT * FROM dbo.VIEW_消耗品出荷納品テーブル as m
                            LEFT JOIN
                            (SELECT dbo.VIEW_消耗品在庫テーブルのみ.consumables_code as a_consumables_code,
                                    dbo.VIEW_消耗品在庫テーブルのみ.stock_number as stock_number,
                                    dbo.VIEW_消耗品在庫テーブルのみ.stock_quantity as stock_quantity
                                    FROM dbo.VIEW_消耗品在庫テーブルのみ
                                    WHERE dbo.VIEW_消耗品在庫テーブルのみ.office_code = $office_code) AS a
                            ON a_consumables_code = m.consumables_code 
                            Where m.office_code_to = $office_code and m.status_code = '$status_code'");
    }

    /**
     * 施設QRコードから未納品の消耗品リストを取得します。
     * @param int $office_code, 
     * @return unknown
     */
    public static function viewFacilityConsumablesShip($office_qrcode)
    {
        return ConsumablesTable::viewConsumablesShip()
            ->where('qr_code', '=', $office_qrcode)
            ->where('status_code', '=', 'S')->get();
    }

    /**
     * 出荷納品コードからデータを取得します。
     * @param int $ship_code, 
     * @return unknown
     */
    public static function viewConsumablesShipData($ship_code)
    {
        return ConsumablesTable::viewConsumablesShip()
            ->where('ship_code', '=', $ship_code)->first();
    }

    /**
     * 出荷納品コードからデータを取得します。
     * @param int $ship_code, 
     * @return unknown
     */
    public static function getConsumablesShipData($ship_code)
    {
        return ConsumablesTable::tableConsumablesShip()
            ->where('出荷納品コード', '=', $ship_code);
    }
}
