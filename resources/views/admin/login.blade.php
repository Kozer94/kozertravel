<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>تسجيل الدخول — {{ \App\Models\SiteSetting::get('site_name_ar', 'Admin') }} Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root { --sky: #1a5fff; --sand: #f5f0e8; --ink: #0d0d0d; --ink-3: #7a7a7a; }
        body { font-family: 'Tajawal', sans-serif; background: var(--sand); display: flex; align-items: center; justify-content: center; min-height: 100vh; }
        .login-box {
            background: #fff; border-radius: 16px; padding: 2.5rem;
            width: 100%; max-width: 400px; border: 1px solid #e0dbd0;
            box-shadow: 0 4px 24px rgba(0,0,0,0.07);
        }
        .login-logo { text-align: center; margin-bottom: 2rem; }
        .login-logo h1 { font-size: 1.8rem; color: var(--sky); font-weight: 700; }
        .login-logo p { color: var(--ink-3); font-size: 0.9rem; margin-top: 0.3rem; }
        .form-group { margin-bottom: 1rem; }
        label { display: block; font-size: 0.88rem; font-weight: 500; margin-bottom: 0.4rem; color: #3a3a3a; }
        input {
            width: 100%; padding: 0.65rem 0.9rem; border: 1px solid #d0ccc4;
            border-radius: 8px; font-size: 0.95rem; font-family: 'Tajawal', sans-serif;
            transition: border-color 0.15s;
        }
        input:focus { outline: none; border-color: var(--sky); box-shadow: 0 0 0 3px rgba(26,95,255,0.1); }
        .btn-login {
            width: 100%; padding: 0.75rem; background: var(--sky); color: #fff;
            border: none; border-radius: 8px; font-size: 1rem;
            font-family: 'Tajawal', sans-serif; font-weight: 600; cursor: pointer;
            margin-top: 0.5rem; transition: background 0.15s;
        }
        .btn-login:hover { background: #1448cc; }
        .error-msg { background: #fee2e2; color: #dc2626; padding: 0.7rem 1rem; border-radius: 7px; margin-bottom: 1rem; font-size: 0.88rem; border: 1px solid #fca5a5; }
    </style>
</head>
<body>
<div class="login-box">
    <div class="login-logo">
        <h1>{{ \App\Models\SiteSetting::get('site_name_ar', 'Admin') }}</h1>
        <p>لوحة تحكم المدير</p>
    </div>
    @if($errors->any())
        <div class="error-msg">{{ $errors->first() }}</div>
    @endif
    <form method="POST" action="{{ route('admin.login.post') }}">
        @csrf
        <div class="form-group">
            <label>البريد الإلكتروني</label>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="admin@skyroute.com" required autofocus>
        </div>
        <div class="form-group">
            <label>كلمة المرور</label>
            <input type="password" name="password" placeholder="••••••••" required>
        </div>
        <button type="submit" class="btn-login">دخول ←</button>
    </form>
</div>
</body>
</html>
