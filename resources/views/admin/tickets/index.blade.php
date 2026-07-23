@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">إدارة تذاكر الطيران</h2>
        <a href="{{ route('admin.tickets.create') }}" class="btn btn-primary">إضافة تذكرة جديدة</a>
    </div>

    <div class="card-body" style="padding: 20px;">
        <form method="GET" action="{{ route('admin.tickets.index') }}" style="display: flex; flex-direction: column; gap: 16px;">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 16px;">
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500;">بحث</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="ابحث باسم الدولة أو المدينة أو رمز IATA أو اسم المطار أو شركة الطيران..." style="width: 100%; padding: 8px 12px; border: 1px solid #ddd; border-radius: 4px;">
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500;">من (المغادرة)</label>
                    <select name="from_city_id" style="width: 100%; padding: 8px 12px; border: 1px solid #ddd; border-radius: 4px;">
                        <option value="">جميع المدن</option>
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}" {{ request('from_city_id') == $city->id ? 'selected' : '' }}>
                                {{ $city->name }} ({{ $city->city }} - {{ $city->country }}) [{{ $city->iata }}]
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500;">إلى (الوجهة)</label>
                    <select name="to_city_id" style="width: 100%; padding: 8px 12px; border: 1px solid #ddd; border-radius: 4px;">
                        <option value="">جميع المدن</option>
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}" {{ request('to_city_id') == $city->id ? 'selected' : '' }}>
                                {{ $city->name }} ({{ $city->city }} - {{ $city->country }}) [{{ $city->iata }}]
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500;">نوع الرحلة</label>
                    <select name="trip_type" style="width: 100%; padding: 8px 12px; border: 1px solid #ddd; border-radius: 4px;">
                        <option value="">الكل</option>
                        <option value="one_way" {{ request('trip_type') == 'one_way' ? 'selected' : '' }}>ذهاب فقط</option>
                        <option value="round_trip" {{ request('trip_type') == 'round_trip' ? 'selected' : '' }}>ذهاب وعودة</option>
                    </select>
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500;">الحالة</label>
                    <select name="is_active" style="width: 100%; padding: 8px 12px; border: 1px solid #ddd; border-radius: 4px;">
                        <option value="">الكل</option>
                        <option value="1" {{ request('is_active') === '1' ? 'selected' : '' }}>نشط</option>
                        <option value="0" {{ request('is_active') === '0' ? 'selected' : '' }}>غير نشط</option>
                    </select>
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500;">تاريخ المغادرة من</label>
                    <input type="date" name="departure_date_from" value="{{ request('departure_date_from') }}" style="width: 100%; padding: 8px 12px; border: 1px solid #ddd; border-radius: 4px;">
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500;">تاريخ المغادرة إلى</label>
                    <input type="date" name="departure_date_to" value="{{ request('departure_date_to') }}" style="width: 100%; padding: 8px 12px; border: 1px solid #ddd; border-radius: 4px;">
                </div>
            </div>

            <div style="display: flex; gap: 12px;">
                <button type="submit" class="btn btn-primary">بحث</button>
                <a href="{{ route('admin.tickets.index') }}" class="btn btn-secondary">إعادة تعيين</a>
            </div>
        </form>
    </div>

    <div style="overflow-x: auto;">
        <table>
            <thead>
                <tr>
                    <th>المعرف</th>
                    <th>من (المغادرة)</th>
                    <th>إلى (الوجهة)</th>
                    <th>خطوط الطيران</th>
                    <th>نوع الرحلة</th>
                    <th>تاريخ المغادرة</th>
                    <th>تاريخ الوصول</th>
                    <th>مدة الرحلة</th>
                    <th>تاريخ العودة</th>
                    <th>تاريخ وصول العودة</th>
                    <th>مدة العودة</th>
                    <th>الوزن المسموح به</th>
                    <th>كبير</th>
                    <th>الأطفال</th>
                    <th>الرضع</th>
                    <th>السعر (ج.م)</th>
                    <th>الوصف</th>
                    <th>الحالة</th>
                    <th>العمليات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tickets as $ticket)
                    <tr>
                        <td>{{ $ticket->id }}</td>
                        <td><strong>{{ $ticket->fromCity->name ?? 'غير محدد' }}</strong></td>
                        <td><strong>{{ $ticket->toCity->name ?? 'غير محدد' }}</strong></td>
                        <td>{{ $ticket->airline ?? '-' }}</td>
                        <td>{{ $ticket->trip_type === 'round_trip' ? 'ذهاب وعودة' : 'ذهاب فقط' }}</td>
                        <td>{{ $ticket->departure_date ? $ticket->departure_date->format('Y-m-d H:i') : 'غير محدد' }}</td>
                        <td>{{ $ticket->arrival_date ? $ticket->arrival_date->format('Y-m-d H:i') : '-' }}</td>
                        <td>
                            @if($ticket->duration_days || $ticket->duration_hours || $ticket->duration_minutes)
                                {{ $ticket->duration_days ? $ticket->duration_days . ' يوم ' : '' }}
                                {{ $ticket->duration_hours ? $ticket->duration_hours . ' ساعة ' : '' }}
                                {{ $ticket->duration_minutes ? $ticket->duration_minutes . ' دقيقة' : '' }}
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $ticket->return_date ? $ticket->return_date->format('Y-m-d H:i') : '-' }}</td>
                        <td>{{ $ticket->return_arrival_date ? $ticket->return_arrival_date->format('Y-m-d H:i') : '-' }}</td>
                        <td>
                            @if($ticket->return_duration_days || $ticket->return_duration_hours || $ticket->return_duration_minutes)
                                {{ $ticket->return_duration_days ? $ticket->return_duration_days . ' يوم ' : '' }}
                                {{ $ticket->return_duration_hours ? $ticket->return_duration_hours . ' ساعة ' : '' }}
                                {{ $ticket->return_duration_minutes ? $ticket->return_duration_minutes . ' دقيقة' : '' }}
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $ticket->weight ?? '-' }}</td>
                        <td>{{ $ticket->number_of_adults }}</td>
                        <td>{{ $ticket->number_of_children }}</td>
                        <td>{{ $ticket->number_of_babies }}</td>
                        <td><span style="color: var(--secondary); font-weight: bold;">{{ number_format($ticket->price, 0) }}</span></td>
                        <td>{{ Str::limit($ticket->description, 50) ?? '-' }}</td>
                        <td>
                            @if($ticket->is_active)
                                <span class="badge badge-success">نشط</span>
                            @else
                                <span class="badge badge-danger">غير نشط</span>
                            @endif
                        </td>
                        <td>
                            <div style="display: flex; gap: 8px; align-items: center;">
                                <form action="{{ route('admin.tickets.toggle', $ticket->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn {{ $ticket->is_active ? 'btn-danger' : 'btn-accent' }} btn-sm">
                                        {{ $ticket->is_active ? 'تعطيل' : 'تفعيل' }}
                                    </button>
                                </form>
                                <a href="{{ route('admin.tickets.edit', $ticket->id) }}" class="btn btn-secondary btn-sm">تعديل</a>
                                <form action="{{ route('admin.tickets.destroy', $ticket->id) }}" method="POST" style="display:inline;" onsubmit="return confirmDelete('هل أنت متأكد من حذف هذه التذكرة؟');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">حذف</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="19" style="text-align: center; color: var(--gray);">لا توجد تذاكر طيران مطابقة للبحث.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($tickets->hasPages())
        <div class="pagination-container">
            {{ $tickets->links() }}
        </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    if (window.jQuery && jQuery().select2) {
        $('select[name="from_city_id"], select[name="to_city_id"]').select2({
            placeholder: "اختر المدينة",
            allowClear: true,
            width: '100%',
            dir: "rtl"
        });
    }
});
</script>
@endsection
