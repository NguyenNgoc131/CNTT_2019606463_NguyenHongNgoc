<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendNewPasswordEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $newPassword;

    public function __construct(User $user, $newPassword)
    {
        $this->user = $user;
        $this->newPassword = $newPassword;
    }

    public function handle()
    {
        // Gửi email với mật khẩu mới
        Mail::send('user.new-password-email', ['user' => $this->user, 'newPassword' => $this->newPassword], function ($message) {
            $message->to($this->user->email, $this->user->name);
            $message->from(env('MAIL_USERNAME'), 'VietBidding');
            $message->subject('Mật khẩu mới của bạn');
        });
    }
}
