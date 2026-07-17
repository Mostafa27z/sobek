@extends('layouts.admin')

@section('content')
<div class="card" style="max-width: 600px; margin: 0 auto;">
    <div class="card-header">
        <h2 class="card-title">إضافة مدينة جديدة</h2>
        <a href="{{ route('admin.cities.index') }}" class="btn btn-secondary">عودة</a>
    </div>

    <form action="{{ route('admin.cities.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label for="name">اسم المطار *</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="مثال: مطار القاهرة الدولي">
        </div>

        <div class="form-group">
            <label for="city">المدينة *</label>
            <input type="text" id="city" name="city" value="{{ old('city') }}" required placeholder="مثال: القاهرة">
        </div>

        <div class="form-group">
            <label for="country">الدولة *</label>
            <input type="text" id="country" name="country" value="{{ old('country') }}" required placeholder="مثال: مصر">
        </div>

        <div class="form-group">
            <label for="iata">رمز IATA *</label>
            <input type="text" id="iata" name="iata" value="{{ old('iata') }}" required placeholder="مثال: CAI" maxlength="3">
        </div>

        <div class="form-group checkbox-group">
            <input type="checkbox" id="can_be_from" name="can_be_from" value="1" {{ old('can_be_from', true) ? 'checked' : '' }}>
            <label for="can_be_from">يمكن أن تكون مدينة مغادرة (من)</label>
        </div>

        <div class="form-group checkbox-group" style="margin-bottom: 24px;">
            <input type="checkbox" id="can_be_to" name="can_be_to" value="1" {{ old('can_be_to', true) ? 'checked' : '' }}>
            <label for="can_be_to">يمكن أن تكون مدينة وصول (إلى)</label>
        </div>

        <div class="form-group">
            <label for="description">وصف المدينة (اختياري)</label>
            <textarea id="description" name="description" rows="4" placeholder="اكتب وصفاً أو تفاصيل إضافية للمدينة">{{ old('description') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary" style="width: 100%; padding: 12px; margin-top: 10px;">إضافة المدينة</button>
    </form>
</div>
@endsection
