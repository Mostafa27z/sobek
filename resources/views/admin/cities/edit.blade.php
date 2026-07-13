@extends('layouts.admin')

@section('content')
<div class="card" style="max-width: 600px; margin: 0 auto;">
    <div class="card-header">
        <h2 class="card-title">تعديل المدينة: {{ $city->name }}</h2>
        <a href="{{ route('admin.cities.index') }}" class="btn btn-secondary">عودة</a>
    </div>

    <form action="{{ route('admin.cities.update', $city->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="name">اسم المدينة *</label>
            <input type="text" id="name" name="name" value="{{ old('name', $city->name) }}" required placeholder="مثال: القاهرة (CAI)">
        </div>

        <div class="form-group checkbox-group">
            <input type="checkbox" id="can_be_from" name="can_be_from" value="1" {{ old('can_be_from', $city->can_be_from) ? 'checked' : '' }}>
            <label for="can_be_from">يمكن أن تكون مدينة مغادرة (من)</label>
        </div>

        <div class="form-group checkbox-group" style="margin-bottom: 24px;">
            <input type="checkbox" id="can_be_to" name="can_be_to" value="1" {{ old('can_be_to', $city->can_be_to) ? 'checked' : '' }}>
            <label for="can_be_to">يمكن أن تكون مدينة وصول (إلى)</label>
        </div>

        <div class="form-group">
            <label for="description">وصف المدينة (اختياري)</label>
            <textarea id="description" name="description" rows="4" placeholder="اكتب وصفاً أو تفاصيل إضافية للمدينة">{{ old('description', $city->description) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary" style="width: 100%; padding: 12px; margin-top: 10px;">تحديث المدينة</button>
    </form>
</div>
@endsection
