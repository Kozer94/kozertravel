@extends('admin.layout')
@section('title', 'الوجهات الشائعة')

@section('content')
<div class="table-card">
    <div class="table-header">
        <h3>✈️ الوجهات الشائعة ({{ $routes->count() }})</h3>
        <a href="{{ route('admin.routes.create') }}" class="btn btn-primary">+ إضافة وجهة</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>الترتيب</th><th>من</th><th>إلى</th><th>الاسم (عربي)</th><th>الاسم (إنجليزي)</th><th>الحالة</th><th>إجراءات</th>
            </tr>
        </thead>
        <tbody>
            @forelse($routes as $route)
            <tr>
                <td>{{ $route->sort_order }}</td>
                <td><strong>{{ $route->origin }}</strong></td>
                <td><strong>{{ $route->destination }}</strong></td>
                <td>{{ $route->label_ar }}</td>
                <td>{{ $route->label_en }}</td>
                <td>
                    <span class="badge {{ $route->is_active ? 'badge-green' : 'badge-red' }}">
                        {{ $route->is_active ? 'مفعّل' : 'موقوف' }}
                    </span>
                </td>
                <td style="display:flex;gap:0.4rem">
                    <a href="{{ route('admin.routes.edit', $route) }}" class="btn btn-sm btn-secondary">✏️ تعديل</a>
                    <form method="POST" action="{{ route('admin.routes.destroy', $route) }}" onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">🗑 حذف</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="7" style="text-align:center;color:#aaa;padding:2rem">لا توجد وجهات. أضف وجهة جديدة.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
