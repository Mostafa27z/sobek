@extends('layouts.app')

@section('title', 'سوبك ترافيل - طلب حجز مخصص')

@section('styles')
    <style>
        .inquiry-wrapper {
            max-width: 600px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .form-title {
            font-size: 20px;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 24px;
            text-align: center;
            border-bottom: 2px solid var(--border);
            padding-bottom: 12px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }

        .form-row-three {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
        }

        label {
            font-size: 13px;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 6px;
            display: block;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid var(--border);
            border-radius: 8px;
            font-size: 13px;
            font-family: inherit;
            background: #fff;
            color: var(--dark);
            transition: border-color 0.25s ease;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(0, 119, 182, 0.1);
        }

        .submit-btn {
            width: 100%;
            padding: 14px;
            background: var(--secondary);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: background-color 0.25s ease, transform 0.2s ease;
            margin-top: 10px;
        }

        .submit-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }

        @media (max-width: 480px) {
            .form-row {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .form-row-three {
                grid-template-columns: 1fr;
                gap: 12px;
            }
        }
    </style>
@endsection

@section('content')
    <div class="inquiry-wrapper">
        <div class="card reveal visible">
            <h2 class="form-title">طلب حجز رحلة مخصصة</h2>
            <form action="{{ route('inquiry.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="full_name">الاسم الكامل *</label>
                    <input type="text" id="full_name" name="full_name" value="{{ old('full_name') }}" required
                        placeholder="أدخل اسمك الكامل">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="phone_number">رقم الهاتف (واتساب) *</label>
                        <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" required
                            placeholder="مثال: +2010xxxxxxxx">
                    </div>
                    <div class="form-group">
                        <label for="email">البريد الإلكتروني (اختياري)</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            placeholder="example@domain.com">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="from_city">من مدينة</label>
                        <input type="text" id="from_city" name="from_city" value="{{ old('from_city') }}"
                            placeholder="مدينة المغادرة">
                    </div>
                    <div class="form-group">
                        <label for="to_city">إلى مدينة</label>
                        <input type="text" id="to_city" name="to_city" value="{{ old('to_city') }}"
                            placeholder="وجهة السفر">
                    </div>
                </div>

                <div class="form-group">
                    <label for="desired_date">تاريخ السفر المفضل</label>
                    <input type="date" id="desired_date" name="desired_date" value="{{ old('desired_date') }}">
                </div>

                <div class="form-row-three">
                    <div class="form-group">
                        <label for="number_of_adults">كبير</label>
                        <input type="number" id="number_of_adults" name="number_of_adults"
                            value="{{ old('number_of_adults', 1) }}" min="0">
                    </div>
                    <div class="form-group">
                        <label for="number_of_children">الأطفال</label>
                        <input type="number" id="number_of_children" name="number_of_children"
                            value="{{ old('number_of_children', 0) }}" min="0">
                    </div>
                    <div class="form-group">
                        <label for="number_of_babies">الرضيع</label>
                        <input type="number" id="number_of_babies" name="number_of_babies"
                            value="{{ old('number_of_babies', 0) }}" min="0">
                    </div>
                </div>

                <div class="form-group">
                    <label for="message">تفاصيل الطلب / رسالة للمختص *</label>
                    <textarea id="message" name="message" rows="4" required
                        placeholder="يرجى كتابة أي متطلبات خاصة بالرحلة (فندق معين، طيران محدد، الخ) - لا تقل عن 10 أحرف">{{ old('message') }}</textarea>
                </div>

                <button type="submit" class="submit-btn">إرسال الطلب</button>
            </form>
        </div>
    </div>
@endsection