<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AffiliateSource;
use Illuminate\Http\Request;

class SourcesController extends Controller
{
    public function index()
    {
        $sources = AffiliateSource::orderBy('sort_order')->get();
        return view('admin.sources.index', compact('sources'));
    }

    public function edit(AffiliateSource $source)
    {
        return view('admin.sources.edit', compact('source'));
    }

    public function update(Request $request, AffiliateSource $source)
    {
        $data = $request->validate([
            'name'         => 'required|string|max:100',
            'label_ar'     => 'nullable|string|max:150',
            'label_en'     => 'nullable|string|max:150',
            'color'        => 'required|string|max:20',
            'url_template' => 'nullable|string',
            'sort_order'   => 'nullable|integer',
            'is_active'    => 'nullable|boolean',
        ]);

        $data['is_active']  = $request->has('is_active') ? 1 : 0;
        $data['sort_order'] = $data['sort_order'] ?? 0;

        $source->update($data);

        return redirect()->route('admin.sources.index')->with('success', 'تم تحديث المصدر بنجاح');
    }

    public function toggleActive(AffiliateSource $source)
    {
        $source->update(['is_active' => !$source->is_active]);
        return redirect()->route('admin.sources.index')->with('success', 'تم تحديث الحالة');
    }
}
