<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use App\Models\LoginAudit;

class LogSuccessfulLogin
{
    public function handle(Login $event): void
    {
        LoginAudit::create([
            'user_id'      => $event->user->id,
            'ip_address'   => request()->ip(),
            'user_agent'   => request()->userAgent(),
            'logged_in_at' => now(),
        ]);
    }
}
