<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AffiliateClick;
use Illuminate\Http\Request;

class ClicksController extends Controller
{
    public function index(Request $request)
    {
        $query = AffiliateClick::orderByDesc('created_at');

        if ($request->date_from) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->date_to) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }
        if ($request->source) {
            $query->where('source_name', 'like', '%' . $request->source . '%');
        }

        $clicks = $query->paginate(30)->withQueryString();

        return view('admin.clicks.index', compact('clicks'));
    }
}
