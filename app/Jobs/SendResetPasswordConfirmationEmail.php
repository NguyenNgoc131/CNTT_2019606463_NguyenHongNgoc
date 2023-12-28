<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendResetPasswordConfirmationEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $token;

    public function __construct(User $user, $token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    public function handle()
    {
        // Gửi email với liên kết xác nhận đặt lại mật khẩu
        Mail::send('user.password-reset-confirm', ['user' => $this->user, 'token' => $this->token], function ($message) {
            $message->to($this->user->email, $this->user->name);
            $message->from(env('MAIL_USERNAME'), 'VietBidding');
            $message->subject('Xác nhận đặt lại mật khẩu');
        });
    }
}
