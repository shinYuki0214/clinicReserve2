<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    //
    protected $fillable = ['name','email','tel','date','time'];
    
    // ユーザーと予約で1対多の関係にする
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    
}
