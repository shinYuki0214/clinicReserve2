<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConsultationHour extends Model
{
    protected $fillable = ['week','time'];
    //
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    
    // データがあるどうかの関数を作る。データベースから配列を取得して、その配列中でデータがあるかどうか判断する
    public static function isExists($consulutionHours, $week, $time)
    {
        // $consulutionHours に、$weekと$timeを持つものがあるかどうか？をreturn
        
        
    }
}