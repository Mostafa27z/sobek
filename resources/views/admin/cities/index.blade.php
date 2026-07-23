@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">قائمة المدن</h2>
        <a href="{{ route('admin.cities.create') }}" class="btn btn-primary">إضافة مدينة جديدة</a>
    </div>

    <div class="card-body" style="padding: 20px;">
        <form method="GET" action="{{ route('admin.cities.index') }}" style="display: flex; flex-direction: column; gap: 16px;">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px;">
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500;">بحث</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="ابحث عن المطار أو المدينة أو الدولة أو IATA..." style="width: 100%; padding: 8px 12px; border: 1px solid #ddd; border-radius: 4px;">
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500;">متاح كمغادرة (من)</label>
                    <select name="can_be_from" style="width: 100%; padding: 8px 12px; border: 1px solid #ddd; border-radius: 4px;">
                        <option value="">الكل</option>
                        <option value="1" {{ request('can_be_from') === '1' ? 'selected' : '' }}>نعم</option>
                        <option value="0" {{ request('can_be_from') === '0' ? 'selected' : '' }}>لا</option>
                    </select>
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500;">متاح كوصول (إلى)</label>
                    <select name="can_be_to" style="width: 100%; padding: 8px 12px; border: 1px solid #ddd; border-radius: 4px;">
                        <option value="">الكل</option>
                        <option value="1" {{ request('can_be_to') === '1' ? 'selected' : '' }}>نعم</option>
                        <option value="0" {{ request('can_be_to') === '0' ? 'selected' : '' }}>لا</option>
                    </select>
                </div>
            </div>

            <div style="display: flex; gap: 12px;">
                <button type="submit" class="btn btn-primary">بحث</button>
                <a href="{{ route('admin.cities.index') }}" class="btn btn-secondary">إعادة تعيين</a>
            </div>
        </form>
    </div>
    
    <div style="overflow-x: auto;">
        <table>
            <thead>
                <tr>
                    <th>المعرف</th>
                    <th>اسم المطار</th>
                    <th>المدينة</th>
                    <th>الدولة</th>
                    <th>رمز IATA</th>
                    <th>متاح كمغادرة (من)</th>
                    <th>متاح كوصول (إلى)</th>
                    <th>العمليات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($cities as $city)
                    <tr>
                        <td>{{ $city->id }}</td>
                        <td><strong>{{ $city->name }}</strong></td>
                        <td>{{ $city->city }}</td>
                        <td>{{ $city->country }}</td>
                        <td><span class="badge badge-secondary">{{ $city->iata }}</span></td>
                        <td>
                            @if($city->can_be_from)
                                <span class="badge badge-success">نعم</span>
                            @else
                                <span class="badge badge-danger">لا</span>
                            @endif
                        </td>
                        <td>
                            @if($city->can_be_to)
                                <span class="badge badge-success">نعم</span>
                            @else
                                <span class="badge badge-danger">لا</span>
                            @endif
                        </td>
                        <td>
                            <div style="display: flex; gap: 8px;">
                                <a href="{{ route('admin.cities.edit', $city->id) }}" class="btn btn-secondary btn-sm">تعديل</a>
                                <form action="{{ route('admin.cities.destroy', $city->id) }}" method="POST" onsubmit="return confirmDelete('هل أنت متأكد من حذف هذه المدينة؟ سيتم حذف الرحلات المرتبطة بها.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">حذف</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="text-align: center; color: var(--gray);">لا توجد مدن مضافة حالياً.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($cities->hasPages())
        <div class="pagination-container">
            {{ $cities->links() }}
        </div>
    @endif
</div>
@endsection
