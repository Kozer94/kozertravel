@extends('admin.layout')
@section('title', 'المشتركون في النشرة')

@section('content')
<div class="table-card">
    <div class="table-header">
        <h3>المشتركون ({{ $subscribers->total() }})</h3>
        <a href="{{ route('admin.subscribers.export') }}" class="btn btn-success">⬇ تصدير CSV</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>البريد الإلكتروني</th>
                <th>عنوان IP</th>
                <th>تاريخ الاشتراك</th>
            </tr>
        </thead>
        <tbody>
            @forelse($subscribers as $s)
            <tr>
                <td>{{ $s->id }}</td>
                <td>{{ $s->email }}</td>
                <td style="direction:ltr;text-align:left">{{ $s->ip }}</td>
                <td>{{ $s->created_at->format('Y-m-d H:i') }}</td>
            </tr>
            @empty
            <tr><td colspan="4" style="text-align:center;padding:2rem;color:#888">لا يوجد مشتركون بعد</td></tr>
            @endforelse
        </tbody>
    </table>
    @if($subscribers->hasPages())
    <div style="padding:1rem">{{ $subscribers->links() }}</div>
    @endif
</div>
@endsection
