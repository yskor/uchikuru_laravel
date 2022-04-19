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
use Illuminate\Support\Facades\Log;


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
        $consumables_category_all = ConsumablesData::getConsumablesCategoryAll();
        // 事業所マスタから事業所を全て参照
        $facility_all = OfficeData::viewfacilityAll();
 
        $data = [
            'param' => $param,
            'facility_all' => $facility_all, //全ての事業所データ
            'consumables_category_all' => $consumables_category_all, 
            'login' => $this->login,
            'office_code' => 'all'
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
        $consumables_category_all = ConsumablesData::getConsumablesCategoryAll();
        // 事業所マスタから事業所を全て参照
        $facility_all = OfficeData::viewfacilityAll();
        // 対象事業所の消耗品出荷データを取得＊バーコードが増えた時に対応できていない
        $consumables_ship_list = ConsumablesData::viewFacilityConsumablesShipList($office_code);
        
        $data = [
            'facility_all' => $facility_all, //全ての事業所データ
            'consumables_category_all' => $consumables_category_all, //全てのカテゴリデータ
            'consumables_ship_list' => $consumables_ship_list, //対象の事業所出荷一覧
            'login' => $this->login,
            'office_code' => $office_code //事業所コード
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
        $office_code = $request->office_code;
        // if ($request->office_code) {
        // } else {
        //     $office_code = 'all';
        // }

        // 消耗品カテゴリデータを取得
        $consumables_category_all = ConsumablesData::getConsumablesCategoryAll();
        // 事業所マスタから事業所を全て参照
        $facility_all = OfficeData::viewfacilityAll();

        // $handy_reader_dataとバーコードが一致するデータを参照
        $consumables_ship_data = ConsumablesData::viewConsumablesBarcode($handy_reader_data);

        // $ship_addが1の時はカードの中身だけを増やす
        if ($ship_add == 0) {
            if ($consumables_ship_data) {
                // 在庫を増やす
                // Consumables::insert_consumables_ship($ship_quantity, $consumables_ship_data->consumables_code);
            } else {
                $consumables_ship_data = 0;
            }
            // データに渡したいデータを格納
            $data = [
                'facility_all' => $facility_all, //全ての事業所データ
                'consumables_category_all' => $consumables_category_all, //全てのカテゴリデータ
                'handy_reader_data' => $handy_reader_data,
                'consumables_ship_data' => $consumables_ship_data,
                'login' => $this->login,
                'office_code' => $office_code
            ];
            // htmlを作成
            $html = view('include.ship_add', $data)->render();
            
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
                'office_code' => $office_code
            ];
            // カードの中だけのhtmlを作成
            $html = view('include.ship_consumables', $data)->render();
            
            // htmlとデータをJson形式で返す
            return self::jsonHtml($request, $html, $data);
        }
    }

    //
    /**
     * 消耗品出荷リストの編集
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit_ship(Request $request)
    {
        Log::debug(print_r($this->login, true));
        // POSTの値を全て取得
        $param = $request->all();
        // dd($param);
        $office_code_to = $param['office_code_to']; //納品先事業所コード
        $office_code_from = 91; //出荷元事業所コード（今はアシスト固定）
        $staff_code = $param['staff_code'];
        // 消耗品カテゴリデータを取得
        $consumables_category_all = ConsumablesData::getConsumablesCategoryAll();
        // 事業所マスタから事業所を全て参照
        $facility_all = OfficeData::viewfacilityAll();
        foreach ($param['ships'] as $data) {
            // dd($data);
            // 出荷納品テーブルに追加
            Consumables::insert_consumables_ship(
                $data['consumables_code'], //消耗品コード
                $office_code_from, //出荷元事業所コード
                $data['ship_number'], //出荷数
                $staff_code, //職員コード
                // $data['ship_date'], //出荷日
                $office_code_to, //納品先事業所コード
            ); 
        } 

        $data = [
            'param' => $param, //全ての事業所データ
            'facility_all' => $facility_all, //全ての事業所データ
            'consumables_category_all' => $consumables_category_all, 
            'login' => $this->login,
            'office_code' => 'all'
        ];
        
        return self::view($request, 'ship_list', $data);
    }

    //
    /**
     * 消耗品出荷リストの編集
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
        $staff_code = $param['staff_code'];
        // 消耗品カテゴリデータを取得
        $consumables_category_all = ConsumablesData::getConsumablesCategoryAll();
        // 事業所マスタから事業所を全て参照
        $facility_all = OfficeData::viewfacilityAll();
        foreach ($param['ships'] as $data) {
            // dd($data);
            // 出荷納品テーブルに追加
            Consumables::insert_consumables_ship(
                $data['consumables_code'], //消耗品コード
                $office_code_from, //出荷元事業所コード
                $data['ship_number'], //出荷数
                $staff_code, //職員コード
                // $data['ship_date'], //出荷日
                $office_code_to, //納品先事業所コード
            ); 
        }

        // 対象事業所とアシストの消耗品在庫データを取得＊バーコードが増えた時に対応できていない
        $consumables_ship_list = ConsumablesData::viewFacilityConsumablesShipList($office_code);

        $data = [
            'facility_all' => $facility_all, //全ての事業所データ
            'consumables_category_all' => $consumables_category_all, //全てのカテゴリデータ
            'consumables_ship_list' => $consumables_ship_list, //対象の事業所出荷一覧
            'login' => $this->login,
            'office_code' => $office_code //事業所コード
        ];
        
        return self::view($request, 'facility_ship_list', $data);
    }

    /**
     * 読み込んだバーコードに紐づく消耗品の出荷画面を表示します。
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function ship_consumables_test(Request $request)
    {
        Log::debug(print_r($this->login, true));
        $handy_reader_data = $request->handy_reader_data;
        // 消耗品カテゴリデータを取得
        $consumables_category_all = ConsumablesData::getConsumablesCategoryAll();
        // 事業所マスタから事業所を全て参照
        $facility_all = OfficeData::viewfacilityAll();
        // 対象事業所とアシストの消耗品在庫データを取得＊バーコードが増えた時に対応できていない
        // $consumables_ship_list = ConsumablesData::viewFacilityConsumablesShipList($office_code);
        
        // $handy_reader_dataとバーコードが一致するデータを参照
        $consumables_ship_data = ConsumablesData::viewConsumablesBarcode($handy_reader_data);
        // 消耗品が取得できた場合
                if ($consumables_ship_data) {
            // 在庫を増やす
            // Consumables::insert_consumables_ship($ship_quantity, $consumables_ship_data->consumables_code);
        } else {
            // 消耗品が取得できなかった場合
            $consumables_ship_data = 0;
        }
        // データに渡したいデータを格納
        $data = [
            
            'facility_all' => $facility_all, //全ての事業所データ
            'consumables_category_all' => $consumables_category_all, //全てのカテゴリデータ
            // 'consumables_ship_list' => $consumables_ship_list, //対象の事業所出荷一覧
            'handy_reader_data' => $handy_reader_data,
            'consumables_ship_data' => $consumables_ship_data,
            'login' => $this->login,
            'office_code' => 'all'
        ];
        // // htmlを作成
        // $html = view('modal.ship_consumables', $data)->render();
        
        // // htmlとデータをJson形式で返す
        // return self::jsonHtml($request, $html, $data);
        return self::view($request, 'ship_list', $data);
    }
        
}
