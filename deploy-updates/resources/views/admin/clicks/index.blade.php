@extends('admin.layout')
@section('title', 'سجل النقرات')

@section('content')

{{-- Filters --}}
<form method="GET" action="{{ route('admin.clicks.index') }}">
    <div class="filter-bar">
        <div class="filter-group">
            <span class="filter-label">من تاريخ</span>
            <input type="date" name="date_from" class="filter-input" value="{{ request('date_from') }}">
        </div>
        <div class="filter-group">
            <span class="filter-label">إلى تاريخ</span>
            <input type="date" name="date_to" class="filter-input" value="{{ request('date_to') }}">
        </div>
        <div class="filter-group">
            <span class="filter-label">المصدر</span>
            <input type="text" name="source" class="filter-input" placeholder="Skyscanner" value="{{ request('source') }}" style="width:130px">
        </div>
        <button type="submit" class="btn btn-primary btn-sm">🔍 بحث</button>
        @if(request()->hasAny(['date_from','date_to','source']))
            <a href="{{ route('admin.clicks.index') }}" class="btn btn-secondary btn-sm">✕ مسح</a>
        @endif
    </div>
</form>

<div class="table-card">
    <div class="table-header">
        <h3>👆 النقرات على الأفلييت ({{ $clicks->total() }})</h3>
    </div>
    <table>
        <thead>
            <tr><th>#</th><th>المصدر</th><th>من</th><th>إلى</th><th>IP</th><th>الوقت</th></tr>
        </thead>
        <tbody>
            @forelse($clicks as $c)
            <tr>
                <td style="color:#aaa;font-size:0.78rem">{{ $c->id }}</td>
                <td><strong>{{ $c->source_name }}</strong></td>
                <td>{{ $c->origin ?? '—' }}</td>
                <td>{{ $c->destination ?? '—' }}</td>
                <td style="font-size:0.78rem;color:#aaa">{{ $c->ip ?? '—' }}</td>
                <td style="font-size:0.8rem;color:#7a7a7a">{{ $c->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            @empty
            <tr><td colspan="6" style="text-align:center;color:#aaa;padding:2rem">لا توجد نقرات بعد.</td></tr>
            @endforelse
        </tbody>
    </table>
    @if($clicks->hasPages())
    <div class="pagination">
        {{ $clicks->links('admin.pagination') }}
    </div>
    @endif
</div>
@endsection
