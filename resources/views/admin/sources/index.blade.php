@extends('admin.layout')
@section('title', 'مصادر الأفلييت')

@section('content')

<div class="table-card">
    <div class="table-header">
        <h3>🔗 مصادر الأفلييت ({{ $sources->count() }})</h3>
    </div>
    <table>
        <thead>
            <tr>
                <th style="width:50px">ترتيب</th>
                <th style="width:36px">لون</th>
                <th>الاسم</th>
                <th>التسمية</th>
                <th>الرابط</th>
                <th style="width:80px">الحالة</th>
                <th style="width:90px">إجراءات</th>
            </tr>
        </thead>
        <tbody>
            @forelse($sources as $source)
            <tr>
                <td style="color:#aaa;font-size:0.82rem;text-align:center">{{ $source->sort_order }}</td>
                <td>
                    <span style="background:{{ $source->color }};display:block;width:24px;height:24px;border-radius:5px;border:1px solid rgba(0,0,0,0.12)"></span>
                </td>
                <td><strong>{{ $source->name }}</strong></td>
                <td style="font-size:0.82rem">
                    @if($source->label_ar)
                        <div>{{ $source->label_ar }}</div>
                        <div style="color:#aaa">{{ $source->label_en }}</div>
                    @else
                        <span style="color:#ccc">—</span>
                    @endif
                </td>
                <td style="max-width:220px">
                    @if($source->url_template)
                        <code style="font-size:0.7rem;color:#7a7a7a;word-break:break-all;line-height:1.4;display:block">{{ Str::limit($source->url_template, 65) }}</code>
                    @else
                        <span style="color:#ccc;font-size:0.8rem">لم يُحدَّد بعد</span>
                    @endif
                </td>
                <td>
                    <form method="POST" action="{{ route('admin.sources.toggle', $source) }}">
                        @csrf @method('PATCH')
                        <label class="toggle" title="{{ $source->is_active ? 'إيقاف' : 'تفعيل' }}">
                            <input type="checkbox" {{ $source->is_active ? 'checked' : '' }} onchange="this.closest('form').submit()">
                            <span class="toggle-slider"></span>
                        </label>
                    </form>
                </td>
                <td>
                    <a href="{{ route('admin.sources.edit', $source) }}" class="btn btn-sm btn-secondary">✏️ تعديل</a>
                </td>
            </tr>
            @empty
            <tr><td colspan="7" style="text-align:center;color:#aaa;padding:2rem">لا توجد مصادر.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
