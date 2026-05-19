<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (session('admin_id')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // حماية brute-force على تسجيل دخول Admin (مناسبة لـ shared hosting)
        $email = (string) $request->email;
        $ip = (string) ($request->ip() ?? '');
        $key = 'admin_login:' . strtolower($email) . ':' . $ip;
        $limit = 10; // محاولات

        $attempts = session($key, 0);
        if ($attempts >= $limit) {
            return back()->withErrors(['email' => 'تم حظر المحاولات لفترة قصيرة. حاول لاحقاً.']);
        }

        $admin = AdminUser::where('email', $email)->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            session([$key => $attempts + 1]);
            return back()->withErrors(['email' => 'البريد الإلكتروني أو كلمة المرور غير صحيحة']);
        }

        // نجاح تسجيل الدخول => إعادة تعيين العداد
        session()->forget($key);

        session(['admin_id' => $admin->id, 'admin_name' => $admin->name]);

        return redirect()->route('admin.dashboard');
    }

    public function logout()
    {
        session()->forget(['admin_id', 'admin_name']);
        return redirect()->route('admin.login');
    }
}

