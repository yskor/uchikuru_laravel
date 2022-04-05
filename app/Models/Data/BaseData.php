<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;

/**
 * データベースとやりとりする基本抽象クラス
 * @author Kodo Hori
 *
 */
abstract class BaseData extends Model
{
    use HasFactory;
    
    /**
     * SQL に WHERE 句を追加します。
     * @param Builder $query
     * @param unknown $column
     * @param unknown $value
     * @param string $operator
     * @param string $boolean
     */
    protected static function addWhere(Builder &$query, string $column, $value, string $operator = '=', string $boolean = 'and')
    {
        if( isset($value) ) {
            $query->where($column, $operator, $value, $boolean);
        }
    }
    
    protected static function addOrderBy(Builder &$query, string $column, array $orderby)
    {
        if(array_key_exists($column, $orderby) && $orderby[ $column ] != 'desc') {
            $query->orderBy($column);
        } else if(array_key_exists($column, $orderby) && $orderby[ $column ] == 'desc') {
            $query->orderByDesc($column);
        }
    }
    
    /**
     * トランザクションを開始します。
     */
    public static function beginTransaction()
    {
        DB::beginTransaction();
    }
    
    /**
     * コミットします。
     */
    public static function commit()
    {
        DB::commit();
    }
    
    /**
     * ロールバックします。
     */
    public static function rollback()
    {
        DB::rollBack();
    }
    
}