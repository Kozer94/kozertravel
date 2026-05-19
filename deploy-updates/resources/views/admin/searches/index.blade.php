@extends('admin.layout')
@section('title', 'سجل البحثات')

@section('content')

{{-- Filters --}}
<form method="GET" action="{{ route('admin.searches.index') }}">
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
            <span class="filter-label">من (IATA)</span>
            <input type="text" name="origin" class="filter-input" maxlength="3" placeholder="CAI" value="{{ request('origin') }}" style="width:70px;text-transform:uppercase">
        </div>
        <div class="filter-group">
            <span class="filter-label">إلى (IATA)</span>
            <input type="text" name="destination" class="filter-input" maxlength="3" placeholder="DXB" value="{{ request('destination') }}" style="width:70px;text-transform:uppercase">
        </div>
        <button type="submit" class="btn btn-primary btn-sm">🔍 بحث</button>
        @if(request()->hasAny(['date_from','date_to','origin','destination']))
            <a href="{{ route('admin.searches.index') }}" class="btn btn-secondary btn-sm">✕ مسح</a>
        @endif
    </div>
</form>

<div class="table-card">
    <div class="table-header">
        <h3>🔍 البحثات ({{ $searches->total() }})</h3>
    </div>
    <table>
        <thead>
            <tr>
                <th>#</th><th>من</th><th>إلى</th><th>تاريخ الرحلة</th><th>نوع الرحلة</th><th>بالغين</th><th>IP</th><th>وقت البحث</th>
            </tr>
        </thead>
        <tbody>
            @forelse($searches as $s)
            <tr>
                <td style="color:#aaa;font-size:0.78rem">{{ $s->id }}</td>
                <td><strong>{{ $s->origin }}</strong></td>
                <td><strong>{{ $s->destination }}</strong></td>
                <td>{{ $s->date->format('d/m/Y') }}</td>
                <td>
                    <span class="badge {{ $s->trip_type === 'roundtrip' ? 'badge-blue' : 'badge-yellow' }}">
                        {{ $s->trip_type === 'roundtrip' ? 'ذهاب وإياب' : 'ذهاب فقط' }}
                    </span>
                </td>
                <td>{{ $s->adults }}</td>
                <td style="font-size:0.78rem;color:#aaa">{{ $s->ip ?? '—' }}</td>
                <td style="font-size:0.8rem;color:#7a7a7a">{{ $s->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            @empty
            <tr><td colspan="8" style="text-align:center;color:#aaa;padding:2rem">لا توجد بحثات بعد.</td></tr>
            @endforelse
        </tbody>
    </table>
    @if($searches->hasPages())
    <div class="pagination">
        {{ $searches->links('admin.pagination') }}
    </div>
    @endif
</div>
@endsection
