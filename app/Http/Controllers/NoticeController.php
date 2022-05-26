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
        
        $shortage_list = ConsumablesData::viewConsumablesStockShortageAll();

        $data = [
            'shortage_list' => $shortage_list,
            'login' => $this->login,
        ];
        // カードの中だけのhtmlを作成
        // $html = view('notice.shortage', $data)->render();

        // return self::jsonHtml($request, $html, $data); //← 共通システム側で res.html で取得できるようになります。
        return self::view($request, 'notice.shortage', $data);

    }
}
