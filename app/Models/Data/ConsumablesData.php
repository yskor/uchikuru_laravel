<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Data\Table\ConsumablesTable;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
     *　消耗品カテゴリごとの消耗品の一覧を取得します。
     * @param string $consumables_code
     */
    public static function viewConsumablesAll($consumables_code)
    {
        return ConsumablesTable::viewConsumablesMaster($consumables_code)->get();
    }

    /**
     * 消耗品種別マスタから全てのカテゴリデータを取得します。

     */
    public static function viewConsumablesCategoryAll()
    {
        return ConsumablesTable::viewConsumablesCategoryMaster()->OrderBy('sort_order', 'asc')->get();
    }

    /**
     * 消耗品識別マスタから全てのデータを取得します。

     */
    public static function viewConsumablesIdAll()
    {
        return ConsumablesTable::viewConsumablesIdMaster()->where('unit_code', '=', 'N')->OrderBy('consumables_code', 'asc')->get();
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
            ->where('unit_code', '=', $unit_code)
            ->first();
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
     * キーワードから消耗品の一覧を取得します。
     * @param string $consumables_category_code
     * @return unknown
     */
    public static function viewCategoryConsumablesSearchList($consumables_category_code, $search_name)
    {
        if ($consumables_category_code) {
            return ConsumablesTable::viewConsumablesIdMaster()
                ->where('consumables_category_code', '=', $consumables_category_code)
                ->where('unit_code', '=', 'N')
                ->where('consumables_name', 'like', '%' . $search_name . '%')
                ->get();
        } else {
            return ConsumablesTable::viewConsumablesIdMaster()
                ->where('unit_code', '=', 'N')
                ->where('consumables_name', 'like', '%' . $search_name . '%')
                ->orderBy('consumables_code')
                ->get();
        }
        
    }

    /**
     * キーワードから消耗品の一覧を取得します。
     * @param string $consumables_category_code
     * @return unknown
     */
    public static function viewDeliverStatusSearchList($search_name)
    {
        return ConsumablesTable::viewConsumablesIdMaster()
            ->where('unit_code', '=', 'N')
            ->where('consumables_name', 'like', '%' . $search_name . '%')
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
     *　消耗品バーコード(個数）から消耗品を参照します。
     * @param string $consumables_code
     */
    public static function viewShipConsumablesBarcode($consumables_barcode)
    {
        return ConsumablesTable::viewConsumablesIdMaster()
            ->where('consumables_barcode', '=', $consumables_barcode)
            ->where('unit_code', '=', 'N')
            ->first();
    }

    /**
     *　消耗品バーコードから消耗品を参照します。
     * @param string $consumables_code
     */
    public static function viewBuyConsumablesBarcode($consumables_barcode)
    {
        return ConsumablesTable::viewConsumablesIdMaster()
            ->where('consumables_barcode', '=', $consumables_barcode)
            // ->where('unit_code', '=', 'B')
            ->first();
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
     *　消耗品在庫テーブルから全てのデータを参照します。
     */
    public static function viewOfficeConsumablesStockAll()
    {
        return ConsumablesTable::viewOfficeConsumablesStock()->get();
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
     * 消耗品コードから消耗品を参照します。
     * @param int $consumables_category_code
     * @return unknown
     */
    public static function viewConsumablesStockSearchData($consumables_category_code, $office_code, $search_name)
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
                        ON a.consumables_code = m.consumables_code  Where m.consumables_category_code = $consumables_category_code and m.unit_code = 'N' and m.consumables_name LIKE '%$search_name%' ");
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
    public static function viewConsumablesBuyAll()
    {
        return ConsumablesTable::viewConsumablesBuy()->orderBy('created_at', 'desc')->get();
    }

    // 消耗品仕入先マスタ参照
    public static function viewConsumablesBuyFacility($office_code)
    {   
        if($office_code) {
            return ConsumablesTable::viewConsumablesBuyFacility($office_code)
                    ->where('office_code', '=', $office_code)->get();
        } else {
            return ConsumablesTable::viewConsumablesBuyFacility($office_code)->get();
        }
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

    // 消耗品カテゴリコードから消耗品データを取得
    /**
     * @param int $consumables_buy_code
     */
    public static function viewConsumablesCategoryBuySearchAll($consumables_category_code, $search_name)
    {
        return ConsumablesTable::viewConsumablesBuy()
            ->where('consumables_category_code', '=', $consumables_category_code)
            ->where('consumables_name', 'like', '%' . $search_name . '%')
            ->orderBy('created_at', 'desc')->get();
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
            ->where('status_code', '=', 'S')
            ->orderBy('ship_code', 'desc')
            ->get();
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
            ->where('status_code', '=', 'S')
            ->orderBy('ship_code', 'desc')
            ->get();
    }

    /**
     * 出荷納品コードからデータを参照します。
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

    /**
     * 事業所コードから指定した期間の出荷数量合計を取得します。
     * @param int $consumables_code
     * @param date $start_at
     * @param date $end_at
     * @return unknown
     */
    public static function viewConsumablesShipStatus($consumables_code)
    {
        return ConsumablesTable::viewConsumablesShipStatus()->where('consumables_code', '=', $consumables_code);
    }

    /**
     * 今日から前8週までの週ごとの集計を取得します。
     * @param int $consumables_code
     * @param date $start_at
     * @param date $end_at
     * @return unknown
     */
    public static function viewConsumablesDeliverStatusWeek($facility_all, $consumables_code)
    {
        $status_list = array(); // 施設ごとのデータを格納する変数
        foreach($facility_all as $facility) {
            $status = array(); // 各週のデータを格納する変数
            $total_deliver = 0; //総合計値
            // 集計する機関の日付を繰り返す
            for($i = 8; $i > 0; $i--) {
                $dt = Carbon::today(); //今日
                $dt->startOfWeek()->subDay(1); // 週始め
                $start_at = $dt->subWeeks($i-1); //各週始め
                $dt = Carbon::today(); //今日
                $dt->endOfWeek()->subDay(1); // 週末
                $end_at = $dt->subWeeks($i-1); //各週末
                
                //　週ごとの集計値を取得
                $week_status = ConsumablesTable::viewConsumablesDeliverStatus()
                            ->where('consumables_code', '=', $consumables_code)
                            ->where('office_code', '=', $facility->office_code)
                            ->whereBetween('delivered_at', [$start_at, $end_at])
                            ->selectRaw('SUM(delivered_number) AS week_delivered')
                            ->groupBy(
                                'office_code',
                                'consumables_code',
                                'office_code_from',
                            )->first();
                //値がない時は0
                if($week_status) {
                    $status[] = $week_status->week_delivered; //配列に各週の合計値
                    $total_deliver += $week_status->week_delivered;
                } else {
                    $status[] = 0;
                }
            };
            $status[] = $total_deliver; //配列の最後に総合計値
            $status_list[$facility->facility_name] = $status; //施設名をキーにデータを格納
        }
        return $status_list;
    }

    /**
     * 過去1年間の集計を取得します。
     * @param int $consumables_code
     * @param date $start_at
     * @param date $end_at
     * @return unknown
     */
    public static function viewConsumablesDeliverStatusMonth($facility_all, $consumables_code)
    {
        $status_list = array(); // 施設ごとのデータを格納する変数
        foreach($facility_all as $facility) {
            $status = array(); // 各月のデータを格納する変数
            $total_deliver = 0; //総合計値
            for($i = 12; $i > 0; $i--) {
                $now = Carbon::now(); //現在時刻
                $month = $now->subMonths($i-1); //各月
                $start_at = $month->startOfMonth()->toDateString(); // 月初
                $end_at = $month->endOfMonth()->toDateString(); // 月初
                // 　月ごとの集計値を取得
                $month_status = ConsumablesTable::viewConsumablesDeliverStatus()
                            ->where('consumables_code', '=', $consumables_code)
                            ->where('office_code', '=', $facility->office_code)
                            ->whereBetween('delivered_at', [$start_at, $end_at])
                            ->selectRaw('SUM(delivered_number) AS month_delivered')
                            ->groupBy(
                                'office_code',
                                'consumables_code',
                                'office_code_from',
                            )->first();
                // 値がない時は0
                if($month_status) {
                    $status[] = $month_status->month_delivered; //配列に各週の合計値
                    $total_deliver += $month_status->month_delivered;
                } else {
                    $status[] = 0;
                }
            };
            $status[] = $total_deliver; //配列の最後に総合計値
            $status_list[$facility->facility_name] = $status; //施設名をキーにデータを格納
        }
        return $status_list;
    }

    /**
     * 出荷納品コードからデータを参照します。
     * @param int $consumables_code, 
     * @return unknown
     */
    public static function viewConsumablesShipAll($consumables_code)
    {
        return ConsumablesTable::viewConsumablesShip()
            ->where('consumables_code', '=', $consumables_code);
    }

}
