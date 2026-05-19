<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PopularRoute;
use Illuminate\Http\Request;

class RoutesController extends Controller
{
    public function index()
    {
        $routes = PopularRoute::orderBy('sort_order')->get();
        return view('admin.routes.index', compact('routes'));
    }

    public function create()
    {
        return view('admin.routes.form', ['route' => null]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'origin'      => 'required|string|size:3',
            'destination' => 'required|string|size:3',
            'label_ar'    => 'required|string|max:100',
            'label_en'    => 'required|string|max:100',
            'sort_order'  => 'nullable|integer',
            'is_active'   => 'nullable|boolean',
        ]);

        $data['origin']      = strtoupper($data['origin']);
        $data['destination'] = strtoupper($data['destination']);
        $data['is_active']   = $request->has('is_active') ? 1 : 0;
        $data['sort_order']  = $data['sort_order'] ?? 0;

        PopularRoute::create($data);

        return redirect()->route('admin.routes.index')->with('success', 'تم إضافة المسار بنجاح');
    }

    public function edit(PopularRoute $route)
    {
        return view('admin.routes.form', compact('route'));
    }

    public function update(Request $request, PopularRoute $route)
    {
        $data = $request->validate([
            'origin'      => 'required|string|size:3',
            'destination' => 'required|string|size:3',
            'label_ar'    => 'required|string|max:100',
            'label_en'    => 'required|string|max:100',
            'sort_order'  => 'nullable|integer',
            'is_active'   => 'nullable|boolean',
        ]);

        $data['origin']      = strtoupper($data['origin']);
        $data['destination'] = strtoupper($data['destination']);
        $data['is_active']   = $request->has('is_active') ? 1 : 0;
        $data['sort_order']  = $data['sort_order'] ?? 0;

        $route->update($data);

        return redirect()->route('admin.routes.index')->with('success', 'تم تحديث المسار بنجاح');
    }

    public function destroy(PopularRoute $route)
    {
        $route->delete();
        return redirect()->route('admin.routes.index')->with('success', 'تم حذف المسار');
    }
}
