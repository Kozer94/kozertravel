<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementsController extends Controller
{
    public function index()
    {
        $announcements = Announcement::orderByDesc('created_at')->get();
        return view('admin.announcements.index', compact('announcements'));
    }

    public function create()
    {
        return view('admin.announcements.form', ['announcement' => null]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'     => 'required|string|max:200',
            'content'   => 'required|string',
            'type'      => 'required|in:banner,popup',
            'is_active' => 'nullable|boolean',
            'starts_at' => 'nullable|date',
            'ends_at'   => 'nullable|date|after_or_equal:starts_at',
        ]);

        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        Announcement::create($data);

        return redirect()->route('admin.announcements.index')->with('success', 'تم إضافة الإعلان بنجاح');
    }

    public function edit(Announcement $announcement)
    {
        return view('admin.announcements.form', compact('announcement'));
    }

    public function update(Request $request, Announcement $announcement)
    {
        $data = $request->validate([
            'title'     => 'required|string|max:200',
            'content'   => 'required|string',
            'type'      => 'required|in:banner,popup',
            'is_active' => 'nullable|boolean',
            'starts_at' => 'nullable|date',
            'ends_at'   => 'nullable|date|after_or_equal:starts_at',
        ]);

        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        $announcement->update($data);

        return redirect()->route('admin.announcements.index')->with('success', 'تم تحديث الإعلان بنجاح');
    }

    public function destroy(Announcement $announcement)
    {
        $announcement->delete();
        return redirect()->route('admin.announcements.index')->with('success', 'تم حذف الإعلان');
    }
}
