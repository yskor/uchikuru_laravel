<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Base\AuthController;
use App\Http\Controllers\Base\ActionController;
use App\Models\Data\ConsumablesData;
use App\Models\Consumables;
use App\Models\Data\OfficeData;
use App\Models\Data\Table\ConsumablesTable;
use App\Models\Data\Table\OfficeTable;
use Exception;
use Illuminate\Support\Facades\Log;


class NotStockException extends Exception
{
}
class ShipException extends Exception
{
}
class QrException extends Exception
{
}

class ShipController extends AuthController
{
    //
    /**
     * 消耗品出荷一覧を表示します。
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function ship_list(Request $request)
    {
        Log::debug(print_r($this->login, true));

        $param = $request->all();
        // 消耗品カテゴリデータを取得
        $consumables_category_all = ConsumablesData::viewConsumablesCategoryAll();
        // 事業所マスタから事業所を全て参照
        $facility_all = OfficeData::viewfacilityAll();

        $data = [
            'param' => $param,
            'facility_all' => $facility_all, //全ての事業所データ
            'consumables_category_all' => $consumables_category_all,
            'login' => $this->login,
            'office_code' => 'all', //事業所コード
        ];
        // dd($data);
        return self::view($request, 'ship_list', $data);
    }

    //
    /**
     * 事業所別の消耗品出荷一覧を表示します。
     * @param int $consumables_category_code
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function facility_ship_list($office_code, Request $request)
    {
        Log::debug(print_r($this->login, true));

        // 消耗品カテゴリデータを取得
        $consumables_category_all = ConsumablesData::viewConsumablesCategoryAll();
        // 事業所マスタから事業所を全て参照
        $facility_all = OfficeData::viewfacilityAll();
        // 事業所データ
        $office_data = OfficeData::getOffice($office_code);
        // 対象事業所の消耗品出荷データを取得
        $consumables_ship_list = ConsumablesData::viewFacilityConsumablesShipList($office_code);

        $data = [
            'facility_all' => $facility_all, //全ての事業所データ
            'consumables_category_all' => $consumables_category_all, //全てのカテゴリデータ
            'consumables_ship_list' => $consumables_ship_list, //対象の事業所出荷一覧
            'login' => $this->login,
            'office_code' => $office_code, //事業所コード
            'office_data' => $office_data, //事業所データ
        ];
        // dd(!empty($data['consumables_ship_list']));
        return self::view($request, 'facility_ship_list', $data);
    }

    /**
     * 読み込んだバーコードに紐づく消耗品の出荷画面を表示します。
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function ship_consumables(Request $request)
    {
        Log::debug(print_r($this->login, true));
        // バーコードリーダーで読み取った数字を取得
        $handy_reader_data = $request->handy_reader_data;
        $ship_add = $request->ship_add;
        $office_code_from = 91; // アシスト固定
        $office_code = $request->office_code;

        // 消耗品カテゴリデータを取得
        $consumables_category_all = ConsumablesData::viewConsumablesCategoryAll();
        // 事業所マスタから事業所を全て参照
        $facility_all = OfficeData::viewfacilityAll();
        // 事業所データ
        $office_data = OfficeData::getOffice($office_code);
        // $handy_reader_dataとバーコードが一致するデータを参照
        try {
            // QRコードから消耗品を取得
            $consumables_ship_data = ConsumablesData::viewShipConsumablesBarcode($handy_reader_data);
            // 消耗品があるか
            if ($consumables_ship_data) {
                $consumables_code = $consumables_ship_data->consumables_code;
                // 在庫があるか確認
                $consumables_stock = ConsumablesData::viewConsumablesStockData($consumables_code, $office_code_from);
                if ($consumables_stock) {
                    if($consumables_stock->stock_number > 0) {
                        // $ship_addが1の時はカードの中身だけを増やす
                        if ($ship_add == 0) {
                            // データに渡したいデータを格納
                            $data = [
                                'facility_all' => $facility_all, //全ての事業所データ
                                'consumables_category_all' => $consumables_category_all, //全てのカテゴリデータ
                                'handy_reader_data' => $handy_reader_data,
                                'consumables_ship_data' => $consumables_ship_data,
                                'login' => $this->login,
                                'office_code' => $office_code,
                                'office_data' => $office_data,
                            ];
                            // htmlを作成
                            $html = view('include.ship.ship_add', $data)->render();
    
                            // htmlとデータをJson形式で返す
                            return self::jsonHtml($request, $html, $data);
                        } elseif ($ship_add == 1) {
                            // データに渡したいデータを格納
                            $data = [
                                'facility_all' => $facility_all, //全ての事業所データ
                                'consumables_category_all' => $consumables_category_all, //全てのカテゴリデータ
                                'handy_reader_data' => $handy_reader_data,
                                'consumables_ship_data' => $consumables_ship_data,
                                'login' => $this->login,
                                'office_code' => $office_code,
                                'office_data' => $office_data,
                            ];
                            // カードの中だけのhtmlを作成
                            $html = view('include.ship.ship_consumables', $data)->render();
    
                            // htmlとデータをJson形式で返す
                            return self::jsonHtml($request, $html, $data);
                        }
                    } else {
                        throw new Exception($consumables_ship_data->consumables_name . "は本部に在庫がありません");
                    }
                } else {
                    throw new Exception($consumables_ship_data->consumables_name . "は本部に在庫がありません");
                }
            } else {
                throw new Exception("QRコード読み取りエラー。再度QRコードを読み込んでください。");
            }
        } catch (Exception $e) {
            ConsumablesData::rollback();
            throw $e;
        }
    }

    //
    /**
     * 消耗品出荷
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function facility_edit_ship($office_code, Request $request)
    {
        Log::debug(print_r($this->login, true));
        // POSTの値を全て取得
        $param = $request->all();
        // dd($param);
        $office_code_to = $param['office_code_to']; //納品先事業所コード
        $office_code_from = 91; //出荷元事業所コード（今はアシスト固定）

        foreach ($param['ships'] as $data) {
            // dd($data);
            $value = [
                'consumables_code' => $data['consumables_code'],
                'office_code_from' => $office_code_from,//出荷元事業所コード
                'ship_quantity' => $data['ship_number'],
                'staff_code' => $this->login->staff_code,
                'replenishment_status_code' => NULL,
                'office_code_to' => $office_code_to,//納品先事業所コード
            ];
            // 出荷納品テーブルに追加
            Consumables::insert_consumables_ship($value);
        }

        return redirect()->route('facility_ship_list', ['office_code' => $office_code]);
    }

    //
    /**
     * 在庫不足消耗品の出荷
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function ship_shortage_consumables($office_code_to, $consumables_code, Request $request)
    {
        $ship_quantity = $request->get('ship_quantity');//出荷数量
        $office_code_from = 91; //出荷元事業所コード（今はアシスト固定）

        $value = [
            'consumables_code' => $consumables_code,
            'office_code_from' => $office_code_from,//出荷元事業所コード
            'ship_quantity' => $ship_quantity,
            'staff_code' => $this->login->staff_code,
            'replenishment_status_code' => "S",//在庫補充状況コード
            'office_code_to' => $office_code_to,//納品先事業所コード
        ];
        // 出荷納品テーブルに追加
        Consumables::insert_consumables_ship($value);

        return redirect()->route('shortage_consumables');
    }

    //
    /**
     * 消耗品出荷の取消
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function ship_cancel($office_code, $ship_code, $consumables_code, Request $request)
    {
        // 出荷キャンセル
        Consumables::cancel_consumables_ship(
            $ship_code, //出荷コード
            $office_code, //事業所コード
        );
        $consumables = ConsumablesData::viewOneConsumables($consumables_code);
        session()->flash('success_message', $consumables->consumables_name . 'の出荷を取り消しました');
        return redirect()->route('facility_ship_list', ['office_code' => $office_code]);

    }
}
