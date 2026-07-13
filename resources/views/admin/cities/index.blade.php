@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">قائمة المدن</h2>
        <a href="{{ route('admin.cities.create') }}" class="btn btn-primary">إضافة مدينة جديدة</a>
    </div>
    
    <div style="overflow-x: auto;">
        <table>
            <thead>
                <tr>
                    <th>المعرف</th>
                    <th>اسم المدينة</th>
                    <th>متاح كمغادرة (من)</th>
                    <th>متاح كوصول (إلى)</th>
                    <th>الوصف</th>
                    <th>العمليات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($cities as $city)
                    <tr>
                        <td>{{ $city->id }}</td>
                        <td><strong>{{ $city->name }}</strong></td>
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
                        <td>{{ Str::limit($city->description, 50) }}</td>
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
                        <td colspan="6" style="text-align: center; color: var(--gray);">لا توجد مدن مضافة حالياً.</td>
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
