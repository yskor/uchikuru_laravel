<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Data\Table\OfficeTable;

/**
 * 事業所データクラス
 * 
 * @author Kodo Hori
 *
 */
class OfficeData extends Model
{
    use HasFactory;
    
    /**
     * 指定された事業所コードから事業所情報の一覧を取得します。
     * @param int $office_code
     * @return unknown
     */
    public static function getOffice(int $office_code)
    {
        return OfficeTable::viewOfficeMaster()->where('office_code', '=', $office_code)->first();
    }

    /**
     *　事業所マスタから対象施設のデータを参照します。
     * @param string $facility_code
     */
    public static function viewFacilityAll()
    {
        return OfficeTable::viewOfficeMaster()->where('care_flag', '=', 1)->get();
    }

    /**
     *　事業所マスタから対象施設のデータを参照します。
     * @param string $office_code
     */
    public static function viewOfficeAll()
    {
        return OfficeTable::viewOfficeMaster()->where('care_flag', '=', 0)->get();
    }
}
