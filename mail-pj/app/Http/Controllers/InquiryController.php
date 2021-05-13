<?php

namespace App\Http\Controllers;

use App\Http\Requests\InquiryRequest;
use App\Mail\InquiryMail;
use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class InquiryController extends Controller
{
    public function index(){
        // indexページを表示
        return view('index');
    }

    public function postInquiry(InquiryRequest $request){
        // バリデーションを設定
        $validated = $request->validated();
        // バリデーションに抵触していない内容を取得
        $request->session()->put('inquiry', $validated);
        // 確認画面にリダイレクト
        return redirect(route('confirm'));
    }

    public function showConfirm(Request $request){
        // セッションデータを取得
        $sessionData = $request->session()->get('inquiry');
        // セッションデータの入力がない場合はindex画面にリダイレクト
        if (is_null($sessionData)) {
            return redirect(route('index'));
        }
        // セッションデータをメール本文として表示
        $message = view('emails.inquiry', $sessionData);
        // メール本文を確認画面に表示
        return view('confirm', ['message' => $message]);
    }

    public function postConfirm(Request $request){
        // セッションデータを取得
        $sessionData = $request->session()->get('inquiry');
        // セッションデータの入力がない場合はindex画面にリダイレクト
        if (is_null($sessionData)) {
            return redirect(route('index'));
        }
        // センションデータを取得後にセッションデータを削除
        $request->session()->forget('inquiry');

        // セッションデータの内容をもとに、データベースを作成
        Inquiry::create($sessionData);

        // メールを送信
        Mail::to($sessionData['email'])->send(new InquiryMail($sessionData));
        
        // 完了画面にリダレクト（withメソッドで一回のみ有効なセッションデータ（フラッシュデータ）を渡す）
        return redirect(route('sent'))->with('sent_inquiry', true);
    }

    public function showSentMessage(Request $request){
        // リロードしても消えないようフラッシュデータを保存
        $request->session()->keep('sent_inquiry');
        // フラッシュデータを取得
        $sessionData = $request->session()->get('sent_inquiry');
        // セッションデータの入力がない場合はindex画面にリダイレクト
        if (is_null($sessionData)) {
            return redirect(route('index'));
        }
        // 完了画面を表示
        return view('sent');
    }
}
