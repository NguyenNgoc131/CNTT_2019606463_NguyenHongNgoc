<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\AccountVerification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendVerificationEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $verification;

    public function __construct(User $user, AccountVerification $verification)
    {
        $this->user = $user;
        $this->verification = $verification;
    }

    public function handle()
    {
        // Gửi email xác minh
        Mail::send('user.account-verification', ['verification' => $this->verification], function ($message) {
            $message->to($this->user->email, $this->user->name);
            $message->from(env('MAIL_USERNAME'), 'VietBidding');
            $message->subject('Xác minh tài khoản VietBidding của bạn');
        });
    }
}
