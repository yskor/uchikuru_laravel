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
     * テスト
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function notice_shortage_list(Request $request)
    {
        
        $shortage_list = ConsumablesData::viewConsumablesStockShortageAll();
        
        // dd($shortage_list);
        $data = [
            'shortage_list' => $shortage_list,
        ];
        // カードの中だけのhtmlを作成
        $html = view('notice.shortage_list', $data)->render();

        return self::jsonHtml($request, $html, $data); //← 共通システム側で res.html で取得できるようになります。
        // return self::view($request, 'notice.shortage_list', $data);

    }
}
