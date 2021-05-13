<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function show(){
        // データを取得（10ページまで表示できる）
        $inquiries = Inquiry::orderBy('id','desc')->paginate(10);
        // データを参照し、history画面を表示
        return view('history', ['inquiries' => $inquiries]);
    }
}
