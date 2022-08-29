<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Http\Controllers\Controller,Session;

class ReservationController extends Controller
{
    //
    public function show(){
        // idの値でユーザを検索して取得
        $timePeriods=array();
        $start = "00:00";
        $end = "23:30";
        $tStart = strtotime($start);
        $tEnd = strtotime($end);
        $tNow = $tStart;
        while($tNow <= $tEnd){
            $theTime = date('H:i',$tNow);
            array_push($timePeriods,$theTime);
            $tNow = strtotime('+30 minutes',$tNow);
        };
    
        //データベースから診療時間を取得 
        $consultation_hours = \Auth::user()->consultation_hours()->get();
        
        // 今日から7日間の日付配列作成
        $dates = array();
        $today = date('Ymd');
        
        for($i=0; $i<7; $i++){
            $date = date('Ymd', strtotime("+{$i} day"));
            $dates[] = $date;
        }
        
        $collectWeeks = ['日','月','火','水','木','金','土'];
        
        // ユーザ詳細ビューでそれを表示
        return view('reservations.reserve', [
            'timePeriods'=>$timePeriods,
            'consultaion_hours'=>$consultation_hours,
            'dates'=>$dates,
            'collectWeeks'=>$collectWeeks,
        ]);
    }
    
    public function dateStore(Request $request){
        // idの値でユーザを検索して取得
        $user = \Auth::user();
        $thisDate = $request->date;
        $thisTimePeriods = $request->time;
        $thisMonth = date('n', strtotime($thisDate));
        $thisDay = date('d', strtotime($thisDate));
        
        Session::regenerate();
        Session::put('dateData',$thisDate);
        Session::put('timeData',$thisTimePeriods);
        return redirect()->route('reserve.edit',['id'=>\Auth::id()]);
    }
        

    public function edit(Request $request)
    {
        Session::regenerate();
        $user = \Auth::user();
        $SessionDatas = Session::all();
        $thisDate = $SessionDatas['dateData'];
        $thisTimePeriods = $SessionDatas['timeData'];
        $thisMonth = date('n', strtotime($thisDate));
        $thisDay = date('d', strtotime($thisDate));
        
        return view('reservations.form',[
            'user'=> $user,
            'thisMonth'=>$thisMonth,
            'thisDay'=>$thisDay,
            'thisDate'=>$thisDate,
            'thisTimePeriods'=>$thisTimePeriods,
            'sessionDatas'=>$SessionDatas,
        ]);
    }    
    
    
    public function store(Request $request){
        // idの値でユーザを検索して取得
        $user = \Auth::user();
        // セッションで↑のデータは取れる
        $SessionDatas = Session::all();
        $date = $SessionDatas['dateData'];
        $time = $SessionDatas['timeData'];
        
        
        
        $name = $request->name;
        $tel = $request->tel;
        $email = $request->email;
        
        
        $request->validate([
            'name' => 'required',
            'tel' => 'required',
            'email' => 'required',
        ]);
        
        //　診療時間かチェック
            // 日付の曜日を取得
        $collectWeeks = ['日','月','火','水','木','金','土'];
        $thisWeekNum = date('w', strtotime($date));
        $thisWeek = $collectWeeks[$thisWeekNum];

        $checkConsultation = $user->consultation_hours()->where('week',$thisWeek)->where('time',$time)->exists();
        
        // 別の予約者がいないか確認
        $isExist = $user->reservations()
                        ->where('date', $date)
                        ->where('time', $time)
                        ->exists();
        if(!$isExist && $checkConsultation){
            $user->reservations()->create([
                'date'=>$date,
                'time'=>$time,
                'name'=>$request->name,
                'tel'=>$request->tel,
                'email'=>$request->email,
            ]);
        }else{
        return redirect('/');
        }
        
        
        
        
        // トップページへリダイレクトさせる
        return redirect('/');
    }
}
