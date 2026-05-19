<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;

class SubscribersController extends Controller
{
    public function index()
    {
        $subscribers = Subscriber::latest()->paginate(50);
        return view('admin.subscribers.index', compact('subscribers'));
    }

    public function export()
    {
        $subscribers = Subscriber::latest()->get(['email', 'created_at']);

        $csv = "Email,Date\n";
        foreach ($subscribers as $s) {
            $csv .= "\"{$s->email}\",\"{$s->created_at}\"\n";
        }

        return response($csv, 200, [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="subscribers-' . now()->format('Y-m-d') . '.csv"',
        ]);
    }
}
