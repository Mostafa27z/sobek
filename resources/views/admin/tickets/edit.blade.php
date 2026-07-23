@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<style>
    .flatpickr-calendar {
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0,119,182,0.1);
        border: 1px solid var(--border);
        font-family: inherit;
    }
    .flatpickr-day.selected, .flatpickr-day.startRange, .flatpickr-day.endRange, .flatpickr-day.selected.prevMonthDay, .flatpickr-day.startRange.prevMonthDay, .flatpickr-day.endRange.prevMonthDay, .flatpickr-day.selected.nextMonthDay, .flatpickr-day.startRange.nextMonthDay, .flatpickr-day.endRange.nextMonthDay {
        background: var(--primary);
        border-color: var(--primary);
    }
    .flatpickr-day.selected:hover, .flatpickr-day.startRange:hover, .flatpickr-day.endRange:hover, .flatpickr-day.selected.prevMonthDay:hover, .flatpickr-day.startRange.prevMonthDay:hover, .flatpickr-day.endRange.prevMonthDay:hover, .flatpickr-day.selected.nextMonthDay:hover, .flatpickr-day.startRange.nextMonthDay:hover, .flatpickr-day.endRange.nextMonthDay:hover {
        background: var(--primary-dark);
        border-color: var(--primary-dark);
    }
    .flatpickr-months .flatpickr-month {
        background: var(--primary);
        color: #fff;
        fill: #fff;
    }
    .flatpickr-current-month .flatpickr-monthDropdown-months {
        background: var(--primary);
    }
    .flatpickr-weekdays {
        background: var(--primary);
    }
    span.flatpickr-weekday {
        background: var(--primary);
        color: #fff;
    }
    .flatpickr-time {
        border-top: 1px solid var(--border);
    }
    .duration-inputs {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
    }
</style>
@endsection

@section('content')
<div class="card" style="max-width: 800px; margin: 0 auto;">
    <div class="card-header">
        <h2 class="card-title">تعديل تذكرة الطيران #{{ $ticket->id }}</h2>
        <a href="{{ route('admin.tickets.index') }}" class="btn btn-secondary">عودة</a>
    </div>

    <form action="{{ route('admin.tickets.update', $ticket->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group" style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
            <div>
                <label for="from_city_id">من مدينة (المغادرة) *</label>
                <select id="from_city_id" name="from_city_id" required>
                    <option value="">اختر المدينة</option>
                    @foreach($fromCities as $city)
                        <option value="{{ $city->id }}" {{ old('from_city_id', $ticket->from_city_id) == $city->id ? 'selected' : '' }}>
                            {{ $city->name }} ({{ $city->city }} - {{ $city->country }}) [{{ $city->iata }}]
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="to_city_id">إلى مدينة (الوصول) *</label>
                <select id="to_city_id" name="to_city_id" required>
                    <option value="">اختر المدينة</option>
                    @foreach($toCities as $city)
                        <option value="{{ $city->id }}" {{ old('to_city_id', $ticket->to_city_id) == $city->id ? 'selected' : '' }}>
                            {{ $city->name }} ({{ $city->city }} - {{ $city->country }}) [{{ $city->iata }}]
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group" style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
            <div>
                <label for="airline">شركة الطيران</label>
                <input type="text" id="airline" name="airline" value="{{ old('airline', $ticket->airline) }}" placeholder="مثال: مصر للطيران">
            </div>
            <div>
                <label for="weight">الوزن المسموح</label>
                <input type="text" id="weight" name="weight" value="{{ old('weight', $ticket->weight) }}" placeholder="مثال: 23 كجم">
            </div>
        </div>

        <div class="form-group" style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
            <div>
                <label for="trip_type">نوع الرحلة *</label>
                <select id="trip_type" name="trip_type" required>
                    <option value="one_way" {{ old('trip_type', $ticket->trip_type) === 'one_way' ? 'selected' : '' }}>ذهاب فقط</option>
                    <option value="round_trip" {{ old('trip_type', $ticket->trip_type) === 'round_trip' ? 'selected' : '' }}>ذهاب وعودة</option>
                </select>
            </div>
            <div>
                <label for="price">سعر التذكرة (ج.م) *</label>
                <input type="number" id="price" name="price" value="{{ old('price', $ticket->price) }}" step="0.01" min="0" required placeholder="مثال: 3200">
            </div>
        </div>

        <h3 style="margin: 20px 0 10px; color: var(--primary); border-bottom: 2px solid var(--sky-light); padding-bottom: 5px;">تفاصيل رحلة الذهاب</h3>
        
        <div class="form-group" style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
            <div>
                <label for="departure_date">تاريخ ووقت المغادرة *</label>
                <input type="text" id="departure_date" name="departure_date" class="datetime-picker" value="{{ old('departure_date', $ticket->departure_date ? $ticket->departure_date->format('Y-m-d H:i') : '') }}" required readonly>
            </div>
            <div>
                <label for="arrival_date">تاريخ ووقت الوصول</label>
                <input type="text" id="arrival_date" name="arrival_date" class="datetime-picker" value="{{ old('arrival_date', $ticket->arrival_date ? $ticket->arrival_date->format('Y-m-d H:i') : '') }}" readonly>
            </div>
        </div>

        <div class="form-group">
            <label>مدة رحلة الذهاب</label>
            <div class="duration-inputs">
                <div>
                    <input type="number" name="duration_days" value="{{ old('duration_days', $ticket->duration_days) }}" min="0" placeholder="أيام">
                    <small>أيام</small>
                </div>
                <div>
                    <input type="number" name="duration_hours" value="{{ old('duration_hours', $ticket->duration_hours) }}" min="0" max="23" placeholder="ساعات">
                    <small>ساعات</small>
                </div>
                <div>
                    <input type="number" name="duration_minutes" value="{{ old('duration_minutes', $ticket->duration_minutes) }}" min="0" max="59" placeholder="دقائق">
                    <small>دقائق</small>
                </div>
            </div>
        </div>

        <div id="return_trip_section" style="display: none;">
            <h3 style="margin: 20px 0 10px; color: var(--primary); border-bottom: 2px solid var(--sky-light); padding-bottom: 5px;">تفاصيل رحلة العودة</h3>
            
            <div class="form-group" style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                <div>
                    <label for="return_date">تاريخ ووقت العودة *</label>
                    <input type="text" id="return_date" name="return_date" class="datetime-picker" value="{{ old('return_date', $ticket->return_date ? $ticket->return_date->format('Y-m-d H:i') : '') }}" readonly>
                </div>
                <div>
                    <label for="return_arrival_date">تاريخ ووقت وصول العودة</label>
                    <input type="text" id="return_arrival_date" name="return_arrival_date" class="datetime-picker" value="{{ old('return_arrival_date', $ticket->return_arrival_date ? $ticket->return_arrival_date->format('Y-m-d H:i') : '') }}" readonly>
                </div>
            </div>

            <div class="form-group">
                <label>مدة رحلة العودة</label>
                <div class="duration-inputs">
                    <div>
                        <input type="number" name="return_duration_days" value="{{ old('return_duration_days', $ticket->return_duration_days) }}" min="0" placeholder="أيام">
                        <small>أيام</small>
                    </div>
                    <div>
                        <input type="number" name="return_duration_hours" value="{{ old('return_duration_hours', $ticket->return_duration_hours) }}" min="0" max="23" placeholder="ساعات">
                        <small>ساعات</small>
                    </div>
                    <div>
                        <input type="number" name="return_duration_minutes" value="{{ old('return_duration_minutes', $ticket->return_duration_minutes) }}" min="0" max="59" placeholder="دقائق">
                        <small>دقائق</small>
                    </div>
                </div>
            </div>
        </div>

        <h3 style="margin: 20px 0 10px; color: var(--primary); border-bottom: 2px solid var(--sky-light); padding-bottom: 5px;">خيارات إضافية</h3>

        <div class="form-group" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px;">
            <div>
                <label for="number_of_adults">الحد الأقصى للكبار *</label>
                <input type="number" id="number_of_adults" name="number_of_adults" value="{{ old('number_of_adults', $ticket->number_of_adults) }}" min="1" required>
            </div>
            <div>
                <label for="number_of_children">الحد الأقصى للأطفال</label>
                <input type="number" id="number_of_children" name="number_of_children" value="{{ old('number_of_children', $ticket->number_of_children) }}" min="0">
            </div>
            <div>
                <label for="number_of_babies">الحد الأقصى للرضع</label>
                <input type="number" id="number_of_babies" name="number_of_babies" value="{{ old('number_of_babies', $ticket->number_of_babies) }}" min="0">
            </div>
        </div>

        <div class="form-group">
            <label for="description">ملاحظات / وصف الرحلة (اختياري)</label>
            <textarea id="description" name="description" rows="4" placeholder="اكتب أي ملاحظات أو شروط خاصة بالرحلة">{{ old('description', $ticket->description) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary" style="width: 100%; padding: 12px; margin-top: 10px;">تحديث التذكرة</button>
    </form>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ar.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const fromSelect = document.getElementById('from_city_id');
    const toSelect = document.getElementById('to_city_id');
    const tripTypeSelect = document.getElementById('trip_type');
    const returnTripSection = document.getElementById('return_trip_section');
    
    // Select2 search initialization for cities dropdown
    if (window.jQuery && jQuery().select2) {
        $(fromSelect).select2({
            placeholder: "ابحث عن المدينة أو المطار...",
            allowClear: true,
            width: '100%',
            dir: "rtl"
        }).on('change', updateOptions);

        $(toSelect).select2({
            placeholder: "ابحث عن المدينة أو المطار...",
            allowClear: true,
            width: '100%',
            dir: "rtl"
        }).on('change', updateOptions);
    }
    
    // Flatpickr setup
    const fpConfig = {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        minDate: "today",
        locale: "ar",
        time_24hr: true
    };

    const departureFp = flatpickr("#departure_date", {
        ...fpConfig,
        onChange: function(selectedDates, dateStr) {
            arrivalFp.set('minDate', dateStr);
            if (returnFp) returnFp.set('minDate', dateStr);
        }
    });

    const arrivalFp = flatpickr("#arrival_date", {
        ...fpConfig,
        onChange: function(selectedDates, dateStr) {
            if (returnFp) returnFp.set('minDate', dateStr);
        }
    });

    const returnFp = flatpickr("#return_date", {
        ...fpConfig,
        onChange: function(selectedDates, dateStr) {
            returnArrivalFp.set('minDate', dateStr);
        }
    });

    const returnArrivalFp = flatpickr("#return_arrival_date", {
        ...fpConfig
    });

    function updateOptions() {
        const fromValue = fromSelect.value;
        const toValue = toSelect.value;

        Array.from(toSelect.options).forEach(option => {
            if (option.value === '') return;
            if (option.value === fromValue) {
                option.style.display = 'none';
                option.disabled = true;
            } else {
                option.style.display = '';
                option.disabled = false;
            }
        });

        Array.from(fromSelect.options).forEach(option => {
            if (option.value === '') return;
            if (option.value === toValue) {
                option.style.display = 'none';
                option.disabled = true;
            } else {
                option.style.display = '';
                option.disabled = false;
            }
        });
    }

    function updateReturnTripVisibility() {
        const isRoundTrip = tripTypeSelect.value === 'round_trip';
        returnTripSection.style.display = isRoundTrip ? '' : 'none';
        
        document.getElementById('return_date').required = isRoundTrip;
    }

    fromSelect.addEventListener('change', updateOptions);
    toSelect.addEventListener('change', updateOptions);
    tripTypeSelect.addEventListener('change', updateReturnTripVisibility);
    
    updateOptions();
    updateReturnTripVisibility();
});
</script>
@endsection