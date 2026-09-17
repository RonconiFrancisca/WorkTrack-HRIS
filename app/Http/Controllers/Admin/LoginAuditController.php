<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LoginAudit;
use Illuminate\View\View;

class LoginAuditController extends Controller
{
    public function index(): View
    {
        $loginAudits = LoginAudit::with('user')
            ->latest('logged_in_at')
            ->paginate(20);

        return view('admin.login-audits.index', compact('loginAudits'));
    }
}