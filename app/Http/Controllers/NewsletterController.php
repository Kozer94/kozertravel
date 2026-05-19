<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate(['email' => 'required|email|max:255']);

        // dedup بسيط حسب email (أقوى من firstOrCreate فقط بـ email)
        // مع حفظ ip لأول مرة
        $subscriber = Subscriber::firstOrCreate(
            ['email' => $request->email],
            ['ip'    => $request->ip()]
        );


        return back()->with('newsletter_success', true);
    }
}
