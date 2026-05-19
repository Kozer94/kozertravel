@extends('admin.layout')
@section('title', 'رسائل التواصل')

@section('content')
<div class="table-card">
    <div class="table-header">
        <h3>رسائل التواصل ({{ $messages->total() }})</h3>
    </div>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>الاسم</th>
                <th>البريد</th>
                <th>الموضوع</th>
                <th>الحالة</th>
                <th>التاريخ</th>
                <th>إجراءات</th>
            </tr>
        </thead>
        <tbody>
            @forelse($messages as $msg)
            <tr style="{{ !$msg->is_read ? 'font-weight:600' : '' }}">
                <td>{{ $msg->id }}</td>
                <td>{{ $msg->name }}</td>
                <td style="direction:ltr;text-align:left">{{ $msg->email }}</td>
                <td>{{ Str::limit($msg->subject, 40) }}</td>
                <td>
                    @if($msg->is_read)
                        <span class="badge badge-green">مقروءة</span>
                    @else
                        <span class="badge badge-blue">جديدة</span>
                    @endif
                </td>
                <td>{{ $msg->created_at->format('Y-m-d') }}</td>
                <td>
                    <a href="{{ route('admin.messages.show', $msg) }}" class="btn btn-sm btn-secondary">عرض</a>
                    <form method="POST" action="{{ route('admin.messages.destroy', $msg) }}" style="display:inline" onsubmit="return confirm('حذف؟')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">حذف</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="7" style="text-align:center;padding:2rem;color:#888">لا توجد رسائل</td></tr>
            @endforelse
        </tbody>
    </table>
    @if($messages->hasPages())
    <div style="padding:1rem">{{ $messages->links() }}</div>
    @endif
</div>
@endsection
