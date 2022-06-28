<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Base\ApiController;
use App\Models\Data\ConsumablesData;
use App\Models\Consumables;
use Illuminate\Support\Facades\Log;
use App\Models\Data\BaseData;
use App\Models\Data\OfficeData;
use App\Models\Data\Table\ConsumablesTable;
use Exception;

class NoticeController extends ApiController
{

    /**
     * 在庫不足通知
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function notice_shortage_list(Request $request)
    {
        
        $office_code = $this->login->office_code;
        if($office_code == 91 or $office_code == 99) {

            // 不足在庫を全て取得
            $stock_shortage_all = ConsumablesTable::viewConsumablesStockShortage()
            ->whereNotIn('office_code', [91])
            ->get();
            // 施設ごとに在庫不足の消耗品データを取得
            // $shortage_list = ConsumablesData::viewConsumablesStockShortageAll();
    
            $data = [
                'stock_shortage_all' => $stock_shortage_all,
                // 'shortage_list' => $shortage_list,
                'login' => $this->login,
            ];
            // カードの中だけのhtmlを作成
            $html = view('notice.shortage', $data)->render();
    
            return self::jsonHtml($request, $html, $data);
            // return self::view($request, 'notice.shortage', $data);
        } else {
            // カードの中だけのhtmlを作成
            $html = '';
    
            return self::jsonHtml($request, $html);
        }

    }
}
