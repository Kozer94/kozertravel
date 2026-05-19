@extends('admin.layout')
@section('title', 'المدونة')

@section('content')
<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem">
    <h2 style="font-size:1.2rem">مقالات المدونة ({{ $posts->total() }})</h2>
    <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">+ مقال جديد</a>
</div>

<div class="table-card">
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>العنوان</th>
                <th>الحالة</th>
                <th>تاريخ النشر</th>
                <th>إجراءات</th>
            </tr>
        </thead>
        <tbody>
            @forelse($posts as $post)
            <tr>
                <td>{{ $post->id }}</td>
                <td>
                    <strong>{{ $post->title }}</strong><br>
                    <small style="color:#888">/blog/{{ $post->slug }}</small>
                </td>
                <td>
                    @if($post->is_published)
                        <span class="badge badge-green">منشور</span>
                    @else
                        <span class="badge badge-yellow">مسودة</span>
                    @endif
                </td>
                <td>{{ $post->published_at?->format('Y-m-d') ?? '—' }}</td>
                <td>
                    <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-sm btn-secondary">تعديل</a>
                    <form method="POST" action="{{ route('admin.posts.destroy', $post) }}" style="display:inline" onsubmit="return confirm('حذف هذا المقال؟')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">حذف</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" style="text-align:center;padding:2rem;color:#888">لا توجد مقالات بعد</td></tr>
            @endforelse
        </tbody>
    </table>
    @if($posts->hasPages())
    <div style="padding:1rem">{{ $posts->links() }}</div>
    @endif
</div>
@endsection
