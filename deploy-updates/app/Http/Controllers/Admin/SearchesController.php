<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Search;
use Illuminate\Http\Request;

class SearchesController extends Controller
{
    public function index(Request $request)
    {
        $query = Search::orderByDesc('created_at');

        if ($request->date_from) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->date_to) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }
        if ($request->origin) {
            $query->where('origin', strtoupper($request->origin));
        }
        if ($request->destination) {
            $query->where('destination', strtoupper($request->destination));
        }

        $searches = $query->paginate(30)->withQueryString();

        return view('admin.searches.index', compact('searches'));
    }
}
