<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class ConsultationHoursController extends Controller
{
    public function show(Request $request){
        $user = \Auth::user();
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
        $consultation_hours = $user->consultation_hours()->get();
        
        // 今日から7日間の日付配列作成
        $dates = array();
        $today = date('Ymd');
        
        for($i=0; $i<7; $i++){
            $date = date('Ymd', strtotime("+{$i} day"));
            $dates[] = $date;
        }
        
        $collectWeeks = ['日','月','火','水','木','金','土'];
        
        // ユーザ詳細ビューでそれを表示
        return view('clinics.show', [
            'user'=>$user,
            'timePeriods'=>$timePeriods,
            'consultaion_hours'=>$consultation_hours,
            'dates'=>$dates,
            'collectWeeks'=>$collectWeeks,
        ]);
    }
    
    public function edit(Request $request){
        $user = \Auth::user();
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
        
        $weeks = ['月','火','水','木','金','土','日'];
    
    
        //データベースから診療時間を取得 
        $consultation_hours = $user->consultation_hours()->get();
        
    
        
        
        
        // ユーザ詳細ビューでそれを表示
        return view('clinics.edit', [
            'timePeriods'=>$timePeriods,
            'weeks'=>$weeks,
            'consultaion_hours'=>$consultation_hours,
        ]);
    }
    
    public function store(Request $request){
        // トランザクション処理を追加する
        // 同時に他のユーザーも同じボタンを押した場合に
        
        $isExist = \Auth::user()->consultation_hours()
                        ->where('week', $request->week)
                        ->where('time', $request->time)
                        ->exists();
        
        if(!$isExist){
        //     // 追加の処理
          \Auth::user()->consultation_hours()->create([
                'week'=>$request->week,
                'time'=>$request->time,
            ]);
            
             $param = [
                'data'=>'〇',
            ];
        // storeはリダイレクトか、トップページに飛ばす
            return response()->json($param);
        }else{
            $consultationHour =  \Auth::user()->consultation_hours()
                        ->where('week', $request->week)
                        ->where('time', $request->time)
                        ->first();
            $consultationHour->delete();
             $param = [
                'data'=>'-',
             ];
            return response()->json($param);
        }
        
       
    }
    
    public function destroy(Request $request){
        $user = \Auth::user();
        
        $consultationHour = $user->consultation_hours()
                        ->where('week', $request->week)
                        ->where('time', $request->time)
                        ->first();
        
        
        $consultationHour->delete();
        
        return back();
    
    }
    
    
}


// 診療可能時間があるか、予約枠があるか