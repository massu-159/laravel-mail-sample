<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InquiryMail extends Mailable
{
    use Queueable, SerializesModels;
    // 使用する変数を定義
    public $email;
    public $name;
    public $relationship;
    public $content;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $data)
    {
        foreach($data as $key=>$value){
            $this->{$key} = $value;
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //subjectメソッドで件名を作成し、textメソッドで本文を作成
        return $this->subject($this->name.'さんにお知らせがあります')->text('emails.inquiry');
    }
}
