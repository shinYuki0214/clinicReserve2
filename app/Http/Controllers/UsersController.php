<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User; //追加

class UsersController extends Controller
{
    
    public function index(){
        // ユーザー一覧をidの降順で取得
        $users = User::orderBy('id', 'desc')->paginate(10);
        
        // ユーザ一覧ビューでそれを表示
        return view('administrator.index', [
            'users' => $users,
        ]);
    }
    
    
}
