@extends('admin.layout')
@section('title', 'الإعلانات والبانرات')

@section('content')
<div class="table-card">
    <div class="table-header">
        <h3>📢 الإعلانات ({{ $announcements->count() }})</h3>
        <a href="{{ route('admin.announcements.create') }}" class="btn btn-primary">+ إضافة إعلان</a>
    </div>
    <table>
        <thead>
            <tr><th>العنوان</th><th>النوع</th><th>الحالة</th><th>يبدأ</th><th>ينتهي</th><th>إجراءات</th></tr>
        </thead>
        <tbody>
            @forelse($announcements as $ann)
            <tr>
                <td>
                    <strong>{{ $ann->title }}</strong>
                    <div style="font-size:0.78rem;color:#7a7a7a;margin-top:2px">{{ Str::limit($ann->content, 60) }}</div>
                </td>
                <td>
                    <span class="badge {{ $ann->type === 'banner' ? 'badge-blue' : 'badge-yellow' }}">
                        {{ $ann->type === 'banner' ? 'بانر' : 'بوب-أب' }}
                    </span>
                </td>
                <td>
                    <span class="badge {{ $ann->is_active ? 'badge-green' : 'badge-red' }}">
                        {{ $ann->is_active ? 'مفعّل' : 'موقوف' }}
                    </span>
                </td>
                <td style="font-size:0.82rem">{{ $ann->starts_at ? $ann->starts_at->format('d/m/Y') : '—' }}</td>
                <td style="font-size:0.82rem">{{ $ann->ends_at ? $ann->ends_at->format('d/m/Y') : '—' }}</td>
                <td style="display:flex;gap:0.4rem">
                    <a href="{{ route('admin.announcements.edit', $ann) }}" class="btn btn-sm btn-secondary">✏️</a>
                    <form method="POST" action="{{ route('admin.announcements.destroy', $ann) }}" onsubmit="return confirm('هل أنت متأكد؟')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">🗑</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" style="text-align:center;color:#aaa;padding:2rem">لا توجد إعلانات بعد.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
