<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Quality extends Model
{
    protected  $table = 'quality';
    public $timestamps = true ;
    protected $primaryKey = 'id';
    protected $guarded = [];


    public static function look_list()
    {
        try {
            $res =  self::select()->get();

            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }


}
